<?php

namespace Tests\Feature;

use Tests\TestCase;
use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\AdWords\{AdWordsServices, AdWordsSession, AdWordsSessionBuilder};
use Google\AdsApi\AdWords\v201802\cm\{Campaign,CampaignService,CampaignOperation,Selector,Operator};

class AdWordsApiCampaignTest extends TestCase
{

    private $campaignService;

    public function setUp() 
    {
        parent::setUp();
        $adWordsServices = new AdWordsServices();
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()->build();
        $session = (new AdWordsSessionBuilder())->fromFile()->withOAuth2Credential($oAuth2Credential)->build();
        $this->campaignService = $adWordsServices->get($session, CampaignService::class);
    }


    public function test_create_adwords_services_instance()
    {
        $adWordsServices = new AdWordsServices();
        $this->assertInstanceOf(AdWordsServices::class, $adWordsServices);
    }
    
    public function test_create_campaign_service_instance()
    {
        $campaignService = new CampaignService();
        $this->assertInstanceOf(CampaignService::class, $campaignService);
    }    
        
    public function test_create_oAuth_credential_from_adsapi_php_ini()
    {
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()->build();
        $this->assertObjectHasAttribute('auth', $oAuth2Credential);
    }
    
    public function test_create_adwords_session()
    {
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()->build();
        $session = (new AdWordsSessionBuilder())->fromFile()->withOAuth2Credential($oAuth2Credential)->build();
        $this->assertInstanceOf(AdWordsSession::class,$session);
    }
    
    public function test_get_campaigns()
    {
        
        $campaignService = $this->campaignService;
        $selector = new Selector();
        $selector->setFields(['Id','Name']);
        $campaignPage = $campaignService->get($selector);
        $this->assertTrue($campaignPage->getEntries() !== null);
    }
    
    public function test_update_campaign_name()
    {
        $operations = [];
        $testCampaignId = 1329494081;
        $testCampaignName = 'TestCampaignName';
        
        $campaignService = $this->campaignService;
        
        $campaign = new Campaign();
        $campaign->setId($testCampaignId);
        $campaign->setName($testCampaignName);
        
        $operation = new CampaignOperation();
        $operation->setOperand($campaign);
        $operation->setOperator(Operator::SET);
        $operations[] = $operation;
        
        $result = $campaignService->mutate($operations);
        $returnedCampaigns = $result->getValue();
        $this->assertTrue($returnedCampaigns[0]->getName() === $testCampaignName);
    }
    

}


