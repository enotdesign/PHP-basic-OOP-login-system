<?php


class Signup extends Db{


    protected function setUser($userid,$pass, $email){

        // create a statement to check the user

        $stmt = $this->connect()->prepare("INSERT INTO users (usesr_uid,users_pass,users_email) VALUES (?,?,?);");

        $hashPassword = password_hash($pass, PASSWORD_DEFAULT );

        // IF NOT RESULT THE STMT REDIRECT WITH ERROR
        if(!$stmt->execute(array($userid,$hashPassword, $email))){
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }


    protected function checkUser($userid, $email){

        // create a statement to check the user

        $stmt = $this->connect()->prepare("SELECT usesr_uid FROM users WHERE usesr_uid = ? OR users_email = ?;");

        // create
        if(!$stmt->execute(array($userid, $email))){
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = null;

        if($stmt->rowCount() > 0){
            $resultCheck = false;

        }else{
            $resultCheck = true;
        }
        return $resultCheck;
    }


}