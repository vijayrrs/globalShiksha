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
                $company = new Company();
                $company->industry_id = $industryId;
                $company->name = $companyName;
                $company->link = $companyLink;
                $company->class = $companyClass;
                $company->description = $companyDescription;
                $company->status = $companyStatus;
                $company->age = $companyAge;
                $company->registration_number = $registerNumber;
                $company->save();
            }
        });
    }
}
