<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'is_default', 'is_expire', 'expireDate','planDescription','created_by'
    ];

    protected $dates = ['deleted_at'];

    public function datasets()
    {
        return $this->belongsToMany('App\DataSet','plan_datasets','plan_id','data_set_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
