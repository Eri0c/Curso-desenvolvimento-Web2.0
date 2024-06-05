<?php

namespace DankiCode\Controllers;

class RegistrarController {
    public function index() {
        if (isset($_POST['registrar'])) {
            error_log('POST Data: ' . print_r($_POST, true)); // Log para depuração

            $nome = $_POST['nome'] ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;

            // Verifique se todos os campos foram preenchidos
            if (!$nome || !$email || !$senha) {
                \DankiCode\Utilidades::alerta('Por favor, preencha todos os campos.');
                \DankiCode\Utilidades::redirect(INCLUDE_PATH . 'registrar');
                return;
            }

            // Validando email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                \DankiCode\Utilidades::alerta('E-mail Inválido.');
                \DankiCode\Utilidades::redirect(INCLUDE_PATH . 'registrar');
            }
            // Validando requisitos da senha
            else if (strlen($senha) < 6) {
                \DankiCode\Utilidades::alerta('Senha é muito curta.');
                \DankiCode\Utilidades::redirect(INCLUDE_PATH . 'registrar');
            }
            // Verificando se email já existe no banco de dados
            else if (\DankiCode\Models\UsuariosModel::emailExists($email)) {
                \DankiCode\Utilidades::alerta('Este e-mail já existe no banco de dados!');
                \DankiCode\Utilidades::redirect(INCLUDE_PATH . 'registrar');
            }
            // Registrando usuário
            else {
                try {
                    $senhaHash = \DankiCode\Bcrypt::hash($senha);
                    $pdo = \DankiCode\MySql::connect();
                    $registro = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, ultimo_post, img) VALUES (?, ?, ?, ?, ?)");
                    $registro->execute(array($nome, $email, $senhaHash, '0000-00-00 00:00:00', 'default.png'));

                    \DankiCode\Utilidades::alerta('Registrado com sucesso!');
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                } catch (\PDOException $e) {
                    \DankiCode\Utilidades::alerta('Erro ao registrar: ' . $e->getMessage());
                }
            }
        }

        \DankiCode\Views\MainView::render('registrar');
    }
}
