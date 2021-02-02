<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TodolistTableSeeder extends Seeder {
	public function run()
	{
		Todolist::create([
			'name' => 'San Juan Vacation',
			'description' => 'Things to do before we leave for Puerto Rico!'
		]);
		Todolist::create([
			'name' => 'Home Winterization',
			'description' => 'Winter is coming.'
		]);
		
		$this->call('App\Models\Todolist');
	}
}