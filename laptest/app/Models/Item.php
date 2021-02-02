<?php

namespace App\Models;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Item extends Model
{
	protected $table = 'item';
	public function todolist()
	{
		return $this->belongsTo('App\Models\Todolist');
	}
}
