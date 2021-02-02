<?php
namespace App\Models\DTO;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Validator;

class User extends Model
{
    protected $filtable=['username','password','firstname','lastname'];
}
