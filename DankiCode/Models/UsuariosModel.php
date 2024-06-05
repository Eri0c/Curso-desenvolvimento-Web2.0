<?php 
namespace DankiCode\Models;

class UsuariosModel {

    // Método para verificar se o email já existe no banco de dados.
    public static function emailExists($email) {
        // Conectando ao banco de dados.
        $pdo = \DankiCode\MySql::connect();
        
        // Preparando a consulta para verificar o email.
        $verificar = $pdo->prepare("SELECT email FROM usuarios WHERE email = ?");
        $verificar->execute(array($email));

        // Verificando se o email existe.
        if ($verificar->rowCount() == 1) {
            // Email existe.
            return true;
        } else {
            // Email não existe.
            return false;
        }
    }
}
