<?php 
@include_once('header.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign</title>
</head>
<body>
<div class=" w-full flex justify-center bg-slate-200   overflow-auto" >
        <table class="min-w-full border-collapse border border-gray-300 text-center" id="userTable">
            <thead>
                <tr class="bg-gray-500 text-white">
                    <th class="py-3 px-4 border-b border-gray-300">Id</th>
                    <th class="py-3 px-4 border-b border-gray-300">Name</th>
                    <th class="py-3 px-4 border-b border-gray-300">Description</th>
                    <th class="py-3 px-4 border-b border-gray-300">Client</th>
                    <th class="py-3 px-4 border-b border-gray-300">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($users as $user) {

                ?>
                    <tr id="tableData" class="//hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b border-gray-300 "><?php echo $user->id; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300 "><?php echo $user->name; ?></td>
                       
                        <td class="py-3 px-4 border-b border-gray-300 "><?php echo $user->description; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300 "><?php echo $user->client; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300 text-center">
                            <!-------------------------------------Edit--User--------------------------------------------------------------------  -->

                            <button class="text-white bg-blue-500 hover:bg-blue-600 rounded-full p-2 mr-2 m-3 transition duration-200"
                                onclick="openEdit(<?php echo $user->id; ?>,'<?php echo $user->name; ?>','<?php echo $user->description; ?>','<?php echo $user->client; ?>')">
                                <i class="fa-solid fa-pen-to-square text-lg">

                                </i>
                            </button>





                            <!---------------------------------------Delete--User------------------------------------------------------------------  -->
                            <a href="<?php echo base_url('/campaigndeleteuser/' . $user->id); ?>">
                                <button class="text-white bg-red-500 hover:bg-red-600 rounded-full p-2 m-3 transition duration-200">
                                    <i class="fa-solid fa-trash text-lg"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
       
    </div>
    <!-- ---------------------------------------------------Edit------------------------------------------------------- -->
    <div class="z-40 absolute w-full bg-gray-500 bg-opacity-50 flex items-center justify-center h-screen hidden" id="editPage">
            <div class=" bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Edit</h1>


                <form action="<?= base_url("/campaignupdateUser") ?>" method="post">

                    <div class="mb-4">
                        <label for="editId" class="block text-gray-700 text-sm font-semibold mb-2">Id:</label>
                        <input type="text" id="editId" name="editId" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Enter your name" readonly>
                </div>

                    <div class="mb-4">
                        <label for="editName" class="block text-gray-700 text-sm font-semibold mb-2">Name:</label>
                        <input type="text" id="editName" name="editName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Enter your name" required>
                    </div>


                    <div class="mb-4">
                        <label for="editEmail" class="block text-gray-700 text-sm font-semibold mb-2">Description:</label>
                        <input type="text" id="editEmail" name="editEmail" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-4">
                        <label for="editRole" class="block text-gray-700 text-sm font-semibold mb-2">Client</label>
                        <input type="text" id="editRole" name="editRole" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Enter your name" readonly>
                </div>



                    <div>

                        <button type="submit" name="updateUser" id="updateUser" class=" m-2 w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Update
                        </button>

                    </div>



                </form>

                <button class=" m-2 w-full bg-gray-400 text-white py-2 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                    onclick="closeEdit()">
                    Cancel
                </button>


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
    <!-- ------------------------------------------------Script--tag-------------------------------------------- -->
    <script>
        function openEdit(id, name, description, client) {

            document.getElementById("editName").value = name;
            document.getElementById("editEmail").value = description;
            document.getElementById("editId").value = id;
            document.getElementById("editRole").value=client;
            document.getElementById("editPage").classList.remove("hidden");


        }

        function closeEdit() {
            document.getElementById("editPage").classList.add("hidden");


        }
    </script>
</body>
</html>