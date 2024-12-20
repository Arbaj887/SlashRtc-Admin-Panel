<?php

$filename = FCPATH . 'logoJson/logo.json'; // FCPATH is a constant in CodeIgniter that points to the public folder


if (file_exists($filename)) {

    $data = file_get_contents($filename);
    $logos = json_decode($data, true);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!-- ---------------------------------------Header--first--section---------------------- -->
    <div class="flex justify-between items-center bg-white  p-1 border-b border-gray-400">
        <div class="">
            <img class=" mix-blend-multiple w-[40px] "
                src="<?= base_url('slashlogo.png') ?>" alt="No Image Found" />
        </div>
        <div class="flex justify-between items-center ">
            <p class="mx-3 "><?= ucfirst(session()->get('user')->name) ?></p>
            <img class="mx-3  mix-blend-multiple w-[50px] hover:cursor-pointer"
                src="<?= base_url('userimage.png') ?>" alt="No Image Found" />
        </div>
    </div>
    <!-- ---------------------------------------------header--second--section---------------------- -->
    <div class="flex justify-center items-center bg-white p-1 border-b border-gray-400">
        <div class="flex flex-wrap justify-center items-center w-full">
            <?php foreach ($logos as $logo) { ?>
                <div class="flex flex-col mx-3 p-2 cursor-pointer" id="<?= $logo['name']; ?>"
                    onmouseover="showSubElement('<?= $logo['name']; ?>')"
                    onmouseleave="hideSubElement('<?= $logo['name']; ?>')">
                    <div class="flex">
                        <p class="m-2 text-black"><i class="<?= $logo['img']; ?>"></i></p>
                        <p class="m-2 text-gray-500"><?= $logo['name']; ?></p>
                    </div>
                    <div class="absolute flex flex-col hidden bg-white shadow-lg rounded-lg border border-gray-600" id="<?= $logo['name']; ?>1">
                        <?php foreach ($logo['subElement'] as $index => $subElement) { ?>
                            <a href="<?= $logo['link'][$index] ?>" class="m-2 text-gray-500 border-b border-gray-400 p-2"><?= $subElement; ?></a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- ----------------------------------------------header--third--section---------------------- -->
    <div class="flex justify-end items-center bg-gray-100  p-2 pr-5 border-b border-gray-400 shadow-xl">
        <select class="rounded-2xl p-2 w-[250px] m-1">
            <option value="">All Campagins</option>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
        </select>
        <select class="rounded-2xl p-2 w-[250px] m-1">
            <option value="">All Process</option>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
        </select>
        <input type="datetime-local" class="rounded-2xl p-2 w-[250px] m-1" />



        <button class="bg-white rounded-full p-2 m-1 border border-gray-300">Go</button>
        <button class="bg-white rounded-full p-2 m-1 border border-gray-300">
            <i class="fa-solid fa-download"></i>
        </button>
    </div>
    <!-- -----------------------------------------Script--------------------------------------------------------- -->

    <script>
        function showSubElement(event) {
            document.getElementById(event + "1").classList.remove('hidden')

        }

        function hideSubElement(event) {
            document.getElementById(event + "1").classList.add('hidden')

        }
    </script>
</body>

</html>