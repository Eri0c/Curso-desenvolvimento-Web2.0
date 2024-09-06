<!DOCTYPE html>
<html>
<head>
	<!--ALTERAR TITULO-->
	<title>Bem-vindo, <?php echo $_SESSION['nome']; ?></title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">


</head>

<body>

	<section class="main-feed">
		<?php 
			include('includes/sidebar.php'); 
		?>
		<div class="feed">
            <div class ="editar-perfil">
            <h2>Editando perfil:</h2>
            <br/>
            <?php 
                if(isset($_SESSION['img']) && is_string($_SESSION['img']) && $_SESSION['img'] == ''){
                        echo '<img style="max-width:400px;width:100%;" src="'.INCLUDE_PATH_STATIC.'images/avatar.jpg" />';
                    }elseif(isset($_SESSION['img']) && is_string($_SESSION['img'])){
                        echo '<img style="max-width:400px;width:100%;" src="'.INCLUDE_PATH.'uploads/'.$_SESSION['img'].'" />';
                    }else{
                        echo '<img src="'.INCLUDE_PATH_STATIC.'images/avatar.jpg" />';// Exibe um avatar padrão caso não seja string
                    }
            ?>

                <br/>
                <form method = "post" enctype="multipart/form-data">
                    <input type="text" name="nome" value="<?php echo $_SESSION['nome'] ?>">
                    <input type="password" name="senha" placeholder="sua nova senha...">
                    <input type="file" name="file">
                    <input type="hidden" name="atualizar" value = "atualizar">
                    <input type="submit" name="acao" value="Salvar">
                </form>
            </div>
		</div><!--feed-->
	</section>


</body>


</html>