<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Page extends Model
{
    public function headerBadge(): Attribute
    {
        return new Attribute(
            get:fn () => $this->headerBadgeData(),
        );
    }


    public function headerBadgeData(){
        $html = '';
        if($this->header_status == 1){
            $html = '<span class="badge badge--success">'.trans('Yes').'</span>';
        }else {
            $html = '<span class="badge badge--warning">'.trans('No').'</span>';
        }

        return $html;
    }

    public function footerBadge(): Attribute
    {
        return new Attribute(
            get:fn () => $this->footerBadgeData(),
        );
    }


    public function footerBadgeData(){
        $html = '';
        if($this->footer_status == 1){
            $html = '<span class="badge badge--success">'.trans('Yes').'</span>';
        }else {
            $html = '<span class="badge badge--warning">'.trans('No').'</span>';
        }

        return $html;
    }
}
