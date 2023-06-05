<?php
    //checks to see if the user doesn't currently have a session id
    if(is_null($session->get_user_id())): 
    ?>
    <li>
        <a class="inline-block py-2 no-underline font-bold text-purple-500 mr-5" href="<?php echo get_public_url('partials/login/createUser.php'); ?>">Sign Up</a>
    </li>
    <li>
        <a class="inline-block py-2 no-underline font-bold text-purple-500 mr-5" href="<?php echo get_public_url('partials/login/loginUser.php'); ?>">Log In</a>
    </li>
<?php 
//otherwise display the following
else: 
?>
    <li>
        <a class="inline-block py-2 no-underline font-bold text-purple-500 mr-5" href="<?php echo get_public_url('partials/login/logoutUser.php'); ?>">Log Out</a>
    </li>                 
    <li>
        <a class="mx-2 inline-block py-2 no-underline font-bold text-purple-500" href="<?php echo get_public_url('/'); ?>">Songs</a>
    </li>
<?php endif; ?>