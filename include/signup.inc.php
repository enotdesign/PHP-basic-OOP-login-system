<?php



// receive the data form the form to pass to the controller 
if(isset($_POST['submit'])){
    $uid = $_POST['uid'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $passrepeat = $_POST['passrepeat'];


    // Instanciate signup Controller class
    include "../classes/db.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup.controller.php";


    $signup = new SignupController($uid, $pass, $passrepeat,$email);


    // Running error handler and user signup

    $signup->signupUser();



    // Going to back to front page
    header("location: ../index.php?error=none");
}