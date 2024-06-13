<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Frontend;
use App\Models\SiteSetting;
use App\Models\HelpDesk;
use App\Models\Language;
use App\Models\Page;
use App\Models\Subscriber;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SiteController extends Controller
{
    public function index(){
        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle = 'Home';
        $sections = Page::where('tempname',activeTemplate())->where('slug','/')->first();
        return view(activeTemplate() . 'home', compact('pageTitle','sections'));
    }

    public function pages($slug)
    { 
        $page = Page::where('tempname',activeTemplate())->where('slug',$slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view(activeTemplate() . 'pages', compact('pageTitle','sections'));
    }
    public function blog(){
        $pageTitle = 'All Blogs';
        $sections = Page::where('tempname',activeTemplate())->where('slug','blog')->firstOrFail();
        $blogs = Frontend::where('data_keys','blog.element')->orderBy('id','desc')->paginate(getPaginate(10));
        $latests = Frontend::where('data_keys','blog.element')->orderBy('id','desc')->limit(5)->get();
        return view(activeTemplate() . 'blog', compact('sections','blogs', 'latests','pageTitle'));
    }

    public function blogDetails($slug, $id){
        $blog =  Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();
        $pageTitle = "Blog Details";
        $latests = Frontend::where('data_keys', 'blog.element')->orderBy('id', 'desc')->limit(5)->get();
        return view(activeTemplate().'blog_details',compact('blog','pageTitle','latests'));
    }
    public function contact()
    {
        $pageTitle = "Contact Us";
        $user = auth()->user();
        $sections = Page::where('tempname',activeTemplate())->where('slug','contact')->first();
        return view(activeTemplate() . 'contact',compact('pageTitle','user', 'sections'));
    }

    // All campaigns
    public function campaign(){
        $pageTitle = 'All Campaign';
        $campaigns = Campaign::where('stop', Status::NO)->where('status', Status::ENABLE)->where('completed', Status::NO)->notExpired()->latest()->paginate(getPaginate(12));               
        $categories = Category::where('status', Status::ENABLE)->inRandomOrder()->get();
        return view(activeTemplate().'campaign.index', compact('pageTitle', 'campaigns', 'categories'));
    }
    
    // Category Filter
    public function categoryCampaign($id){
        
        $category = Category::find($id);
        $pageTitle = $category->name;
        $campaigns = Campaign::where('stop', Status::NO)->where('status', Status::ENABLE)->where('category_id',$id)->where('completed', Status::NO)->where('date', '>', now())->notExpired()->latest()->paginate(getPaginate());
     
        $categories = Category::where('status', Status::ENABLE)->inRandomOrder()->get();
        return view(activeTemplate().'campaign.index',compact('pageTitle','campaigns','categories'));
    }

    // Campaign filter
    public function campaignFilter(Request $request) {
     
        $categories = $request->input('categories', []);
        $search = $request->input('search');
        $query = Campaign::with('category')->where('status', Status::ENABLE)->where('stop', Status::NO)->where('completed', Status::NO)->where('date', '>', now());

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories)->get();
        }

        if (!empty($search)) {
 
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%$search%");  
            });
        }

        $pageTitle = "Campaign Search";

        $campaigns = $query->latest()->paginate(getPaginate());

        $view = view(activeTemplate().'partials.campaign', compact('campaigns', 'categories'))->render();
        
        return response()->json([
            'html' => $view
        ]);
    }

    public function helpDesk(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
            'mobile' => 'required|string|max:20',
        ]);

        $request->session()->regenerateToken();

        if(!verifyCaptcha()){
            $notify[] = ['error','Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $desk = new HelpDesk();
        $desk->name = $request->name;
        $desk->email = $request->email;
        $desk->subject = $request->subject;
        $desk->message = $request->message;
        $desk->mobile = $request->mobile;
        $desk->reply_status = Status::DISABLE;
        $desk->save();

        $notify[] = ['success','Message sent successfully'];
        return back()->withNotify($notify);
    }
    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        $request->session()->regenerateToken();

        if(!verifyCaptcha()){
            $notify[] = ['error','Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = Status::PRIORITY_MEDIUM;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = Status::TICKET_OPEN;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new contact message has been submitted';
        $adminNotification->click_url = urlPath('admin.ticket.view',$ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug, $id)
    {
        $policy = Frontend::where('id',$id)->where('data_keys','policy_pages.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        $seoContents = $policy->seo_content;
        $seoImage = @$seoContents->image ? getImage('assets/images/frontend/policy_pages/seo/' . @$seoContents->image, getFileSize('seo')) : null;
        return view(activeTemplate().'policy',compact('policy','pageTitle','seoContents','seoImage'));
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return back();
    }
    public function cookieAccept(){
        Cookie::queue('gdpr_cookie',gs('site_name') , 43200);
    }
    public function cookieDecline(){
        $general = gs();
        Cookie::queue(Cookie::forget('gdpr_cookie'));
        return back();
    }

    public function cookiePolicy(){
        $pageTitle = 'Cookie Policy';
        $cookie = Frontend::where('data_keys','cookie.data')->first();
        return view(activeTemplate().'cookie',compact('pageTitle','cookie'));
    }

    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font/RobotoMono-Regular.ttf');
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance()
    {
        $pageTitle = 'Maintenance Mode';
        if(gs('maintenance_mode') == Status::DISABLE){
            return to_route('home');
        }
        $maintenance = Frontend::where('data_keys','maintenance.data')->first();
        return view(activeTemplate().'maintenance',compact('pageTitle','maintenance'));
    }

    public function subscribe(Request $request) {
        $request->validate([
            'email' => 'required|unique:subscribers',
        ]);
        $ip = getRealIP();
        $info = json_decode(json_encode(getIpInfo()), true);
        $subscribe = new Subscriber();
        $subscribe->email = $request->email;
        $subscribe->country =  @implode(',', $info['country']);
        $subscribe->ip =  $ip;
        $subscribe->save();
        $notify[] = ['success', 'You have successfully subscribed to the Newsletter'];
        return back()->withNotify($notify);
    }
    
}
