<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class saleModel extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $table = 'sale';
    protected $primaryKey = 'id';
    protected $relations = 'idBooks';
    protected $dates = ['updated_at','created_at','deleted_at'];
}
