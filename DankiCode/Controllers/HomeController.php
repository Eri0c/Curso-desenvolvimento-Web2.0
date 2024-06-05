<?php
	
	namespace DankiCode\Controllers;

	class HomeController{


		public function index(){

			if(isset($_GET['loggout'])){
				session_unset();
				session_destroy();

				\DankiCode\Utilidades::redirect(INCLUDE_PATH);
			}


			if(isset($_SESSION['login'])){
				//Renderiza a home do usuário.
				\DankiCode\Views\MainView::render('home');
			}else{
				//Renderizar para criar conta.

				if(isset($_POST['login'])){
					$login = $_POST['email'];
					$senha = $_POST['senha'];

					

					//Verificar no banco de dados.

					$verifica = \DankiCode\MySql::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
					$verifica->execute(array($login));



					
					if($verifica->rowCount() == 0){
						//Não existe o usuário!
						\DankiCode\Utilidades::alerta('Não existe nenhum usuário com este e-mail...');
						\DankiCode\Utilidades::redirect(INCLUDE_PATH);
					}else{
						$dados = $verifica->fetch();
						$senhaBanco = $dados['senha'];
						if(\DankiCode\Bcrypt::check($senha,$senhaBanco)){
							//Usuário logado com sucesso
							$_SESSION['login'] = $dados['email'];
							$_SESSION['id'] = $dados['id'];
							$_SESSION['nome'] = explode(' ',$dados['nome'])[0];
							\DankiCode\Utilidades::alerta('Logado com sucesso!');
							\DankiCode\Utilidades::redirect(INCLUDE_PATH);
						}else{
							\DankiCode\Utilidades::alerta('Senha incorreta....');
							\DankiCode\Utilidades::redirect(INCLUDE_PATH);
						}
					}
					

				}

				\DankiCode\Views\MainView::render('login');
			}

		}

	}

?>