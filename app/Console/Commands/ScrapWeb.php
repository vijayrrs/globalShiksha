<?php

namespace App\Console\Commands;

use App\Company;
use App\Industry;
use Illuminate\Console\Command;

class ScrapWeb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl-industry {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrapper For Web Industry';

    public $url;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = [];
        $this->url = $this->argument('url');
        $crawler = \Goutte::request('GET', $this->url);
        $industryUrl = $crawler->filter(".col-md-12 h2 a")->attr('href');
        $this->saveIndustryData($industryUrl);
    }

    protected function saveIndustryData($industryUrl) {
        $crawler = \Goutte::request('GET', $this->url.$industryUrl);
        $crawler->filter("ul.list-group .list-group-item a")->each(function($node) {
            $industryName = $node->text();
            $link = $this->url.$node->attr("href");
            $industry = new Industry();
            $industry->name = $industryName;
            $industry->link = $link;
            $industry->save();
            $this->saveCompanyData($industry->id, $link);
        });
    }

    protected function saveCompanyData($industryId, $companyPageUrl) {
        $crawler = \Goutte::request("GET", $companyPageUrl);
        $this->processCompanyData($industryId, $crawler);

        $page = $crawler->filter(".pagination li a")->each(function($paginationNode) {
            $lastPage = $paginationNode->text();

            if(is_numeric($lastPage)) {
                return $lastPage;
            }
        });
        $currentPage = 2;
        if(count($page) > 0) {
            $totalPages = $page[count($page) - 2];
            if($totalPages > 5) {
                $totalPages = 5;
            }
            while ($totalPages > $currentPage) {
                $pageUrl = $companyPageUrl."/page/".$currentPage;
                $newCrawler = \Goutte::request("GET", $pageUrl);
                $this->processCompanyData($industryId, $newCrawler);
                $currentPage++;
            }
        }
    }

    protected function processCompanyData($industryId,  $crawler) {
        $crawler->filter("table")->each(function($node) use($industryId) {
            $cin = $node->filter("td")->eq(0)->text();
            if($cin != 'CIN') {
                $companyDetailNode = $node->filter("td")->eq(1);
                $companyName = $companyDetailNode->filter("a")->text();
                $companyLink = $this->url.$companyDetailNode->filter("a")->attr('href');
                $companyClass = $node->filter("td")->eq(2)->text();
                $companyStatus = $node->filter("td")->eq(3)->text();
                $newCrawler = \Goutte::request("GET", $companyLink);
                $companyDescription = $newCrawler->filter(".main_test p")->text();
                $ageNode = $newCrawler->filter("#companyinformation table tr")->eq(3);
                $companyAge = $ageNode->filter("td")->eq(1)->text();
                $registerNode = $newCrawler->filter("#companyinformation table tr")->eq(4);
                $registerNumber = $registerNode->filter("td")->eq(1)->text();

                $cinNoNode = $newCrawler->filter("#companyinformation table tr")->eq(0);
                $cinNo = $cinNoNode->filter("td")->eq(1)->text();
                $categoryNode = $newCrawler->filter("#companyinformation table tr")->eq(5);
                $categoryName = $categoryNode->filter("td")->eq(1)->text();

                $subCategoryNode = $newCrawler->filter("#companyinformation table tr")->eq(6);
                $subCategoryName = $subCategoryNode->filter("td")->eq(1)->text();
                $rocNode = $newCrawler->filter("#companyinformation table tr")->eq(8);
                $rocCode = $rocNode->filter("td")->eq(1)->text();

                $emailNode = $newCrawler->filter("#contactdetails table tr")->eq(0);
                $emailaddr = $emailNode->filter("td")->eq(1)->text();
                $registeredOfficeNode = $newCrawler->filter("#contactdetails table tr")->eq(1);
                $registeredOfficeCode = $registeredOfficeNode->filter("td")->eq(1)->text();

                $stateNode = $newCrawler->filter("#otherinformation table tr")->eq(0);
                $state = $stateNode->filter("td")->eq(1)->text();
                $districtNode = $newCrawler->filter("#otherinformation table tr")->eq(1);
                $district = $districtNode->filter("td")->eq(1)->text();
                $cityNode = $newCrawler->filter("#otherinformation table tr")->eq(2);
                $city = $cityNode->filter("td")->eq(1)->text();
                $pinNode = $newCrawler->filter("#otherinformation table tr")->eq(3);
                $pin = $pinNode->filter("td")->eq(1)->text();

                //echo "<pre>";print_r($newCrawler->filter("#directors table tr"));
                if($newCrawler->filter("#directors table tr")->count() > 1){
                    $diNoNode1 = $newCrawler->filter("#directors table tr")->eq(1);
                   // echo "<pre>";print_r($diNoNode1->filter("td")->eq(0)->text());
                        $diNo = $diNoNode1->filter("td")->eq(0)->text();
                        $diName = $diNoNode1->filter("td")->eq(1)->text();
                        $diDesignation = $diNoNode1->filter("td")->eq(2)->text();
                        $diDateOfAppointment = $diNoNode1->filter("td")->eq(3)->text();    
                    
                    $diNoNode2 = $newCrawler->filter("#directors table tr")->eq(2);
                        $diNo2 = $diNoNode2->filter("td")->eq(0)->text();
                        $diName2 = $diNoNode2->filter("td")->eq(1)->text();
                        $diDesignation2 = $diNoNode2->filter("td")->eq(2)->text();
                        $diDateOfAppointment2 = $diNoNode2->filter("td")->eq(3)->text();    
                    
                    // $diNoNode3 = $newCrawler->filter("#directors table tr")->eq(3);
                    //     $diNo3 = $diNoNode3->filter("td")->eq(0)->text();
                    //     $diName3 = $diNoNode3->filter("td")->eq(1)->text();
                    //     $diDesignation3 = $diNoNode3->filter("td")->eq(2)->text();
                    //     $diDateOfAppointment3 = $diNoNode3->filter("td")->eq(3)->text();
                }

                $company = new Company();
                $company->industry_id = $industryId;
                $company->name = $companyName;
                $company->link = $companyLink;
                $company->class = $companyClass;
                $company->description = $companyDescription;
                $company->status = $companyStatus;
                $company->age = $companyAge;
                $company->registration_number = $registerNumber;

                $company->cin_no = $cinNo;
                $company->category_name = $categoryName;
                $company->sub_category_name = $subCategoryName;
                $company->roc_no = $rocCode;
                $company->email_addr = $emailaddr;
                $company->registered_office = $registeredOfficeCode;
                $company->state = $state;
                $company->district = $district;
                $company->city = $city;
                $company->pin = $pin;
                if($newCrawler->filter("#directors table tr")->count() > 1){
                    $company->d_No = $diNo;
                    $company->d_Name = $diName;
                    $company->d_Designation = $diDesignation;
                    $company->d_DateOfAppointment = $diDateOfAppointment;
                    $company->d_No2 = $diNo2;
                    $company->d_Name2 = $diName2;
                    $company->d_Designation2 = $diDesignation2;
                    // $company->d_DateOfAppointment2 = $diDateOfAppointment2;
                }
                $company->save();
            }
        });
    }
}
