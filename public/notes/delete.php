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
  $currentPageTitle = "Delete " . ($music ['name'])  . " | Guitar Utility Tool";
  $currentPageStyles = "css/home.css";
  
  ?>
<!DOCTYPE html>
<html lang="en">
<?php
    require('../partials/head.php')
?>
    <body class="createNote">
    <?php 
        @require('../partials/header.php');
    ?>
    <div class="deleteNote">
        <div class="homeIntro flex">
            <div class="flex maxWidth">
            <a href="<?php  /*sets breadcrumb link to take back to the home page*/ echo get_public_url('/'); ?>"> &#8592 Go Back</a >
                <h1> Are you sure you want to <span class="delete">delete:</span>
                    <br>
                    <span class="name">'<?php /*echos the selected objects name to display*/ echo h($music ['name']);?>'</span> 
                </h1>
            </div>
        </div>  
        <form action="<?php /*submits the form to the page with selected id*/ echo get_public_url('/notes/delete.php?id=' . h($music ['id'])); ?>" method="POST">
            <input name="id" value="<?php /*echoes the name of the object to confirm if the user wishes to delete*/ echo h ($music['id']);?>" 
            type="hidden">
            <button class="buttonWhite">Yes, I'm sure</button>
        </form>
    </div>
    <?php 
        @require(get_path('public/partials/footer.php'));
    ?>
    </body>
</html>