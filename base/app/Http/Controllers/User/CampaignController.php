<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Gallery;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function allCampaign()
    {
        $pageTitle = 'All Campaigns';
        $user = auth()->user();

        if (request()->search) {
            $campaigns = Campaign::with(['category'])->where('title', 'LIKE', '%' . request()->search . '%')->where('user_id', $user->id)->orderBy('created_at', 'desc')->latest()->paginate(getPaginate());
        } else {
            $campaigns = Campaign::with(['category'])->where('user_id', $user->id)->orderBy('created_at', 'desc')->where('stop', Status::NO)->latest()->paginate(getPaginate());
        }

        return view(activeTemplate() . 'user.campaigns.all', compact('pageTitle', 'campaigns'));
    }
    public function create()
    {
        $pageTitle = 'Add Campaign';
        $categories = Category::where('status', 1)->get();
        return view(activeTemplate() . 'user.campaigns.create', compact('pageTitle', 'categories'));
    }
    public function store(Request $request, $id = 0)
    {
        $request->validate([
            'title'       => 'required|max:200',
            'description' => 'required',
            'goal_amount' => 'required|numeric|gt:0',
            'date'        => 'required',
            'document'    => 'nullable|mimes:pdf',
            'image'       => [$id != 0 ? 'nullable' : 'required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'attachments' => ['nullable', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
        ]);

        $dateString = $request->date;
        $formate = covertDateFormat();
        $date = Carbon::createFromFormat($formate, $dateString);
        $formattedDatetime = $date->format('Y-m-d H:i:s');

        $campaign = $id != 0 ? Campaign::findOrFail($id) : new Campaign();

        $campaign->title        = $request->title;
        $campaign->description  = $request->description;
        $campaign->category_id  = $request->category_id;
        $campaign->user_id      = auth()->user()->id;
        $campaign->date         = $formattedDatetime;
        $campaign->goal         = $request->goal_amount;
        $campaign->slug         = slug($request->title);

        if ($request->hasFile('image')) {
            try {
                $campaign->image = fileUploader($request->image, getFilePath('campaignImg'), getFileSize('campaignImg'));
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        if ($request->hasFile('document')) {
            try {
                $campaign->document = fileUploader($request->document, getFilePath('document'));
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your Document'];
                return back()->withNotify($notify);
            }
        }

        $campaign->save();

        if ($request->hasFile('gallery')) {
            foreach ($request->gallery as $item) {
                try {
                    $new = fileUploader($item, getFilePath('gallery'));
                    $gallery = new Gallery();
                    $gallery->campaign_id = $campaign->id;
                    $gallery->image = $new;
                    $gallery->save();
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload your Relevant image'];
                    return back()->withNotify($notify);
                }
            }
        }

        $notify[] = ['success', 'Campaign has been created successfully'];
        return back()->withNotify($notify);
    }
    public function edit($id)
    {
        $pageTitle  = "Edit Campaign ";
        $campaign   = Campaign::where('user_id', auth()->id())->findOrFail($id);
        $categories = Category::active()->get();
        return view(activeTemplate() . 'user.campaigns.edit', compact('pageTitle', 'campaign', 'categories'));
    }

    protected function campaignData($scope = null)
    {
        if ($scope) {
            $campaigns = Campaign::$scope();
        } else {
            $campaigns = Campaign::query();
        }

        return $campaigns->where('user_id', auth()->id())->searchable(['title'])->orderBy('id', 'DESC')->paginate(getPaginate());
    }
    public function expired()
    {
        $pageTitle = "Expired Campaigns";

        $campaigns = $this->campaignData('expiredAndNotCompleted');
        return view(activeTemplate() . 'user.campaigns.expired', compact('campaigns', 'pageTitle'));
    }
    public function approved()
    {
        $pageTitle  = "Approved Campaigns";
        $campaigns  = $this->campaignData('active');
        return view(activeTemplate() . 'user.campaigns.index', compact('campaigns', 'pageTitle'));
    }
    public function pending()
    {
        $pageTitle  = "Pending Campaigns";
        $campaigns  = $this->campaignData('pending');
        return view(activeTemplate() . 'user.campaigns.index', compact('campaigns', 'pageTitle'));
    }
    public function success()
    {
        $pageTitle = "Successful Campaigns";
        $campaigns = $this->campaignData('completed');
        return view(activeTemplate() . 'user.campaigns.index', compact('campaigns', 'pageTitle'));
    }
    public function rejected()
    {
        $pageTitle = "Rejected Campaigns";
        $campaigns = $this->campaignData('rejected');
        return view(activeTemplate() . 'user.campaigns.index', compact('campaigns', 'pageTitle'));
    }

    public function details(Request $request)
    {
        $pageTitle = "Campaigns Details";
        $campaign  = Campaign::where('slug', $request->slug)->findOrFail($request->id);
        return view(activeTemplate() . 'user.campaigns.details', compact('campaign', 'pageTitle'));
    }
    public function extended(Request $request, $id = 0)
    {
        $campaign = Campaign::where('user_id', auth()->user()->id)->where('id', $id)->first();

        if (!$campaign) {
            $notify[] = ['error', 'The request to extend the campaign is invalid'];
            return back()->withNotify($notify);
        }

        $request->validate([
            'date'      => 'required|date|after:today',
            'goal'      => 'nullable|numeric'
        ]);

        $goal = $request->goal ?? 0;

        $campaign->date    = Carbon::parse($request->date);
        $campaign->goal        = $goal + $campaign->goal;
        $campaign->extend_goal = $goal;
        $campaign->is_extend   = Status::YES;
        $campaign->expired     = Status::NO;
        $campaign->status      = Status::PENDING;
        $campaign->save();
        $notify[] = ['success', 'Successfully sent the campaign extend request to author'];
        return back()->withNotify($notify);
    }
    public function runAndStop($id)
    {
        $campaign = Campaign::where('user_id', auth()->id())->findOrFail($id);
        if ($campaign->stop) {
            $campaign->stop = Status::NO;
            $notification = 'Campaign started successfully';
        } else {
            $campaign->stop = Status::YES;
            $notification = 'Campaign stopped successfully';
        }
        $campaign->save();
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }
    public function complete($id)
    {
        $campaign = Campaign::active()->findOrFail($id);
        $campaign->completed = Status::YES;
        $campaign->save();
        $notify[] = ['success', 'Campaign Completed Successfully'];
        return back()->withNotify($notify);
    }
    public function delete($id)
    {
        $campaign = Campaign::with('galleries')->findOrFail($id);
        try {
            if (!empty($campaign->galleries)) {
                foreach ($campaign->galleries as  $gallery) {
                    $galleryPath = getFilePath('gallery') . '/' . $gallery->image;
                    fileManager()->removeFile($galleryPath);
                }
            }
            fileManager()->removeFile(getFilePath('campaignImg') . '/' . $campaign->image);
            if ($campaign->document != null) {
                fileManager()->removeFile(getFilePath('document') . '/' . $campaign->document);
            }

            $campaign->delete();
        } catch (Exception $ex) {

            $notify[] = ['error', $ex->getMessage()];
            return back()->withNotify($notify);
        }

        $notify[] = ['success', 'Campaign deleted Successfully'];
        return back()->withNotify($notify);
    }
}
