<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Comment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $pageTitle = 'All Campaigns';
        $campaigns = Campaign::searchable(['title', 'category:name', 'user:username'])->with('user', 'category')->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.campaign.index', compact('campaigns', 'pageTitle'));
    }

    public function details($id)
    {
        $campaign  = Campaign::withCount('donation')->with([
            'comments' => function ($q) {
                $q->take(5)->orderBy('id', 'DESC');
            }, 'donation' => function ($donation) {
                $donation->take(2)->orderBy('id', 'DESC');
            }

        ])->findOrFail($id);

        $donate    = $campaign->donation->where('status', Status::DONATION_PAID)->sum('donation');
        $percent   = percent($donate, $campaign);

        if ($campaign->is_extend == Status::YES) {
            $pageTitle = "Extend Request Campaign Details";
        } else {
            $pageTitle = "Campaign Details";
        }

        return view('admin.campaign.details', compact('pageTitle', 'campaign', 'donate', 'percent'));
    }
    public function approveOrReject($status, $id)
    {
        $campaign = Campaign::pending()->find($id);
        if (!$campaign) {
            $campaign = Campaign::extended()->find($id);
            if (!$campaign) {
                $notify[] = ['error', 'The campaign data is invalid'];
                return back()->withNotify($notify);
            }
        }

        $user  = User::findOrFail($campaign->user_id);
        $general  = gs();

        if ($status == Status::CAMPAIGN_APPROVED) {
            $campaign->status = Status::CAMPAIGN_APPROVED;
            $notifyTemplate   = 'CAMPAIGN_APPORVED';
            $notification     = "Campaign approved successfully";
        } else {
            $campaign->status = Status::CAMPAIGN_REJECTED;
            $notifyTemplate   = 'CAMPAIGN_REJECT';
            $notification     = "Campaign rejected successfully";
        }

        notify($user, $notifyTemplate, [
            'campaign' => $campaign->title,
            'deadline' => showDateTime($campaign->deadline, 'd-m-Y'),
            'goal'     => $campaign->goal . ' ' . $general->cur_text,
        ]);

        $campaign->save();
        $notify[] = ['success',  $notification];
        return back()->withNotify($notify);
    }
    protected function campaignData($scope = null)
    {
        if ($scope) {
            $campaigns = Campaign::$scope();
        } else {
            $campaigns = Campaign::query();
        }
        return $campaigns->searchable(['title'])->with('donation')->orderBy('id', 'DESC')->paginate(getPaginate());
    }

    public function pending()
    {
        $pageTitle = 'Pending Campaigns';
        $campaigns = $this->campaignData('pending');
        return view('admin.campaign.index', compact('campaigns', 'pageTitle'));
    }
    public function running()
    {
        $pageTitle = 'Running Campaigns';
        $campaigns = $this->campaignData('running');
        return view('admin.campaign.index', compact('campaigns', 'pageTitle'));
    }
    public function success()
    {
        $pageTitle = 'Successful Campaigns';
        $campaigns = $this->campaignData('completed');
        return view('admin.campaign.index', compact('campaigns', 'pageTitle'));
    }
    public function rejected()
    {
        $pageTitle = 'Rejected Campaigns';
        $campaigns = $this->campaignData('rejected');
        return view('admin.campaign.index', compact('campaigns', 'pageTitle'));
    }
    public function campaignExtend()
    {
        $pageTitle       = 'Campaign Extended Request List';
        $campaigns       = $this->campaignData('extended');
        return view('admin.campaign.extend', compact('campaigns', 'pageTitle'));
    }
    public function comments()
    {
        $pageTitle = "Campaign Comments";
        $comments  = Comment::with('campaign')->searchable(['campaign:title', 'comment'])->filter(['campaign_id'])->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.campaign.comment', compact('pageTitle', 'comments'));
    }
    public function commentApproved($id)
    {
        $comment = Comment::whereId($id)->first();
        $comment->status = 1;
        $comment->save();
        $template = 'COMMENT_APPROVED';
        $this->changeCommentStatus($comment, $template);

        $notify[] = ['success', 'Comment status changed Successfully'];
        return back()->withNotify($notify);
    }

    public function commentRejected($id)
    {

        $comment = Comment::whereId($id)->first();
        $comment->status = 2;
        $comment->save();
        $template = 'COMMENT_REJECTED';
        $this->changeCommentStatus($comment, $template);

        $notify[] = ['success', 'Comment status changed Successfully'];
        return back()->withNotify($notify);
    }

    public function changeCommentStatus($comment, $template)
    {
        $campaign = Campaign::whereId($comment->campaign_id)->first();
        $user = User::whereId($comment->user_id)->first();

        if (!isset($user)) {
            $user['fullname'] = $comment->fullname;
            $user['username'] = $comment->fullname;
            $user['email']    = $comment->email;
        }

        notify($user, $template, [
            'campaign' => $campaign->title
        ], ['email']);
    }

    public function delete($id)
    {
        $campaign = Campaign::with('galleries')->findOrFail($id);
        User::findOrFail($campaign->user_id);
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