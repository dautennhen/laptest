<?php
namespace App\Models;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Validator;

class User extends Model
{
	protected $table = 'user';
    public $rules = array(
        'name' => 'required',
        'description' => 'required');
    public $attributes;
    public function __construct($data=[]) {
        $this->attributes = $data;
    }
 
    public function getAll(){
        $lists = $this->all();
		
    }
}
