<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Frontend;

class PageBuilderController extends Controller
{


    public $activeTemplate;

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();

        $className = get_called_class();
    }


    public function managePages()
    {
        $key = 'policy_pages';
        $section = @getPageSections()->$key;
        if (!$section) {
            return abort(404);
        }
        $content = Frontend::where('data_keys', $key . '.content')->orderBy('id','desc')->first();
        $elements = Frontend::where('data_keys', $key . '.element')->orderBy('id')->orderBy('id','desc')->get();
        $pdata = Page::where('tempname',$this->activeTemplate)->get();
        activeTemplate();
        $pageTitle = 'Manage Page';
        return view('admin.frontend.builder.pages', compact('section', 'content', 'elements', 'key','pageTitle','pdata'));

    }

    public function managePagesSave(Request $request){

        $request->validate([
            'name' => 'required|min:3|string|max:40',
            'slug' => 'required|min:3|string|max:40',
        ]);

        $exist = Page::where('tempname', activeTemplate())->where('slug', slug($request->slug))->exists();
        if($exist){
            $notify[] = ['error', 'This page already exists on your current template. Please change the slug.'];
            return back()->withNotify($notify);
        }
        $page = new Page();
        $page->tempname = activeTemplate();
        $page->name = $request->name;
        $page->slug = slug($request->slug);
        $page->save();
        $notify[] = ['success', 'New page added successfully'];
        return back()->withNotify($notify);

    }

    public function managePagesUpdate(Request $request){

        $page = Page::where('id',$request->id)->firstOrFail();

        $rules = [
            'name' => 'required|min:3|string|max:40',
            'slug' => 'required|string|max:40',
        ];
        if ($request->slug !== '/') {
            $rules['slug'] .= '|min:3';
        } else {
            $rules['slug'] = 'required|min:1';
        }
        $slug = $request->slug == '/' ? '/' : slug($request->slug);

        $exist = Page::where('tempname', activeTemplate())->where('slug',$slug)->first();
        if(($exist) && $exist->slug != $page->slug){
            $notify[] = ['error', 'This page already exist on your current template. please change the slug.'];
            return back()->withNotify($notify);
        }

        $page->name = $request->name;
        $page->slug = $slug;
        $page->header_status = $request->header_status ? 1 : 0;
        $page->footer_status = $request->footer_status ? 1 : 0;
        $page->save();

        $notify[] = ['success', 'Page updated successfully'];
        return back()->withNotify($notify);

    }

    public function managePagesDelete($id){
        $page = Page::where('id',$id)->firstOrFail();
        $page->delete();
        $notify[] = ['success', 'Page deleted successfully'];
        return back()->withNotify($notify);
    }



    public function manageSection($id)
    {
        $pdata = Page::findOrFail($id);
        $pageTitle = 'Manage Section of ' . $pdata->name;
        $allsections = getPageSections(true);
        $sectionsKeys = array_keys($allsections);
        $pdataSecsKeys = json_decode($pdata->secs, true) ?: [];
        $sectionsToDisplayKeys = array_diff($sectionsKeys, $pdataSecsKeys);
        $sectionsToDisplay = [];
        foreach ($sectionsToDisplayKeys as $key) {
            $sections[$key] = $allsections[$key];
        }
        return view('admin.frontend.builder.index', compact('pageTitle','pdata','sections', 'allsections'));
    }


    public function manageSectionUpdate($id, Request $request)
    {
        $request->validate([
            'secs' => 'nullable|array',
        ]);

        $page = Page::findOrFail($id);
        if (!$request->secs) {
            $page->secs = null;
        }else{
            $page->secs = json_encode($request->secs);
        }
        $page->save();
        $notify[] = ['success', 'Page sections updated successfully'];
        return back()->withNotify($notify);
    }
}
