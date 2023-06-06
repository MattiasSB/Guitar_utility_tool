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
    $currentPageTitle = "Edit " . ($music ['name'])  . " | Guitar Utility Tool";
    $currentPageStyles = "css/home.css";
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        require('../partials/head.php')
    ?>

    <body class="createNote">
        <?php
            require('../partials/header.php')
        ?>
        <div class="editNote">
            <div class="homeIntro flex">
                <div class="flex maxWidth">
                    <h1 >Edit: <br> <?php /*echos the name*/ echo h($music ['name']); ?></h1>
                    <a href="<?php  /*sets breadcrumb link to take back to the home page*/ echo get_public_url('/'); ?>"> &#8592 Go Back</a >
                </div>
            </div>
            <div class="homeNotes flex">
                <div class="flex maxWidth grid">
                    <div class="gridChild">
                        <div class="cardStyle">
                            <div class="spacing">
                                <form class="flex" action="<?php /*submits form with corresponding post id*/ echo get_public_url('/notes/edit.php?id=' . h($music ['id'])); ?>" method="POST">
                                    <label for="music_name">Name</label>
                                    <input id="music_name" name="name" type="text" value="<?php /*echos page name as content*/ echo h($music ['name']); ?>">
                                    <label for="music_chords">Chords</label>
                                    <input name="chords" value="<?php /*echos page chords as content*/ echo h($music ['chords']); ?>"></input>
                                    <label for="music_scales">Scales</label>
                                    <input id="music_scales" name="scales" value="<?php /*echos page scales as content*/ echo h($music ['scales']); ?>"></input>
                                    <label for="music_timeline">Date:</label>
                                    <input id="music_timeline" name="timeline" type="date" value="<?php /*echos page name as content*/ echo h($music ['timeline']); ?>">
                                    <label for="music_bpm">BPM</label>
                                    <input id="music_bpm" name="bpm" type="number" value="<?php echo h($music ['bpm']); ?>">
                                    <label for="music_status">Status</label>
                                    <select id="music_status" name="status">
                                        <option value="0" <?php echo $music["status"] == 0 ? 'selected' : ''; //chceks the value of selection option and adjusts the color in accordance if incomplete?>>Incomplete</option>
                                        <option value="1" <?php echo $music["status"] == 1 ? 'selected' : ''; //checks the value and adjusts the color if completed or value is 1?>>Complete</option>
                                    </select>
                                    <button>Save</button>
                                </form>
                            </div>
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