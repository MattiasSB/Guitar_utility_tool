<?php

    require('../../app/init.php');

    //id is set to the selected post or is null
    $id = $_GET['id'] ?? null; 
    if(!$id) redirect('/');

    $session->loggedIn();

    $user_id = $_SESSION['user_id'];
    //music references the object created from the class Music based on the Id of the selected
    $music = Music::get($id, $user_id);

    //if a server POST request is made the following code is executed
    if($_SERVER['REQUEST_METHOD'] === "POST") {

        //stores the form post in a variable
        $music_post = $_POST;
        //the variable's id is set to the post that is selected
        $music_post['id'] = $id;
        $music_post['user_id'] = $user_id;

        //new object is created from the music class with the form data set as the post inputs
        $update_music = new Music($music_post);

        //post is sent to database and the post with matching id will be updated
        $update_music->update();

        //redirect to the home page
        redirect('/');
    } else {
        $update_music = Music::get($id, $user_id);
    }
?>
<!DOCTYPE html>
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

                <!-- Edit Header -->
                <div class="grid grid-cols-12 border-b pb-6">
                    <div class="col-span-12 flex items-center">
                        <div class="flex-grow">
                            <p class="text-slate-400"><a class="text-purple-500" href="<?php echo get_public_url('/'); ?>">My Notes</a> / <span>Edit Note</span></p>
                            <h1 class="font-bold text-4xl mt-2">Edit: <?php /*echos the name*/ echo h($music ['name']); ?></h1>
                        </div>
                    </div>
                </div>
                <!-- End: Edit Header -->

                <!-- Edit Form -->
                <div class="grid grid-cols-12 mt-10">
                    <div class="col-span-12">

                        <form action="<?php /*submits form with corresponding post id*/ echo get_public_url('/notes/edit.php?id=' . h($music ['id'])); ?>" method="POST">

                            <!-- Sample tailwind text:input -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_name">Name</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="music_name" name="name" type="text" value="<?php /*echos page name as content*/ echo h($music ['name']); ?>">
                            </div>
                            <!-- End Sample tailwind text:input -->

                            <!-- Sample tailwind textarea -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_chords">Chords</label>
                                <textarea class="shadow border rounded w-full py-2 px-3 text-gray-700" id="music_chords" name="chords"><?php /*echos page chords as content*/ echo h($music ['chords']); ?></textarea>
                            </div>
                            <!-- End Sample tailwind textarea -->
                            <!-- Sample tailwind select -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_scales">Scales</label>
                                <textarea class="shadow border rounded w-full py-2 px-3 text-gray-700" id="music_scales" name="scales"><?php /*echos page scales as content*/ echo h($music ['scales']); ?></textarea>
                            </div>
                            <!-- End Sample tailwind select -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_timeline">Timeline</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="music_timeline" name="timeline" type="date" value="<?php /*echos page name as content*/ echo h($music ['timeline']); ?>">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_bpm">BPM</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="music_bpm" name="bpm" type="number" value="<?php echo h($music ['bpm']); ?>">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="music_status">Status</label>
                                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 bg-white" id="music_status" name="status">
                                    <option value="0" <?php echo $music["status"] == 0 ? 'selected' : ''; //chceks the value of selection option and adjusts the color in accordance if incomplete?>>Incomplete</option>
                                    <option value="1" <?php echo $music["status"] == 1 ? 'selected' : ''; //checks the value and adjusts the color if completed or value is 1?>>Complete</option>
                                </select>
                            </div>
                            <!-- End Sample tailwind select -->

                            <!-- Sample tailwind button -->
                            <button class="bg-emerald-500 rounded-full py-2 px-4 text-white font-bold">Save</button>
                            <!-- End Sample tailwind button -->

                        </form>

                    </div>
                </div>
                <!-- End: Edit Form -->

            </div>
        </div>
        <!-- End Page Content -->

        <!-- Global Footer -->
        <?php 
            @require('../partials/footer.php');
        ?>
        <!-- End: Global Footer -->
    
    </body>
</html>