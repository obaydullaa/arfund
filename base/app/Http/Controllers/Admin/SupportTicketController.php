<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Traits\SupportTicketManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SupportTicketController extends Controller
{
    use SupportTicketManager;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->guard('admin')->user();
            return $next($request);
        });

        $this->userType = 'admin';
        $this->column = 'admin_id';
    }

    public function tickets()
    {
        $pageTitle = 'Support Tickets';
        $query = SupportTicket::query();
        if(request()->ticket || request()->email || request()->status || request()->date_time)
        {
            $items = $this->ticketSearch(request()->except('_token'));

            return view('admin.support.tickets', compact('items', 'pageTitle'));
        }
        $items = $query->orderBy('id','desc')->with('user')->paginate(getPaginate());
        return view('admin.support.tickets', compact('items', 'pageTitle'));
    }


    public function pendingTicket()
    {
        $pageTitle = 'Pending Tickets';
        $query = SupportTicket::query();
        if(request()->ticket || request()->email || request()->status || request()->date_time)
        {
            $items = $this->ticketSearch(request()->except('_token'));

            return view('admin.support.tickets', compact('items', 'pageTitle'));
        }
        $items = $query->whereIn('status', [Status::TICKET_OPEN,Status::TICKET_REPLY])->orderBy('id','desc')->with('user')->paginate(getPaginate());
        return view('admin.support.tickets', compact('items', 'pageTitle'));
    }

    public function closedTicket()
    {
        $pageTitle = 'Closed Tickets';
        $query = SupportTicket::query();
        if(request()->ticket || request()->email || request()->status || request()->date_time)
        {
            $items = $this->ticketSearch(request()->except('_token'));

            return view('admin.support.tickets', compact('items', 'pageTitle'));
        }
        $items = $query->where('status',Status::TICKET_CLOSE)->orderBy('id','desc')->with('user')->paginate(getPaginate());
        return view('admin.support.tickets', compact('items', 'pageTitle'));
    }

    public function answeredTicket()
    {
        $pageTitle = 'Answered Tickets';
        $query = SupportTicket::query();
        if(request()->ticket || request()->email || request()->status || request()->date_time)
        {
            $items = $this->ticketSearch(request()->except('_token'));

            return view('admin.support.tickets', compact('items', 'pageTitle'));
        }
        $items = $query->orderBy('id','desc')->with('user')->where('status',Status::TICKET_ANSWER)->paginate(getPaginate());
        return view('admin.support.tickets', compact('items', 'pageTitle'));
    }

    public function ticketReply($id)
    {
        $ticket = SupportTicket::with('user')->where('id', $id)->firstOrFail();
        $pageTitle = 'Reply Ticket';
        $messages = SupportMessage::with('ticket','admin','attachments')->where('support_ticket_id', $ticket->id)->orderBy('id','desc')->get();
        return view('admin.support.reply', compact('ticket', 'messages', 'pageTitle'));
    }

    public function ticketDelete($id)
    {
        $message = SupportMessage::findOrFail($id);
        $path = getFilePath('ticket');
        if ($message->attachments()->count() > 0) {
            foreach ($message->attachments as $attachment) {
                fileManager()->removeFile($path.'/'.$attachment->attachment);
                $attachment->delete();
            }
        }
        $message->delete();
        $notify[] = ['success', "Support ticket deleted successfully"];
        return back()->withNotify($notify);

    }


    public function ticketSearch($data)
    {
        $query = SupportTicket::query();

        if($data['ticket'])
        {
            $query = $query->where('ticket', $data['ticket']);
        }
        if($data['email'])
        {
            $query = $query->where('email', $data['email']);
        }
        if($data['status'])
        {
            $query = $query->where('status', $data['status'] == 4 ? 0 : $data['status']);

        }
        if($data['date_time'])
        {
            $query = $query->whereDate('created_at', $data['date_time']);
        }
        $items = $query->orderBy('id','desc')->with('user')->paginate(getPaginate());

        return $items;

    }

}
