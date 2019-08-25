<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Http\Controllers\Session;

class CoreConfig extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'core_config';
    protected $fillable = array(
        'key', 'field', 'value'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public $site_settings;

    public function setConfigurationsValues(){
        //show system logo on each views
        $configurations_list = DB::table('core_config')
            ->select('core_config.*')
            ->where(['core_config.deleted_at' => null])
            ->get();

        $systemData = array();
        foreach($configurations_list as $config){
            $this->site_settings[$config->key] = $config->value;
            \Session::put($config->key, $config->value);
        }

        \View::share('site_settings', $this->site_settings);
    }
}
