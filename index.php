<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<form class="shadow w-450 p-3" 
    	      action="php/signup.php" 
    	      method="post"
    	      enctype="multipart/form-data">

    		<h4 class="display-4  fs-1">Cadastrar conta</h4><br>
    		<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>

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
		           value="<?php echo (isset($_GET['fname']))?$_GET['fname']:"" ?>"
				   placeholder="Preencha seu nome">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Usuário</label>
		    <input type="text" 
		           class="form-control"
		           name="uname"
		           value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>"
				   placeholder="Insira seu nome de usuário">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Senha</label>
		    <input type="password" 
		           class="form-control"
		           name="pass"
				   placeholder="Insira sua senha">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Endereço</label>
		    <input type="text" 
		           class="form-control"
		           name="address"
				   placeholder="Insira seu endereço">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">E-mail</label>
		    <input type="email" 
		           class="form-control"
		           name="email"
				   placeholder="seu@email.com">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Linkedin</label>
		    <input type="url" 
		           class="form-control"
		           name="url"
				   placeholder="https://linkedin.com/in/seu-perfil" pattern="https?://.+" size="70" required>
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Foto de perfil</label>
		    <input type="file" 
		           class="form-control"
		           name="pp">
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Cadastrar</button>
		  <a href="login.php" class="btn btn-success">Login</a>
		</form>
    </div>
</body>
</html>