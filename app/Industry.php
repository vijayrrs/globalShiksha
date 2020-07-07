<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $table = 'industry';

    public static function get($page, $limit) {
    	$offset = ($page - 1)*$limit;
    	return self::offset($page)->take($limit)->get();
    }
}
