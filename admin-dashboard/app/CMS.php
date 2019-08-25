<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMS extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $primaryKey = 'pageId';
    protected $table = 'cmspages';
    protected $fillable = array(
        'title',
        'content'
    );
    protected $dates = ['deleted_at'];
    public $timestamps = true;
}
