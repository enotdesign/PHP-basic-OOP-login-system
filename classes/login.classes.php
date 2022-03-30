<?php


class Login extends Db{


    protected function getUser($userid,$pass){

        // create a statement to check the user

        $stmt = $this->connect()->prepare("SELECT users_pass FROM users WHERE usesr_uid = ? OR users_email = ?");

        // IF NOT RESULT THE STMT REDIRECT WITH ERROR
        if(!$stmt->execute(array($userid, $pass))){
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("Location: ../index.php?error=usernotfound");
            exit();
        }

        $passhash = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPass = password_verify($pass, $passhash[0]["users_pass"]);


        
        if($checkPass == false){
            $stmt = null;
            header("Location: ../index.php?error=wrongpassword");
            exit();
        }elseif($checkPass == true){
            $stmt = $this->connect()->prepare("SELECT * FROM users WHERE usesr_uid = ? OR users_email = ? AND users_pass = ?;");

            if(!$stmt->execute(array($userid, $userid, $pass))){
                $stmt = null;
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0){
                $stmt = null;
                header("Location: ../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useruid"] = $user[0]["users_uid"];
        }



        $stmt = null;
    }


}