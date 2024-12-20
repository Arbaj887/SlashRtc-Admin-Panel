<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AdminController extends BaseController
{
   public function index(){
    if(!$this->session->get('user') || $this->session->get('user')->userRole != 'admin'){
       
        return redirect()->to('/login')->with('popMessage',"Unauthorized Access");
    }
    $userModel=new UserModel();
    $users = $userModel->where('userRole','user')->findAll();
    
    // return view('template',[
    //     'users'=>$users
    // ]);
    return view('adminPanel',[
        'users'=>$users
    ]);
   }   

   //---------------------------------Update----Agent----------------------------------------------------
    
   public function updateUser()
   {
       if (!$this->session->get('user') || $this->session->get("user")->userRole !='admin') {
           return redirect()->to('/login')->with('popMessage', 'Unauthorized Access');
           
       }
       if (isset($_POST['updateUser'])) {
           $user_model = new UserModel();
           $updatedUser = [];

           $id = $this->request->getPost('editId');
           $name = $this->request->getPost('editName');
           $email = strtolower($this->request->getPost('editEmail'));
           $role=$this->request->getPost("editRole");


           if ($name) {
               $updatedUser['name'] = $name;
           }
           if ($email) {
               $updatedUser['email'] = $email;
           }
           if ($role) {
            $updatedUser['userRole'] = $email;
        }


           $result=$user_model->update($id, $updatedUser);
           if($result){
           return redirect()->back()->with('popMessage', 'User Updated successfully');
           }
           else{
            return redirect()->back()->with('popMessage', 'Unable to Updated User');
           }
        }
}

// ------------------------------------------Delete--Agent---------------------------------------------------
public function deleteuser()
{
    
    if (!$this->session->get('user') || $this->session->get("user")->userRole !='admin') {
        return redirect()->to('/login')->with('popMessage', 'Unauthorized Access');

        
    }
    
    $id = $this->request->getUri()->getSegment(2);
    $user_model = new UserModel();

     $result=$user_model->delete($id);
     if($result){
        // $this->session->set('page','2');
     return redirect()->back()->with('popMessage', 'User Deleted Successfully');
     }
     else{
        return redirect()->back()->with('popMessage', 'Unable to Delete User');
       }
}
}
