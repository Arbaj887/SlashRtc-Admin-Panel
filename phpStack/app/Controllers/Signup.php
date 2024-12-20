<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;


class Signup extends BaseController
{
   
    public function signup()
    {
        if (isset($_POST['name'])) {
            $user_model = new UserModel();

            $data = [
                'name' => $this->request->getPost('name'),
                'email' => strtolower($this->request->getPost('email')),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)
            ];
            $existUser =  $user_model->where('email', $data['email'])->first();
            if ($existUser) {
                
                return redirect()->back()->with('popMessage', 'User already exists');
                
            }
             $user_model->save($data);
             return redirect()->to('/login')->with('popMessage', 'Registration successfull');
            

            
        }
        return view('signup');
    }
}
