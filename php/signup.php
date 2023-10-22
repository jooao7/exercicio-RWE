<?php 

if(isset($_POST['fname']) && 
   isset($_POST['uname']) &&  
   isset($_POST['address']) &&  
   isset($_POST['email']) &&         
   isset($_POST['pass'])){

    include "../db_conn.php";

    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $data = "fname=".$fname."&uname=".$uname."&pass=".$pass."&email=".$email;
    
    if (empty($fname)) {
    	$em = "O nome completo é obrigatório";
    	header("Location: ../index.php?error=$em&$data");
	    exit;
    }else if(empty($uname)){
    	$em = "Preencha o campo de usuário!";
    	header("Location: ../index.php?error=$em&$data");
	    exit;
    }else if(empty($email)){
      $em = "Insira seu e-mail!";
      header("Location: ../index.php?error=$em&$data");
      exit;
   }else if(empty($pass)){
      $em = "Insira sua senha!";
      header("Location: ../index.php?error=$em&$data");
      exit;
   }else if(empty($address)){
      $em = "Preencha com seu endereço!";
      header("Location: ../index.php?error=$em&$data");
      exit;
   }else {
      // hashing das senhas
      $pass = password_hash($pass, PASSWORD_DEFAULT);

      if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {
         
         
         $img_name = $_FILES['pp']['name'];
         $tmp_name = $_FILES['pp']['tmp_name'];
         $error = $_FILES['pp']['error'];
         
         if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
               $new_img_name = uniqid($uname, true).'.'.$img_ex_to_lc;
               $img_upload_path = '../upload/'.$new_img_name;
               move_uploaded_file($tmp_name, $img_upload_path);

               // Inserindo na DB
               $sql = "INSERT INTO users(fname, username, password, address, pp, email) 
                 VALUES(?,?,?,?,?,?)";
               $stmt = $conn->prepare($sql);
               $stmt->execute([$fname, $uname, $pass, $address, $new_img_name, $email]);

               header("Location: ../index.php?success=Sua conta foi criada com sucesso!");
                exit;
            }else {
               $em = "Você não pode fazer upload de arquivos nesse formato.";
               header("Location: ../index.php?error=$em&$data");
               exit;
            }
         }else {
            $em = "Erro desconhecido";
            header("Location: ../index.php?error=$em&$data");
            exit;
         }

        
      }else {
       	$sql = "INSERT INTO users(fname, username, password, address, email) 
       	        VALUES(?,?,?,?,?)";
       	$stmt = $conn->prepare($sql);
       	$stmt->execute([$fname, $uname, $pass, $address, $email]);

       	header("Location: ../index.php?success=Sua conta foi criada com sucesso!");
   	    exit;
      }
    }


}else {
	header("Location: ../index.php?error=error");
	exit;
}
