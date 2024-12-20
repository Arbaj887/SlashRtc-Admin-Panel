<?php
@include_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Campaign</title>
    
    
</head>
<body class="bg-gray-100">
    <div class="flex flex-col justify-center items-center container mx-auto p-4 ">
        <div class="mb-4">
            <h1 class="text-2xl font-bold">Add New Campaign</h1>
        </div>
        <div class=" bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <form action="<?= base_url('/addcampaign') ?>" method="post">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Campaign Name:</label>
                    <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-gray-500">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Campaign Description:</label>
                    <input type="text" id="description" name="description" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-gray-500">
                </div>
                <div class="mb-4">
                    <label for="client" class="block text-sm font-medium text-gray-700">Client:</label>
                    <input type="text" id="client" name="client" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-gray-500">
                </div>
                <div class="text-center">
                    <button id="addCampaign" name="addCampaign"
                    class="m-2  bg-blue-400 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Add Campaign
                    </button>
                </div>
            </form>
            <div  class="text-center">
            <a href="<?= base_url('/campaign') ?>" class="m-2  bg-gray-400 text-white p-2 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Cancel
            </a>
            </div>
        </div>
    </div>

   
    <!-- ---------------------------------------------Pop-Message---------------------------------------------- -->
    <?php if(session()->getFlashdata('popMessage') !== NULL){
    $filePath =__DIR__ . '/../Views/popMessage.php';
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found: $filePath";
    }
} ?>
</body>
</html>