<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class booksModel extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $dates = ['updated_at','created_at','deleted_at'];
}
