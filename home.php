<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {

include "db_conn.php";
include 'php/User.php';
$user = getUserById($_SESSION['id'], $conn);


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php if ($user) { ?>
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<div class="shadow col-xs-6 col-md-5 w-350 p-6 text-center">
    		<img src="upload/<?=$user['pp']?>"
    		     class="col-xs-6 col-md-5 img-fluid rounded-3">
            <h5 class="display-15 "><?=$user['fname']?></h5>
            <h5 class="display-15 "><?=$user['email']?></h5>
            <h5 class="display-15 mb-3"><?=$user['address']?></h5>

            
            <a href="edit.php" class="btn btn-primary mb-2">
            	Editar Perfil
            </a>
             <a href="logout.php" class="btn btn-warning mb-2">
                Logout
            </a>
		</div>
    </div>
    <?php }else { 
     header("Location: login.php");
     exit;
    } ?>
</body>
</html>

<?php }else {
	header("Location: login.php");
	exit;
} ?>