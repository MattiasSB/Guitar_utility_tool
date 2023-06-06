<?php

  require('../../../app/init.php');

  //checks to see if the user is logged in and currently has a session variable
  $session->loggedIn();

  //if a post request is made execute the following
  if($_SERVER['REQUEST_METHOD'] === "POST"){
    //if the user makes request execute logout method destroying the active session
    $session->logout();
    //redirects to login page
    redirect('/partials/login/loginUser.php');
  }

  
?>
<!DOCTYPE html>
<html lang="en">
<?php
    require('../head.php')
?>
    <body>
    <?php 
        @require('../header.php');
    ?>
    <div>
        <div>
            <div>
                <div>
                    <div>
                        <p><a href="<?php  /*sets breadcrumb link to take back to the home page*/ echo get_public_url('/'); ?>">My Notes</a > / <span>Log Out</span></p>x
                        <h1>Log Out </h1>
                    </div>
                </div>
            </div>
            <div>
                <div class="col-span-12">
                    <form action="<?php echo get_public_url('/partials/login/logoutUser.php') ?>" method="POST">
                        <p class="mb-4">Are you sure you want to <strong>Log Out?</strong></p>
                        <button class="bg-red-500 rounded-full py-2 px-4 text-white font-bold" type="submit">Yes, I'm sure</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php 
        @require(get_path('public/partials/footer.php'));
    ?>
    </body>
</html>