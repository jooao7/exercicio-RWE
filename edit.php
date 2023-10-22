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
	<title>Edit Profile</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php if ($user) { ?>

    <div class="d-flex justify-content-center align-items-center vh-100">
        
        <form class="shadow w-450 p-3" 
              action="php/edit.php" 
              method="post"
              enctype="multipart/form-data">

            <h4 class="display-4  fs-1">Editar Perfil</h4><br>
            <!-- Caso de erro -->
            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_GET['error']; ?>
            </div>
            <?php } ?>
            
            <!-- Caso sucesso -->
            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_GET['success']; ?>
            </div>
            <?php } ?>
          <div class="mb-3">
            <label class="form-label">Nome completo</label>
            <input type="text" 
                   class="form-control"
                   name="fname"
                   value="<?php echo $user['fname']?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Usuário</label>
            <input type="text" 
                   class="form-control"
                   name="uname"
                   value="<?php echo $user['username']?>">
          </div>

          <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="text" 
                   class="form-control"
                   name="email"
                   value="<?php echo $user['email']?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" 
                   class="form-control"
                   name="address"
                   value="<?php echo $user['address']?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Foto de Perfil</label>
            <input type="file" 
                   class="form-control"
                   name="pp">
            <img src="upload/<?=$user['pp']?>"
                 class="col-xs-6 col-md-5 img-fluid rounded-3 mt-1"
                 style="width: 60px">
            <input type="text"
                   hidden="hidden" 
                   name="old_pp"
                   value="<?=$user['pp']?>">
          </div>
          
          <button type="submit" class="btn btn-primary">Atualizar</button>
          <a href="home.php" class="link-secondary">Inicio</a>
        </form>
    </div>
    <?php }else{ 
        header("Location: home.php");
        exit;

    } ?>
</body>
</html>

<?php }else {
	header("Location: login.php");
	exit;
} ?>