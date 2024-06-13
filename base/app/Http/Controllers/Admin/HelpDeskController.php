<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpDesk;
use App\Constants\Status;
use Illuminate\Http\Request;

class HelpDeskController extends Controller
{
    public function index()
    {
        $pageTitle = 'Help Desk';
        $supports = HelpDesk::orderBy('id','desc')->paginate(getPaginate(10));
        return view('admin.help_desk.index', compact('pageTitle', 'supports'));
    }
    public function status($id)
    {
        return HelpDesk::changeStatus($id, 'reply_status');
    }

    public function delete($id)
    {
        $support = HelpDesk::findOrFail($id)->delete();
        $notify[] = ['success', 'Deleted successfully'];
        return back()->withNotify($notify);
    }

    public function repliedDeleteAll()
    {
        $cronJob = HelpDesk::where('reply_status', Status::ENABLE)->each()->delete();

        $notify[] = ['success', 'All replied logs flushed successfully'];
        return back()->withNotify($notify);
    }
}
