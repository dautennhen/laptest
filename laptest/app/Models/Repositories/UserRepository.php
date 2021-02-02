<?php
namespace App\Models\Repositories;
use App\Models\IRepository\IUserRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\DTO\User;
use Response;
use DB;

class UserRepository implements IUserRepository {
	
	protected $db;
        
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

	public function getAll()
	{
        $users = DB::table('user')->get();
        return $users;
	}
	
	public function find($id)
	{
		//return $this->user::find($id);
        return "";
	}

    public function create(User $userdata)
    {
    	$username = $userdata->username;
        $password = $userdata->password;
        $firstname = $userdata->firstname;
        $lastname = $userdata->lastname;
        try {

            DB::table('user')->insert([
                'username' => $username,
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname
            ]);

            return Response::json(array('success' => true));
        } catch (\Exception $e) {
            return $e;
        }  
    }
}