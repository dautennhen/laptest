<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Todoitem extends Model
{
	protected $table = 'todoitem';
	public function todolist() {
		return $this->belongsTo('App\Models\Todolist');
	}
}
