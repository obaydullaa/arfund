<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Models\Gateway;
use App\Models\GatewayCurrency;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class ManualGatewayController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manual Gateways';
        $gateways = Gateway::manual()->orderBy('id','desc')->get();
        if(request()->search_table)
        {
            $searchTerm = request()->input('search_table');
            $gateways = Gateway::query()
                ->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%$searchTerm%");
                })
                ->orderBy('name')
                ->get();

        }
        return view('admin.gateways.manual.list', compact('pageTitle', 'gateways'));
    }

    public function create()
    {
        $pageTitle = 'Add Manual Gateway';
        return view('admin.gateways.manual.create', compact('pageTitle'));
    }


    public function store(Request $request)
    {
        $formProcessor = new FormProcessor();
        $this->validation($request,$formProcessor);

        $lastMethod = Gateway::manual()->orderBy('id','desc')->first();
        $methodCode = 1000;
        if ($lastMethod) {
            $methodCode = $lastMethod->code + 1;
        }

        $generate = $formProcessor->generate('manual_deposit');

        $method = new Gateway();
        $method->code = $methodCode;
        $method->form_id = @$generate->id ?? 0;
        $method->name = $request->name;
        $method->alias = strtolower(trim(str_replace(' ','_',$request->name)));
        $method->status = Status::ENABLE;
        $method->gateway_parameters = json_encode([]);
        $method->supported_currencies = [];
        $method->crypto = Status::DISABLE;
        $instruction = summernoteContent($request->instruction, $previousData = false);
        $method->description = $instruction;
        if ($request->hasFile('image')) {
            try {
                $method->image = fileUploader($request->image, getFilePath('gateway'), getFileSize('gateway'));
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        $method->save();

        $gatewayCurrency = new GatewayCurrency();
        $gatewayCurrency->name = $request->name;
        $gatewayCurrency->gateway_alias = strtolower(trim(str_replace(' ','_',$request->name)));
        $gatewayCurrency->currency = $request->currency;
        $gatewayCurrency->symbol = '';
        $gatewayCurrency->method_code = $methodCode;
        $gatewayCurrency->min_amount = $request->min_limit;
        $gatewayCurrency->max_amount = $request->max_limit;
        $gatewayCurrency->fixed_charge = $request->fixed_charge;
        $gatewayCurrency->percent_charge = $request->percent_charge;
        $gatewayCurrency->rate = $request->rate;
        $gatewayCurrency->save();

        $notify[] = ['success', $method->name . ' Manual gateway has been added.'];
        return back()->withNotify($notify);
    }

    public function edit($alias)
    {
        $pageTitle = 'Edit Manual Gateway';
        $method = Gateway::manual()->with('singleCurrency')->where('alias', $alias)->firstOrFail();
        $form = $method->form;
        return view('admin.gateways.manual.edit', compact('pageTitle', 'method','form'));
    }

    public function update(Request $request, $code)
    {
        $formProcessor = new FormProcessor();
        $this->validation($request,$formProcessor);

        $method = Gateway::manual()->where('code', $code)->firstOrFail();

        $generate = $formProcessor->generate('manual_deposit',true,'id',$method->form_id);
        $method->name = $request->name;
        $method->alias = strtolower(trim(str_replace(' ','_',$request->name)));
        $method->gateway_parameters = json_encode([]);
        $method->supported_currencies = [];
        $method->crypto = Status::DISABLE;

        $instruction = summernoteContent($request->instruction, $method->description);
        $method->description = $instruction;
        $method->form_id = @$generate->id ?? 0;

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

        $singleCurrency = $method->singleCurrency;
        $singleCurrency->name = $request->name;
        $singleCurrency->gateway_alias = strtolower(trim(str_replace(' ','_',$method->name)));
        $singleCurrency->currency = $request->currency;
        $singleCurrency->symbol = '';
        $singleCurrency->min_amount = $request->min_limit;
        $singleCurrency->max_amount = $request->max_limit;
        $singleCurrency->fixed_charge = $request->fixed_charge;
        $singleCurrency->percent_charge = $request->percent_charge;
        $singleCurrency->rate = $request->rate;
        $singleCurrency->save();

        $notify[] = ['success', $method->name . ' manual gateway updated successfully'];
        return to_route('admin.gateway.manual.edit',[$method->alias])->withNotify($notify);
    }

    private function validation($request,$formProcessor)
    {
        $validation = [
            'name'           => 'required',
            'rate'           => 'required|numeric|gt:0',
            'currency'       => 'required',
            'min_limit'      => 'required|numeric|gt:0',
            'max_limit'      => 'required|numeric|gt:min_limit',
            'fixed_charge'   => 'required|numeric|gte:0',
            'percent_charge' => 'required|numeric|between:0,100',
            'instruction'    => 'required',
            'image' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])]
        ];

        $generatorValidation = $formProcessor->generatorValidation();
        $validation = array_merge($validation,$generatorValidation['rules']);
        $request->validate($validation,$generatorValidation['messages']);
    }

    public function status($id)
    {
        return Gateway::changeStatus($id);
    }
}
