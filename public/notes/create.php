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
    $currentPageStyles = "css/home.css";
    $currentPageTitle = "Create Note | Guitar Utility Tool"

?><!DOCTYPE html>
<html lang="en">
<?php @include(get_path('public/partials/head.php')) ?>
    <body class="createNote">
    <?php @include(get_path('public/partials/header.php')) ?>
        <div class="homeIntro flex">
            <div class="flex maxWidth">
                <h1>Add New Note</h1>
                <a href="<?php  /*sets breadcrumb link to take back to the home page*/ echo get_public_url('/'); ?>"> &#8592 Go Back</a >
            </div>
        </div>
        <div class="homeNotes flex">
            <div class="flex maxWidth grid">
                <div class="gridChild dropShadow">
                    <div class="cardStyle">
                        <div class="spacing">
                            <form class="flex" action="<?php /*sets the action to create page*/ echo get_public_url('/notes/create.php'); ?>" method="POST">
                                <label class="name" for="music_name">Name</label>
                                <input id="music_name" name="name" type="text">
                                <label for="music_chords">Chords</label>
                                <input id="music_chords" name="chords"></input>
                                <label for="music_scales">Scales</label>
                                <input id="music_scales" name="scales"></input>
                                <label for="music_timeline">Timeline</label>
                                <input id="music_timeline" name="timeline" type="date">
                                <label for="music_bpm">BPM</label>
                                <input id="music_bpm" name="bpm" type="number">
                                <label for="music_status">Status</label>
                                <select id="music_status" name="status">
                                    <option value="0">Started</option>
                                    <option value="1">Complete</option>
                                </select>
                                <button>Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        @require(get_path('public/partials/footer.php'));
        ?>

    </body>
</html>