<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Workingday extends Model
{
    protected $table = 'workingday';
	public $rules = array(
        'unknown' => 'required'
		);
		
	public function __construct($data=[]) {
        $this->attributes = $data;
    }
	
    public function validate() {
        $validator = Validator::make(
            $this->attributes ,
            $this->rules
        );
        return $validator->errors()->all();
    }
	
	public function todolists()
	{
		return $this->belongsToMany('App\Models\Todolist', 'workingday_todolists')->withTimestamps();
	}
	
}
