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
                    if(isset($_SESSION['img']) && $_SESSION['img'] ==''){
                        echo '<img src="'.INCLUDE_PATH_STATIC.'images/avatar.jpg" />';
                    }else{
                        echo '<img src="'.INCLUDE_PATH_STATIC.'images/'.$_SESSION['img'].'" />';
                    }
                
                ?>
                <br/>
                <form >
                    <input type="text" name="nome" value="<?php echo $_SESSION['nome'] ?>">
                    <input type="password" name="senha" placeholder="sua nova senha...">
                    <input type="file" name="file">
                    <input type="submit" name="acao" value="Salvar">
                </form>
            </div>
		</div><!--feed-->
	</section>


</body>


</html>