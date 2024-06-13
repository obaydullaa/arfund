<?php

namespace App\Models;


use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Searchable, GlobalStatus;

    public function campaigns()
    {
        return $this->hasMany(Campaign::class)->where('status', 1);
    }
}
