<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{   
    public function myDonation($campaignId = 0)
    {
        $pageTitle = "My Donation";
        $donation  = Donation::paid()->where('user_id', auth()->id());
        if ($campaignId) {
            $donation = $donation->where('campaign_id', $campaignId);
        }
        $donations = $donation->with('deposit')->paginate(getPaginate());    
        return view(activeTemplate() . 'user.donation.index', compact('donations', 'pageTitle'));
    }
      
    public function receivedDonation($campaignId = 0)
    {
        $pageTitle = "Received Donation";
        $donation  = Donation::paid()->whereHas('campaign',function($q){
            $q->where('user_id',auth()->id());
        });
        if ($campaignId) {
            $donation =  $donation->where('campaign_id', $campaignId);
        }
        $donations = $donation->with('deposit')->paginate(getPaginate());
        return view(activeTemplate() . 'user.donation.index', compact('donations', 'pageTitle'));
    } 
    public function details($id)
    {
        $pageTitle = "Donor Information";
        $donor     = Donation::with('deposit', 'deposit.gateway:code,alias')->findOrFail($id);
        return view(activeTemplate() . 'user.donation.details', compact('pageTitle', 'donor'));
    }
}