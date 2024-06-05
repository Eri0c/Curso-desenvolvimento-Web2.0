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


        public static function listarComunidade(){
            $pdo = \DankiCode\MySql::connect();
            $comunidade = $pdo->prepare("SELECT * FROM usuarios");
            $comunidade->execute();

            return $comunidade->fetchAll();
        }

        public static function solicitarAmizade($idPara){
            $pdo = \DankiCode\MySql::connect();
            
            $verificaAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");

            $verificaAmizade->execute(array($_SESSION['id'],$idPara,$idPara,$_SESSION['id']));

            if($verificaAmizade->rowCount() == 1){
                return false;
            }else{
                //Podemos inserir no banco de dados a solicitação
                $insertAmizade = $pdo->prepare("INSERT INTO amizades VALUES (null,?,?,0)");
                if(
                    $insertAmizade->execute(array($_SESSION['id'],$idPara))){
                        return true;
                    }

            }
            
            return true;
            
        }

        public static function existePedidoAmizade($idPara){
            $pdo = \DankiCode\MySql::connect();
            
            $verificaAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");

            $verificaAmizade->execute(array($_SESSION['id'],$idPara,$idPara,$_SESSION['id']));

            if($verificaAmizade->rowCount() == 1){
                return false;
            }else{
                return true;
            }

        }
}
