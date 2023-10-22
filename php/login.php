<?php 
session_start();

if(isset($_POST['uname']) && 
   isset($_POST['pass'])){

    include "../db_conn.php";

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $data = "uname=".$uname;
    
    if(empty($uname)){
    	$em = "O nome de usuário é obrigatório!";
    	header("Location: ../login.php?error=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "A senha é obrigatória.";
    	header("Location: ../login.php?error=$em&$data");
	    exit;
    }else {

    	$sql = "SELECT * FROM users WHERE username = ?";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$uname]);

      if($stmt->rowCount() == 1){
          $user = $stmt->fetch();

          $username =  $user['username'];
          $password =  $user['password'];
          $email =  $user['email'];
          $fname =  $user['fname'];
          $id =  $user['id'];
          $pp =  $user['pp'];

          if($username === $uname){
             if(password_verify($pass, $password)){
                 $_SESSION['id'] = $id;
                 $_SESSION['fname'] = $fname;
                 $_SESSION['email'] = $email;
                 $_SESSION['pp'] = $pp;

                 header("Location: ../home.php");
                 exit;
             }else {
               $em = "Usuário ou senha estão incorretos!";
               header("Location: ../login.php?error=$em&$data");
               exit;
            }

          }else {
            $em = "Usuário ou senha incorretos";
            header("Location: ../login.php?error=$em&$data");
            exit;
         }

      }else {
         $em = "Usuário ou senha incorretos";
         header("Location: ../login.php?error=$em&$data");
         exit;
      }
    }


}else {
	header("Location: ../login.php?error=error");
	exit;
}
