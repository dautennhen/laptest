<?php
namespace App\Models\IRepository;
use App\Models\DTO\User;

interface IUserRepository {
	
	public function getAll();
	public function find($id);
	public function create(User $user);
}