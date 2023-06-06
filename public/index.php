<?php

require('../app/init.php');

//checks status of session to see if user is logged in
$session->loggedIn();


//sets the user id to the current session user id (if user is logged in)
$user_id = $session->get_user_id();
//retrieves all post under the current user id
$music = Music::get_all($user_id);

$currentPageStyles = "css/home.css";

$currentPageTitle = "Notes | Guitar Utility Tool"

?>
<!DOCTYPE html>
<html lang="en">
<?php @include(get_path('public/partials/head.php')) ?>
<body class="home"> 
    <?php @include(get_path('public/partials/header.php')) ?>
        <div class="homeIntro flex">
            <div class="flex maxWidth">
                <a class="flex" href="<?php echo get_public_url('/notes/create.php'); ?>">
                    <img src="images/icon_addition.svg" alt="Add a song to playlist">
                    <h1>Add New</h1>
                </a>
            </div>
        </div>
        <div class="homeNotes flex">
            <div class="flex maxWidth grid">
                <?php 
                    //runs as long as condition remain true 
                    // in this instance it will run and return the results from the db as a associative array
                    //returns false and ends loop when results run out
                    while($music_row = $music->fetch_assoc()):
                ?>
    
                <?php include(get_path('public/partials/card.php')); //the card that is displayed - content comes from yhe while loop and database?>
                <?php endwhile;?>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
        <script src="js/app.js"></script>
        <script src="chords/scripts/menu.js"></script>
</body>
</html>