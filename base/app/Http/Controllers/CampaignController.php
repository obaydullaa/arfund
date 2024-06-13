<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\Campaign;
use App\Models\Comment;
use App\Models\Page;
use Illuminate\Http\Request;
use SendGrid\Mail\Category;

class CampaignController extends Controller
{
    public function details($slug, $id)
    {
        $pageTitle = 'Campaign Details';
        $campaign = Campaign::with('category')->findOrFail($id);
        $campaign['commentCount']        = Comment::whereCampaignId($id)->where('status', Status::YES)->count();
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        return view(activeTemplate() . 'campaign.details', compact('pageTitle', 'campaign', 'countries'));
    }

    public function comment(Request $request)
    {
        $request->validate([
            'campaign' => 'required|numeric',
            'comment'  => 'required|min:4|max:2000',
        ]);

        if (auth()->check()) {
            $user = auth()->user();

            $comment = new Comment();
            $comment->user_id = $user->id;
            $comment->campaign_id = $request->campaign;
            $comment->fullname    = $user->fullname;
            $comment->email       = $user->email;
            $comment->comment     = $request->comment;
        } else {
            $request->validate([
                'fullname' => 'required|min:3|max:40',
                'email'    => 'required|email',
            ]);

            $comment = new Comment();
            $comment->campaign_id = $request->campaign;
            $comment->fullname    = $request->fullname;
            $comment->email       = $request->email;
            $comment->comment     = $request->comment;
        }
        $comment->save();

        $notify[] = ['success', 'Comment saved successfully, Please wait for publish'];
        return back()->withNotify($notify);
    }
}