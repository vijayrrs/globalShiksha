<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    public static function get($industryId, $page, $limit) {
    	$offset = ($page - 1)*$limit;
    	return self::offset($page)->take($limit)->where('industry_id', $industryId)->get();
    }
}
