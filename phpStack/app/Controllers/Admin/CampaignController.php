<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CampaignModel;
use CodeIgniter\HTTP\ResponseInterface;

class CampaignController extends BaseController
{
    public function index(){
        if(!$this->session->get('user') || $this->session->get('user')->userRole != 'admin'){
           
            return redirect()->to('/login')->with('popMessage',"Unauthorized Access");
        }
        $campaignModel=new CampaignModel();
        $users = $campaignModel->findAll();
        
        // return view('template',[
        //     'users'=>$users
        // ]);
         return view('campaign',[
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
                $campaignModel = new CampaignModel();
               $updatedUser = [];
    
               $id = $this->request->getPost('editId');
               $name = $this->request->getPost('editName');
               $description = strtolower($this->request->getPost('editEmail'));
               $client=$this->request->getPost("editRole");
    
    
               if ($name) {
                   $updatedUser['name'] = $name;
               }
               if ($description) {
                   $updatedUser['description'] = $description;
               }
               if ($client) {
                $updatedUser['client'] = $client;
            }
    
    
               $result= $campaignModel->update($id, $updatedUser);
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
        $campaignModel = new CampaignModel();
    
         $result= $campaignModel->delete($id);
         if($result){
            // $this->session->set('page','2');
         return redirect()->back()->with('popMessage', 'User Deleted Successfully');
         }
         else{
            return redirect()->back()->with('popMessage', 'Unable to Delete User');
           }
    }

    // --------------------------------------------Add Campaign----------------------------------------------------
     public function addCampaign(){
        
        if (!$this->session->get('user') || $this->session->get("user")->userRole !='admin'){
            return redirect()->to('/login')->with('popMessage', 'Unauthorized Access');
        }
        
        $campaignModel = new CampaignModel();
        if (isset($_POST['addCampaign'])) {
           $campaignModel = new CampaignModel();
           $data = [
            'name' =>$this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'client' => $this->request->getPost("client"),
        ];

           $result= $campaignModel->insert($data);
           
           if($result){
           return redirect()->back()->with('popMessage', 'Campaign Added successfully');
           }
           else{
            return redirect()->back()->with('popMessage', 'Unable to Add Campaign');
           }
     }
     return view('addCampaign');
    }
}
