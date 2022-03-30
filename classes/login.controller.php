<?php


class LoginController extends Login{
    private $uid;
    private $pass;



    public function __construct($uid, $pass,){
        $this->uid = $uid;
        $this->pass = $pass;
    }

    

    public function loginUser(){
        if($this->emptyInput() == false){
            // echo "empty input!
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->uid, $this->pass);
    }

    // check the input if empty return false in result variable
    private function emptyInput(){
        $result = null;
        if(empty($this->uid) || empty($this->pass)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

}