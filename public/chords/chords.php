<!DOCTYPE html>
<?php
require('../../app/init.php');

//checks status of session to see if user is logged in
$session->loggedIn();


//sets the user id to the current session user id (if user is logged in)
$user_id = $session->get_user_id();


?>
<html lang="en">
<?php @include(get_path('public/partials/head.php')) ?>
<body class="chords">
<?php @include(get_path('public/partials/header.php')) ?>
    <main>
        <div class="container">
            <div class="preload">
                <div class="flex">
                    <div class="circle">
                        <div class="inner-circle1">
                            <div class="inner-circle2"></div>
                        </div>
                    </div>
                </div>
                <div class="shadow"></div>
            </div>
        </div>
        <section class="content chords_position">
            <h1>Find A Guitar Chord Finger Position</h1>
            <div class="frame_container">
                <p class="frettNum">0</p>
                <div class="strings">
                    <p class="e_high">E</p>
                    <p class="b">B</p>
                    <p class="g">G</p>
                    <p class="d">D</p>
                    <p class="a">A</p>
                    <p class="e_low">E</p>
                </div>
                <div class="scale">
                    <div class="chordFingerPosition cfp-0">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-1">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-2">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-3">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-4">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-5">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-6">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-7">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-8">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-9">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-10">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-11">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-12">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-13">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-14">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-15">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-16">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-17">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-18">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-19">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-20">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-21">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-22">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-23">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-24">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-25">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-26">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-27">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-28">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                    <div class="chordFingerPosition cfp-29">
                        <span class="fingerPlacement">
    
                        </span>
                    </div>
                </div>
                <span class="chords_position-text">?</span>
                <h2 id="name">Standard Tuning</h2>
            </div>
            <label for="chords">Search A Chord:</label>

            <div class="inputs">
                <input id="chords" name="chords" type="text">
                <div id="api_search">Search</div>
            </div>
        </section>
        <section>
            <div class="results_container">
                <h3>Results:</h3>
                <div class="results"></div>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; Mattias Bellan - Guitar Utilities + Special Thanks to UberChord API</p>
    </footer>
    <script src="scripts/api.js"></script>
    <script src="scripts/menu.js"></script>
</body>
</html>