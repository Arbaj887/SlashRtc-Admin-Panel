<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UserModel;

use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function login()
    {  
        if ($this->session->get("user") && $this->session->get("user")->userRole =='admin') {
            
            return redirect()->to('/admin'); 
        }
        if (isset($_POST['email'])) {
            $user_model = new UserModel();

            $email = trim($this->request->getPost('email'));
            $password = trim($this->request->getPost('password'));
            $user = $user_model->where('email', $email)->first();
            if (!$user) {
                return redirect()->back()->with('popMessage', 'Please Enter correct email and password');
                

            }
            if ($user) {
                if (password_verify($password, $user->password)) {
                    $this->session->set("user", $user);
                     //$this->session->set("page", "User"); //-----------------using in template php
                    //----------------------------Creating----Session-----------------------
                    if($user->userRole==="admin"){
                    $this->session->set("user", $user);
                    return redirect()->to('/admin')->with('popMessage', 'Admin Login Successfull');
                    }
                    return redirect()->to('/login')->with('popMessage','Your are Not Admin');
                    
                } else {
                    return redirect()->back()->with('popMessage', 'please Enter valid Email and password');
                   }
            } else {
                return redirect()->back()->with('popMessage', 'please Enter valid Email and password');
                }
        }
        return view('login');
    }
}
