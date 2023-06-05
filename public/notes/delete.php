<?php

  require('../../app/init.php');

  //id is made equal to the id of the post that is selected
  $id = $_GET["id"] ?? '';
  
  if(!$id) redirect('/');

  $session->loggedIn();

  $user_id = $_SESSION['user_id'];

  //music variable is set to reference the object that is selected
  $music = Music::get($id, $user_id);

  //if a server POST request is made the following code is executed
  if($_SERVER['REQUEST_METHOD'] === "POST") {

    //stores the form post in a variable
    $music_post = $_POST;
    //the variable's id is set to the post that is selected
    $music_post['id'] = $id;
    $music_post['user_id'] = $user_id;

    //new object is created from the music class with the form data set as the post inputs
    $delete_music = new Music($music_post);
    //delete function is ran and post with matching Id to selected is deleted
    $delete_music->delete();

    //redirects to the home page
    redirect('/');
  }
  else {
    $delete_music = Music::get($id, $user_id);
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
        @require('../partials/header.php');
    ?>
    <!--  End: Global Menu & Logo -->
    
    <!-- Page Content -->
    <div class="flex-grow">

        <div class="container mx-auto py-20">

            <!-- Delete Header -->
            <div class="grid grid-cols-12 border-b pb-6">
                <div class="col-span-12 flex items-center">
                    <div class="flex-grow">
                        <p class="text-slate-400"><a class="text-purple-500" href="<?php  /*sets breadcrumb link to take back to the home page*/ echo get_public_url('/'); ?>">My Notes</a > / <span>Delete Note</span></p>
                        <h1 class="font-bold text-4xl mt-2">Delete: <?php /*echos the selected objects name to display*/ echo h($music ['name']);?> </h1>
                    </div>
                </div>
            </div>
            <!-- End: Delete Header -->

            <!-- Delete Form -->
            <div class="grid grid-cols-12 mt-10">
                <div class="col-span-12">
                    <form action="<?php /*submits the form to the page with selected id*/ echo get_public_url('/notes/delete.php?id=' . h($music ['id'])); ?>" method="POST">
                        <p class="mb-4">Are you sure you want to delete <strong class="font-bold"><?php /*submits the form to the page with selected id*/ echo h($music ['name']); ?></strong>?</p>
                        <input name="id" value="<?php /*echoes the name of the object to confirm if the user wishes to delete*/ echo h ($music['id']);?>" 
                        type="hidden">
                        <button class="bg-red-500 rounded-full py-2 px-4 text-white font-bold">Yes, I'm sure</button>
                    </form>
                </div>
            </div>
            <!-- End: Delete Form -->

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