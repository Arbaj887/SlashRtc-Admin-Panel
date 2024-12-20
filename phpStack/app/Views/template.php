<?php 

echo view('header');


$page = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// print_r($page);
// print_r($page[2]);die;




   if($page[1]==='admin'){
      echo view('adminPanel');
   }else{
   
    echo view('adminPanel' . $page[1]); // Load the specific admin panel view
   }

   


// Load the footer view
echo view('footer');
?>
