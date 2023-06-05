<?php

    require('../../app/init.php');

    $session->loggedIn();



    

    //if a form is submitted as a POST request execute the following
    if($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $user_id = $session->get_user_id();
        
        $music_post = $_POST;
        $music_post['user_id'] = $user_id;
        //create a new object using form data as column data
        $music = new Music($music_post);


        //Call the create method from which transfers the object to db
        $music->create();

        //redirect back to the home page
        redirect('/');
    }

?><!DOCTYPE html>
<html lang="en">
    <?php
        require('../partials/head.php')
    ?>

    <body class="flex flex-col min-h-screen">

        <!-- Global Menu & Logo -->
        <?php
            require('../partials/header.php')
        ?>
        <!--  End: Global Menu & Logo -->

        <!-- Page Content -->
        <div class="flex-grow">
            <div class="container mx-auto py-20">

                <!-- Create Header -->
                <div class="grid grid-cols-12 border-b pb-6">
                    <div class="col-span-12 flex items-center">
                        <div class="flex-grow">
                            <p class="text-slate-400"><a class="text-purple-500" href="<?php /*sets the link to home page*/ echo get_public_url('/'); ?>">My Notes</a> / <span>Add New Note</span></p>
                            <h1 class="font-bold text-4xl mt-2">Add New Note</h1>
                        </div>
                    </div>
                </div>
                <!-- End: Create Header -->

                <!-- Create Form -->
                <div class="grid grid-cols-12 mt-10">
                    <div class="col-span-12">

                        <form action="<?php /*sets the action to create page*/ echo get_public_url('/notes/create.php'); ?>" method="POST">
                            <!-- Sample tailwind text:input -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_name">Name</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="music_name" name="name" type="text">
                            </div>
                            <!-- End Sample tailwind text:input -->

                            <!-- Sample tailwind textarea -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_chords">Chords</label>
                                <textarea class="shadow border rounded w-full py-2 px-3 text-gray-700" id="music_chords" name="chords"></textarea>
                            </div>
                            <!-- End Sample tailwind textarea -->
                            <!-- Sample tailwind select -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_scales">Scales</label>
                                <textarea class="shadow border rounded w-full py-2 px-3 text-gray-700" id="music_scales" name="scales"></textarea>
                            </div>
                            <!-- End Sample tailwind select -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_timeline">Timeline</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="music_timeline" name="timeline" type="date">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_bpm">BPM</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="music_bpm" name="bpm" type="number">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_status">Status</label>
                                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 bg-white" id="music_status" name="status">
                                    <option value="0">Incomplete</option>
                                    <option value="1">Complete</option>
                                </select>
                            </div>

                            <!-- Sample tailwind button -->
                            <button class="bg-emerald-500 rounded-full py-2 px-4 text-white font-bold">Save</button>
                            <!-- End Sample tailwind button -->
                        </form>

                    </div>
                </div>
                <!-- End: Create Form -->

            </div>
        </div>
        <!-- End: Page Content -->

        <!-- Global Footer -->
        <?php 
            @require('../partials/footer.php');
        ?>
        <!-- End: Global Footer -->

    </body>
</html>