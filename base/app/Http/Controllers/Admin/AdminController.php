<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\AdminNotification;
use App\Models\Campaign;
use App\Models\Deposit;
use App\Models\HelpDesk;
use App\Models\SupportTicket;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function dashboard()
    {
        $pageTitle = 'Dashboard';

        $widget['total_users']             = User::count();
        $widget['verified_users']          = User::active()->count();
        $widget['email_unverified_users']  = User::emailUnverified()->count();
        $widget['mobile_unverified_users'] = User::mobileUnverified()->count();

        $deposit['total_deposit_amount']        = Deposit::successful()->sum('amount');
        $deposit['total_deposit_pending']       = Deposit::pending()->count();
        $deposit['total_deposit_rejected']      = Deposit::rejected()->count();
        $deposit['total_deposit_charge']        = Deposit::successful()->sum('charge');

        $withdrawals['total_withdraw_amount']   = Withdrawal::approved()->sum('amount');
        $withdrawals['total_withdraw_pending']  = Withdrawal::pending()->count();
        $withdrawals['total_withdraw_rejected'] = Withdrawal::rejected()->count();
        $withdrawals['total_withdraw_charge']   = Withdrawal::approved()->sum('charge');

        $campaigns['all_campaign'] = Campaign::count();
        $campaigns['pending']        = Campaign::pending()->count();
        $campaigns['running']        = Campaign::active()->running()->inComplete()->count();
        $campaigns['rejected']      = Campaign::where('status', status::REJECTED)->count();


        $trxReport['date'] = collect([]);

        $plusTrx = Transaction::where('trx_type', '+')
                    ->where('created_at', '>=', Carbon::now()->subDays(30))
                    ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at, '%Y-%m-%d') as date")
                    ->orderBy('date')
                    ->groupBy('date')
                    ->get();


        $plusTrx->map(function ($trxData) use ($trxReport) {
            $trxReport['date']->push($trxData->date);
        });


        $minusTrx = Transaction::where('trx_type', '-')
                    ->where('created_at', '>=', Carbon::now()->subDays(30))
                    ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at, '%Y-%m-%d') as date")
                    ->orderBy('date')
                    ->groupBy('date')
                    ->get();


        $minusTrx->map(function ($trxData) use ($trxReport) {
            $trxReport['date']->push($trxData->date);
        });

        $trxReport['date'] = dateSorting($trxReport['date']->unique()->toArray());


        $report['months'] = collect([]);
        $report['deposit_month_amount'] = collect([]);
        $report['withdraw_month_amount'] = collect([]);

        $depositsMonth = Deposit::where('created_at', '>=', Carbon::now()->subYear())
                    ->where('status', Status::PAYMENT_SUCCESS)
                    ->selectRaw("SUM(CASE WHEN status = ".Status::PAYMENT_SUCCESS." THEN amount END) as depositAmount")
                    ->selectRaw("DATE_FORMAT(created_at,'%M-%Y') as months")
                    ->orderBy('months')
                    ->groupBy('months')
                    ->get();



        $depositsMonth->map(function ($depositData) use ($report) {
            $report['months']->push($depositData->months);
            $report['deposit_month_amount']->push(getAmount($depositData->depositAmount));
        });

        $withdrawalMonth = Withdrawal::where('created_at', '>=', Carbon::now()->subYear())->where('status', Status::PAYMENT_SUCCESS)
            ->selectRaw("SUM( CASE WHEN status = ".Status::PAYMENT_SUCCESS." THEN amount END) as withdrawAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M-%Y') as months")
            ->orderBy('months')
            ->groupBy('months')->get();
        $withdrawalMonth->map(function ($withdrawData) use ($report){
            if (!in_array($withdrawData->months,$report['months']->toArray())) {
                $report['months']->push($withdrawData->months);
            }
            $report['withdraw_month_amount']->push(getAmount($withdrawData->withdrawAmount));
        });

        $months = $report['months'];

        for($i = 0; $i < $months->count(); ++$i) {
            $monthVal      = Carbon::parse($months[$i]);
            if(isset($months[$i+1])){
                $monthValNext = Carbon::parse($months[$i+1]);
                if($monthValNext < $monthVal){
                    $temp = $months[$i];
                    $months[$i]   = Carbon::parse($months[$i+1])->format('F-Y');
                    $months[$i+1] = Carbon::parse($temp)->format('F-Y');
                }else{
                    $months[$i]   = Carbon::parse($months[$i])->format('F-Y');
                }
            }
        }


        // Newly added
        $users = User::latest('id')->take(5)->get();
        $tickets = SupportTicket::latest('id')->with('user')->take(4)->get();
        $guestSupports = HelpDesk::latest('id')->take(5)->get();


        return view('admin.dashboard', compact('pageTitle', 'campaigns', 'widget', 'deposit','withdrawals','depositsMonth','withdrawalMonth','months','trxReport','plusTrx','minusTrx', 'users', 'tickets', 'guestSupports'));
    }


    public function profile()
    {
        $pageTitle = 'Profile';
        $admin = auth('admin')->user();
        return view('admin.profile', compact('pageTitle', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])],
            'username' => 'required',
        ]);
        $user = auth('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image;
                $user->image = fileUploader($request->image, getFilePath('adminProfile'), getFileSize('adminProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->save();
        $notify[] = ['success', 'Profile updated successfully'];
        return to_route('admin.profile')->withNotify($notify);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = auth('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password doesn\'t match!!'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return to_route('admin.profile')->withNotify($notify);
    }

    public function notifications(){
        $notifications = AdminNotification::orderBy('id','desc')->with('user')->paginate(getPaginate());
        $pageTitle = 'Notifications';
        return view('admin.notifications',compact('pageTitle','notifications'));
    }


    public function notificationRead($id){
        $notification = AdminNotification::findOrFail($id);
        $notification->is_read = Status::YES;
        $notification->save();
        $url = $notification->click_url;
        if ($url == '#') {
            $url = url()->previous();
        }
        return redirect($url);
    }

    public function readAll(){
        AdminNotification::where('is_read',Status::NO)->update([
            'is_read'=>Status::YES
        ]);
        $notify[] = ['success','Notifications read successfully'];
        return back()->withNotify($notify);
    }

    public function downloadAttachment($fileHash)
    {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $title = slug(gs('site_name')).'- attachments.'.$extension;
        $mimetype = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }


    public function loadData(Request $request)
    {
        $modelName = $request->model_name;
        $query     = "App\\Models\\$modelName"::query()->skip($request->skip)
            ->take($request->take);

        if ($modelName == 'Deposit') {
            $query->with('currency')->where('status', '!=', Status::PAYMENT_INITIATE)->where('status', '!=', Status::PAYMENT_REJECT)
                ->groupBy('currency_id')
                ->selectRaw('*,SUM(amount) as total_amount')
                ->orderBy('total_amount', 'DESC');
        }
        if ($modelName == 'Withdrawal') {
            $query->with('withdrawCurrency')->where('status', '!=', Status::PAYMENT_REJECT)
                ->groupBy('currency')
                ->selectRaw('*,SUM(amount) as total_amount')
                ->orderBy('total_amount', 'DESC');
        }

        $data      = $query->skip($request->skip)->take($request->take)->get();
        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }

}
