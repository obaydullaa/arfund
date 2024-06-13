<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Frontend;
use App\Models\SiteSetting;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Image;

class SiteSettingController extends Controller
{
    public function index()
    {
        $pageTitle = 'Setting Management';
        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        $currentTimezone = array_search(config('app.timezone'),$timezones);
        return view('admin.setting.site_setting', compact('pageTitle','timezones','currentTimezone'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:40',
            'cur_text' => 'required|string|max:40',
            'cur_sym' => 'required|string|max:40',
            'base_color' => 'nullable|regex:/^[a-f0-9]{6}$/i',
            'secondary_color' => 'nullable|regex:/^[a-f0-9]{6}$/i',
            'timezone' => 'required|integer',
            'date_format' => 'required'
        ]);

        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        $timezone = @$timezones[$request->timezone] ?? 'UTC';

        $general = gs();
        $general->site_name = $request->site_name;
        $general->cur_text = $request->cur_text;
        $general->cur_sym = $request->cur_sym;
        $general->base_color = str_replace('#','',$request->base_color);
        $general->date_format = $request->date_format;
        $general->save();

        $timezoneFile = config_path('timezone.php');
        $content = '<?php $timezone = "'.$timezone.'" ?>';
        file_put_contents($timezoneFile, $content);
        $notify[] = ['success', 'General setting updated successfully'];
        return back()->withNotify($notify);
    }

    public function systemConfiguration(){
        $pageTitle = 'System Configuration';
        return view('admin.setting.configuration', compact('pageTitle'));
    }


    public function systemConfigurationSubmit(Request $request)
    {
        $general = gs();
        $general->kv = $request->kv ? Status::ENABLE : Status::DISABLE;
        $general->ev = $request->ev ? Status::ENABLE : Status::DISABLE;
        $general->en = $request->en ? Status::ENABLE : Status::DISABLE;
        $general->sv = $request->sv ? Status::ENABLE : Status::DISABLE;
        $general->sn = $request->sn ? Status::ENABLE : Status::DISABLE;
        $general->force_ssl = $request->force_ssl ? Status::ENABLE : Status::DISABLE;
        $general->secure_password = $request->secure_password ? Status::ENABLE : Status::DISABLE;
        $general->registration = $request->registration ? Status::ENABLE : Status::DISABLE;
        $general->agree = $request->agree ? Status::ENABLE : Status::DISABLE;
        $general->language_status = $request->language_status ? Status::ENABLE : Status::DISABLE;
        $general->save();
        $notify[] = ['success', 'System configuration updated successfully'];
        return back()->withNotify($notify);
    }


    public function logoIcon()
    {
        $pageTitle = 'Logo & Favicon';
        return view('admin.setting.logo_icon', compact('pageTitle'));
    }

    public function logoIconUpdate(Request $request)
    {
        $request->validate([
            'logo' => ['image',new FileTypeValidate(['jpg','jpeg','png'])],
            'logo_white' => ['image',new FileTypeValidate(['jpg','jpeg','png'])],
            'favicon' => ['image',new FileTypeValidate(['png'])],
        ]);
        $general = SiteSetting::first();

        if ($request->hasFile('logo')) {
            try {
                $thumb = '300x84';
                $path                   = getFilePath('logoIcon');
                fileManager()->removeFile($path . '/' . 'thumb_' . $general->image->logo);
                $logo = fileUploader($request->logo,getFilePath('logoIcon'),getFileSize('logoIcon'),$general->image->logo, $thumb);
                $general->image = [
                    'logo' => $logo,
                    'logo_white' => $general->image->logo_white,
                    'favicon' => $general->image->favicon,
                ];
                $general->save();

            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logo'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $favicon = fileUploader($request->favicon,getFilePath('logoIcon'),getFileSize('favicon'),$general->image->favicon);
                $general->image = [
                    'logo' => $general->image->logo,
                    'logo_white' => $general->image->logo_white,
                    'favicon' => $favicon,
                ];
                $general->save();
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the favicon'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('logo_white')) {
            try {
                $logo_white = fileUploader($request->logo_white,getFilePath('logoIcon'),getFileSize('logoIcon'),$general->image->logo_white);
                $general->image = [
                    'logo' => $general->image->logo,
                    'logo_white' => $logo_white,
                    'favicon' => $general->image->favicon,
                ];
                $general->save();
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logod'];
                return back()->withNotify($notify);
            }
        }

        $generalCache = Cache::get('SiteSetting');
        if ($generalCache) {
            Cache::forget('SiteSetting');
        }
        Cache::put('SiteSetting', $general);
        $notify[] = ['success', 'Logo & favicon updated successfully'];
        return back()->withNotify($notify);
    }

    public function customCss(){
        $pageTitle = 'Custom CSS';
        $file = activeTemplate(true).'css/custom.css';
        $fileContent = @file_get_contents($file);
        return view('admin.setting.custom_css',compact('pageTitle','fileContent'));
    }


    public function customCssSubmit(Request $request){
        $file = activeTemplate(true).'css/custom.css';
        if (!file_exists($file)) {
            fopen($file, "w");
        }
        file_put_contents($file,$request->css);
        $notify[] = ['success','CSS updated successfully'];
        return back()->withNotify($notify);
    }

    public function maintenanceMode()
    {
        $pageTitle = 'Maintenance Mode';
        $maintenance = Frontend::where('data_keys','maintenance.data')->firstOrFail();
        return view('admin.setting.maintenance',compact('pageTitle','maintenance'));
    }

    public function maintenanceModeSubmit(Request $request)
    {
        $request->validate([
            'description'=>'required'
        ]);
        $general = SiteSetting::first();
        $general->maintenance_mode = $request->status ? Status::ENABLE : Status::DISABLE;
        $general->save();
        $maintenance = Frontend::where('data_keys','maintenance.data')->firstOrFail();


        $description = $maintenance->data_values->description;

        $description = summernoteContent($request->description, $maintenance->data_values->description);
        $maintenance->data_values = ['description' => $description];
        $maintenance->save();


        $notify[] = ['success','Maintenance mode updated successfully'];
        return back()->withNotify($notify);
    }

    public function cookie(){
        $pageTitle = 'GDPR Cookie';
        $cookie = Frontend::where('data_keys','cookie.data')->firstOrFail();
        return view('admin.setting.cookie',compact('pageTitle','cookie'));
    }

    public function cookieSubmit(Request $request){
        $request->validate([
            'short_desc'=>'required|string|max:255',
            'description'=>'required',
        ]);
        $cookie = Frontend::where('data_keys','cookie.data')->firstOrFail();

        $description = summernoteContent($request->description, $cookie->data_values->description);

        $cookie->data_values = [
            'short_desc' => $request->short_desc,
            'description' => $description,
            'status' => $request->status ? Status::ENABLE : Status::DISABLE,
        ];
        $cookie->save();
        $notify[] = ['success','Cookie policy updated successfully'];
        return back()->withNotify($notify);
    }
}
