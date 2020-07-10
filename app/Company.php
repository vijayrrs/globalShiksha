<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    protected $table = 'company';

    public static function get($industryId, $page, $limit) {
    	$offset = ($page - 1)*$limit;
    	return DB::table('company')->where('industry_id', $industryId)->get();
    }

    public static function getDetails($id, $page, $limit) {
    	$offset = ($page - 1)*$limit;
    	return DB::table('company')->where('id', $id)->get();
    }
}
