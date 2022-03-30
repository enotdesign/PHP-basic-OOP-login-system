<?php



// receive the data form the form to pass to the controller 
if(isset($_POST['submit'])){
    $uid = $_POST['uid'];
    $pass = $_POST['pass'];


    // Instanciate signup Controller class
    include "../classes/db.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login.controller.php";


    $login = new LoginController($uid, $pass);


    // Running error handler and user signup

    $login->loginUser();



    // Going to back to front page
    header("location: ../index.php?error=none");
}