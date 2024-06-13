<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{
    public function methods()
    {
        $pageTitle = 'Withdrawal Methods';
        $methods = WithdrawMethod::orderBy('name')->orderBy('id')->get();
        if(request()->search_table)
        {
            $searchTerm = request()->input('search_table');
            $methods = WithdrawMethod::query()
                ->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%$searchTerm%")
                          ->orWhere('currency', 'like', "%$searchTerm%");
                })
                ->orderBy('name')
                ->get();

        }
        return view('admin.withdraw.index', compact('pageTitle', 'methods'));
    }

    public function create()
    {
        $pageTitle = 'New Withdrawal Method';
        return view('admin.withdraw.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $validation = [
            'name' => 'required',
            'rate' => 'required|numeric|gt:0',
            'currency' => 'required',
            'fixed_charge' => 'required|numeric|gte:0',
            'percent_charge' => 'required|numeric|between:0,100',
            'min_limit' => 'required|numeric|gt:fixed_charge',
            'max_limit' => 'required|numeric|gt:min_limit',
            'instruction' => 'required',
        ];


        $formProcessor = new FormProcessor();
        $generatorValidation = $formProcessor->generatorValidation();
        $validation = array_merge($validation,$generatorValidation['rules']);
        $request->validate($validation,$generatorValidation['messages']);

        $generate = $formProcessor->generate('withdraw_method');

        $method = new WithdrawMethod();
        $method->name = $request->name;
        $method->form_id = @$generate->id ?? 0;
        $method->rate = $request->rate;
        $method->min_limit = $request->min_limit;
        $method->max_limit = $request->max_limit;
        $method->fixed_charge = $request->fixed_charge;
        $method->percent_charge = $request->percent_charge;
        $method->currency = $request->currency;
        $instructions = summernoteContent($request->instruction);
        $method->description    = $instructions;

        if ($request->hasFile('image')) {
            try {
                $method->image = fileUploader($request->image, getFilePath('gateway'), getFileSize('gateway'));
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $method->save();


        $notify[] = ['success', 'Withdraw method added successfully'];
        return to_route('admin.withdraw.method.index')->withNotify($notify);
    }


    public function edit($id)
    {
        $pageTitle = 'Update Withdrawal Method';
        $method = WithdrawMethod::with('form')->findOrFail($id);
        $form = $method->form;
        return view('admin.withdraw.edit', compact('pageTitle', 'method','form'));
    }

    public function update(Request $request, $id)
    {
        $validation = [
            'name'           => 'required',
            'min_limit'      => 'required|numeric|gt:0',
            'max_limit'      => 'required|numeric|gt:min_limit',
            'fixed_charge'   => 'required|numeric|gte:0',
            'percent_charge' => 'required|numeric|between:0,100',
            'currency'       => 'required',
            'instruction'    => 'required'
        ];

        $formProcessor = new FormProcessor();
        $generatorValidation = $formProcessor->generatorValidation();
        $validation = array_merge($validation,$generatorValidation['rules']);
        $request->validate($validation,$generatorValidation['messages']);

        $method = WithdrawMethod::findOrFail($id);

        $generate = $formProcessor->generate('withdraw_method',true,'id',$method->form_id);
        $method->form_id        = @$generate->id ?? 0;
        $method->name           = $request->name;
        $method->rate           = $request->rate;
        $method->min_limit      = $request->min_limit;
        $method->max_limit      = $request->max_limit;
        $method->fixed_charge   = $request->fixed_charge;
        $method->percent_charge = $request->percent_charge;

        $method->currency       = $request->currency;


        $instructions = summernoteContent($request->instruction, $method->description);
        $method->description    = $instructions;
        if ($request->hasFile('image')) {
            try {
                $old = $method->image;
                $method->image = fileUploader($request->image, getFilePath('gateway'), getFileSize('gateway'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $method->save();


        $notify[] = ['success', 'Withdraw method updated successfully'];
        return back()->withNotify($notify);
    }


    public function status($id)
    {
        return WithdrawMethod::changeStatus($id);
    }

}
