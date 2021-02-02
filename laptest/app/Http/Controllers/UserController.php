<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Response;
use App\Http\Requests\UserRequest;
use App\Models\IRepository\IUserRepository;
use App\Models\DTO\User;

class UserController extends Controller
{ 
    protected $userRepository;

    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function index()
    {   
        $users = $this->userRepository->getAll();
        //return $users;
        return Response::json(array('data'=>$users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User;

        $user->username = $request->input('username');
        $user->password = $request->input('password');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');;

        try {

            $this->userRepository->create($user);

            return Response::json(array('success' => true));

        } catch (\Exception $e) {
            return $e;
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
