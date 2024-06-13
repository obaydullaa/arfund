<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Campaign extends Model
{
    use HasFactory;
    use Searchable;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function donation()
    {
        return $this->hasMany(Donation::class);
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }  
    
    public function scopeExpired($query)
    {
        return $query->where('date', '<', now());
    }
    public function scopeExpiredAndNotCompleted($query)
    {
        return $query->where('date', '<', now())->where('completed', Status::NO);
    }
    public function scopeApproved($query)
    {
        return $query->where('date', '<', now())->where('completed', Status::NO);
    }

    public function scopeNotExpired($query)
    {
        return $query->whereDate('date', '>', now());
    }
    public function scopeActive($query)
    {
        return $query->where('status', Status::CAMPAIGN_APPROVED)->where('completed', Status::NO)->where('date', '>', now());
    }   
    public function scopeApprovedCampaign($query)
    {
        return $query->where('status', Status::CAMPAIGN_APPROVED)->where('completed', Status::NO);
    }   
     public function scopeExtended($query)
    {
        return $query->where('status', Status::PENDING)->where('is_extend', Status::YES);
    }
    public function scopeSuccess($query)
    {
        return $query->where('status', Status::CAMPAIGN_APPROVED)->where('success', Status::YES);
    }
    public function scopeRejected($query)
    {
        return $query->where('status', Status::REJECTED);
    }
    public function scopePending($query)
    {
        return $query->where('status', Status::PENDING)->where('date', '>', now());
    }
    public function scopeCompleted($query)
    {
        return $query->where('completed', Status::YES);
    }
    public function scopeInComplete($query)
    {
        return $query->where('completed', Status::NO);
    }
    public function scopeRunning($query)
    {
        return $query->active()->where('stop', Status::NO)->where('success', Status::NO)->whereDate('date', '>', now());
    }
    public function statusBadge(): Attribute
    {
        return new Attribute(
            function () {
                $html = '';
                if ($this->date < now()) {
                    $html = '<span class="badge badge--info">' . trans("Expired") . '</span>';
                } elseif ($this->status == Status::CAMPAIGN_APPROVED) {
                    $html = '<span class="badge badge--success">' . trans("Approved") . '</span>';
                } elseif ($this->status == Status::REJECTED) {
                    $html = '<span class="badge badge--danger">' . trans("Rejected") . '</span>';
                }elseif ($this->completed == Status::YES ) {
                    $html = '<span class="badge badge--success">' . trans("Completed") . '</span>';
                }  elseif ($this->status == Status::PENDING) {
                    $html = '<span class="badge badge--warning">' . trans("Pending") . '</span>';
              
                }
                return $html;
            }
        );
    }
}
