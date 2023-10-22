<?php  
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {



if(isset($_POST['fname']) && 
   isset($_POST['uname'])){

    include "../db_conn.php";

    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $old_pp = $_POST['old_pp'];
    $id = $_SESSION['id'];

    if (empty($fname)) {
    	$em = "O nome completo é obrigatório!";
    	header("Location: ../edit.php?error=$em");
	    exit;
    }else if(empty($uname)){
    	$em = "O nome de usuário é obrigatório!";
    	header("Location: ../edit.php?error=$em");
	    exit;
    }else {

      if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name']['address']['email'])) {
         
        
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
               // Remover foto
               $old_pp_des = "../upload/$old_pp";
               if(unlink($old_pp_des)){
               	  // Já removida
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }else {
                  // Erro ou já foi removida.
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }
               

               // Atualizar a Database
               $sql = "UPDATE users 
                       SET fname=?, username=?, pp=?, email=?
                       WHERE id=?";
               $stmt = $conn->prepare($sql);
               $stmt->execute([$fname, $uname, $email, $new_img_name,$id]);
               $_SESSION['fname'] = $fname;
               header("Location: ../edit.php?success=Sua conta foi atualizada com sucesso!");
                exit;
            }else {
               $em = "Você não pode fazer upload de arquivos nesse formato.";
               header("Location: ../edit.php?error=$em&$data");
               exit;
            }
         }else {
            $em = "Erro desconhecido.";
            header("Location: ../edit.php?error=$em&$data");
            exit;
         }

        
      }else {
       	$sql = "UPDATE users 
       	        SET fname=?, username=?, address=?, email=?
                WHERE id=?";
       	$stmt = $conn->prepare($sql);
       	$stmt->execute([$fname, $uname, $address, $email, $id]);

       	header("Location: ../edit.php?success=Sua conta foi atualizada com sucesso!");
   	    exit;
      }
    }


}else {
	header("Location: ../edit.php?error=error");
	exit;
}


}else {
	header("Location: login.php");
	exit;
} 

