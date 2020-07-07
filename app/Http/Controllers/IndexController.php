<?php


namespace App\Http\Controllers;

use App\Industry;
use App\Company;

class IndexController extends Controller
{
    public function index() {
    	$data = Industry::get(1, 10);
    	return view('index',['industry' => $data]);
    }

    public function companies($industryId) {
    	$data = Company::get($industryId, 1, 10);
    	return view('companies',['companies' => $data]);
    }
}
