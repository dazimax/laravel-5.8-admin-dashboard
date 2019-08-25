<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Exception;

class EmailTemplates extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'email_templates';
    protected $fillable = array(
        'identifier', 'content'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function parse($data)
    {
        $parsed = preg_replace_callback('/{{(.*?)}}/', function ($matches) use ($data) {
            list($shortCode, $index) = $matches;

            $index = trim($index);
            if( isset($data[$index]) ) {
                return $data[$index];
            } else {
                throw new Exception("Shortcode {$shortCode} not found in template identifier {$this->identifier}", 1);
            }

        }, $this->content);

        return $parsed;
    }
}
