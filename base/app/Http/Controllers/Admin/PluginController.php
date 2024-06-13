<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use Illuminate\Http\Request;

class PluginController extends Controller
{
    public function index()
    {
        $pageTitle = 'Plugins';
        $plugins = Plugin::orderBy('name')->get();
        if(request()->search_table)
        {
            $searchTerm = request()->input('search_table');

            $plugins = Plugin::query()
                ->where(function ($query) use ($searchTerm) {
                    $query->where('act', 'like', "%$searchTerm%")
                          ->orWhere('name', 'like', "%$searchTerm%");
                })
                ->orderBy('name')
                ->get();

        }
        return view('admin.plugin.index', compact('pageTitle', 'plugins'));
    }

    public function update(Request $request, $id)
    {
        $plugin = Plugin::findOrFail($id);
        $validationRule = [];
        foreach ($plugin->shortcode as $key => $val) {
            $validationRule = array_merge($validationRule,[$key => 'required']);
        }
        $request->validate($validationRule);

        $shortcode = json_decode(json_encode($plugin->shortcode), true);
        foreach ($shortcode as $key => $value) {
            $shortcode[$key]['value'] = $request->$key;
        }

        $plugin->shortcode = $shortcode;
        $plugin->save();
        $notify[] = ['success', $plugin->name . ' updated successfully'];
        return back()->withNotify($notify);
    }

    public function status($id)
    {
        return Plugin::changeStatus($id);
    }
}
