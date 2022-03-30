<?php


class SignupController extends Signup{
    private $uid;
    private $pass;
    private $passRepeat;
    private $email;


    public function __construct($uid, $pass, $passRepeat, $email){
        $this->uid = $uid;
        $this->pass = $pass;
        $this->passRepeat = $passRepeat;
        $this->email = $email;
    }

    

    public function signupUser(){
        if($this->emptyInput() == false){
            // echo "empty input!
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if($this->invalidUid() == false){
            // echo "invalid username!
            header("location: ../index.php?error=username");
            exit();
        }
        if($this->invalidEmail() == false){
            // echo "invalid Email!
            header("location: ../index.php?error=email");
            exit();
        }
        if($this->passMatch() == false){
            // echo "invalid Password match!
            header("location: ../index.php?error=password");
            exit();
        }
        if($this->uidTakenCheck() == false){
            // echo "invalid User is taken!
            header("location: ../index.php?error=useroremailtaken");
            exit();
        }

        $this->setUser($this->uid, $this->pass, $this->email);
    }

    // check the input if empty return false in result variable
    private function emptyInput(){
        $result = null;
        if(empty($this->uid) || empty($this->pass) || empty($this->passRepeat) || empty($this->email)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    // Check username have not spacial characters
    private function invalidUid(){
        $result = null;

        // if not include that spesification 
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    // Validate the email with Filter_var()
    private function invalidEmail(){
        $result = null;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    //match the pass and the pass repeat are the same 
    private function passMatch(){
        $result = null;
        if($this->pass !== $this->passRepeat){
            $result = false;

        }else{
            $result = true;
        }

        return $result;
    }

        //match the pass and the pass repeat are the same 
    private function uidTakenCheck(){
        $result = null;
        if(!$this->checkUser($this->uid, $this->email,)){
            $result = false;

        }else{
            $result = true;
        }

        return $result;
    }


}