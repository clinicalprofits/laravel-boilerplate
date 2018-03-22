<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Edujugon\GoogleAds\GoogleAds;
use Google\AdsApi\AdWords\v201708\cm\CampaignService;



class AwTestController extends Controller
{
    
    public $ads;
    

    public function index()
    {
        
        $ads = $this->ads;
        
        $ads = new GoogleAds();
        
        $campaignService = $ads->service(CampaignService::class)
            ->select('Id','Name')
            ->where('Id = 139333324')
            ->get();
        dd($campaignService);    
        $campaign = $campaignService->select('CampaignId','CampaignName')->get();
        dd($campaign);    
        return $campaign;    
        
        
    }
    
    
    
    
    public function getCampaignPerformanceReport()
    {
        $this->ads = new GoogleAds();
        $ads = $this->ads;
        $report = $ads->report();
        
        $obj = $report
            ->from('CAMPAIGN_PERFORMANCE_REPORT')
            ->during('20180101','20180201')
            ->select('CampaignId','Clicks')
            ->getAsObj();
            
        $items = $obj->result;
 
        return view('awtest', ['items' => $items]);
    }
    
    public function indexOld()
    {
        return view('awtest', ['campaign' => $this->getCampaign()]);
    }
    
}
