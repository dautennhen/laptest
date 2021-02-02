<?php

namespace App\Models;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Validator;

//use App\Models\Item as Item;

class Todolist extends Model {

    //protected $fillable = ['name', 'description'];
    protected $table = 'todolists';
    public $rules = array(
        'name' => 'required',
        'description' => 'required');
    public $attributes;

    public function __construct($data = []) {
        $this->attributes = $data;
    }

    public function validate() {
        $validator = Validator::make(
                        $this->attributes, $this->rules
        );
        return $validator->errors()->all();
    }

    public function getAll() {
        $lists = $this->all();
    }

    public function item() {
        return $this->hasOne('App\Models\Item');
    }

    public function multiItem() {
        return $this->hasMany('App\Models\Todoitem');
    }

    public function workingdays() {
        return $this->belongsToMany('App\Models\Workingday', 'workingday_todolists')->withTimestamps();
    }

}

class TodolistTableSeeder extends Seeder {

    public function run() {
        $faker = \Faker\Factory::create();
        Todolist::truncate();
        foreach (range(1, 9) as $index) {
            Todolist::create([
                'name' => $faker->sentence(2),
                'description' => $faker->sentence(4),
            ]);
        }
    }

}
