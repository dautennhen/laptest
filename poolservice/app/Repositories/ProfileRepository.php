<?php

namespace App\Repositories;

use App\Models\Profile;
use Auth;

class ProfileRepository {
    private $common;
    private $user;
    private $profile;
    
    public function __construct() {
        $this->common = app('App\Common\Common');
        $this->user = app('App\Models\User');
        $this->profile = app('App\Models\Profile');
    }
    
    public function uploadResizeAvatar($folder) {
        $user = Auth::user();
        $result = $this->common->uploadResizeImage($folder);
        if(!$result) 
            return false;
        $profile = $this->profile->find($user->id);
        if ($profile) {
            $profile->avatar = $result;
            $profile->save();
            return $result;
        }
        $data = [
            'user_id' => $user->id,
            'avatar' => $result
        ];
        $this->profile->create($data);
        return $result;
    }
    
    public function saveProfile($id, $data) {
        //$obj = $this->common->getUserByToken();
        $obj = Profile::find($id);
        $obj->fullname = $data['fullname'];
        $obj->address = $data['address'];
        $obj->state = $data['state'];
        $obj->zipcode = $data['zipcode'];
        $obj->city = $data['city'];
        return $obj->save();
    }
    
    public function saveNewEmail($id, $data) {
        $obj = $this->user->find($id);
        $oldEmail = $obj->email;
        $email = $data['email'];
        $result = false;
        if ($obj->email == $email)
            return false;
        $obj->email = $email;
        try {
            $obj->save();
            $data = [
                'email' => [$email, $oldEmail],
                'subject' => 'Changed email',
                'data' => []
            ];
            $this->common->sendmail('emails.verifytpl', $data);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function saveNewPassword($id, $data) {
        $obj = $this->user->find($id);
        $password = $data['password'];
        $newpwd = $data['new-password'];
        $rewpwd = $data['re-password'];
        if (\Hash::check($password, $obj->password)) {
            $obj->password = \Hash::make($newpwd);
            return $obj->save();
        }
        return false;
    }
}
