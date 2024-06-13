<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalStatus;
use App\Constants\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;


class HelpDesk extends Model
{
    use GlobalStatus;

    public function statusBadge(): Attribute
    {
        return new Attribute(function(){
            $html = '';
            if($this->reply_status == Status::ENABLE){
                $html = '<span class="badge badge--success">'.trans('Replied').'</span>';
            }else{
                $html = '<span class="badge badge--warning">'.trans('Initiated').'</span>';
            }
            return $html;
        });
    }
}
