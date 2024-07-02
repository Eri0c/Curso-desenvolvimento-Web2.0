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

    // Método para listar todos os usuários da comunidade.
    public static function listarComunidade() {
        $pdo = \DankiCode\MySql::connect();
        $comunidade = $pdo->prepare("SELECT * FROM usuarios");
        $comunidade->execute();

        return $comunidade->fetchAll(); // Retorna todos os resultados da consulta.
    }

    // Método para enviar solicitação de amizade.
    public static function solicitarAmizade($idPara) {
        $pdo = \DankiCode\MySql::connect();
        
        // Verifica se já existe uma solicitação de amizade entre os usuários.
        $verificaAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");
        $verificaAmizade->execute(array($_SESSION['id'], $idPara, $idPara, $_SESSION['id']));

        if ($verificaAmizade->rowCount() == 1) {
            return false; // Já existe uma solicitação de amizade.
        } else {
            // Insere uma nova solicitação de amizade no banco de dados.
            $insertAmizade = $pdo->prepare("INSERT INTO amizades VALUES (null,?,?,0)");
            if ($insertAmizade->execute(array($_SESSION['id'], $idPara))) {
                return true; // Inserção bem sucedida.
            }
        }
        
        return true; // Caso de erro ou inserção falhe, retorna true.
    }

    // Método para listar amizades pendentes (solicitações de amizade).
    public static function listarAmizadesPendentes() {
        $pdo = \DankiCode\MySql::connect();

        $listarAmizadesPendentes = $pdo->prepare("SELECT * FROM amizades WHERE recebeu  = ? AND estado = 0 ");

        $listarAmizadesPendentes->execute(array($_SESSION['id']));
        
        return $listarAmizadesPendentes->fetchAll();
  
    }
    public static function getUsuarioById($id){
        $pdo = \DankiCode\MySql::connect();

        $usuario = $pdo->prepare("SELECT * FROM usuarios WHERE id= ?");
        
        $usuario->execute(array($id));
        
        return $usuario->fetch();
    }

   

    // Método para verificar se já existe um pedido de amizade pendente.
    public static function existePedidoAmizade($idPara) {
        $pdo = \DankiCode\MySql::connect();
        
        // Verifica se já existe um registro de amizade entre os usuários.
        $verificaAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");
        $verificaAmizade->execute(array($_SESSION['id'], $idPara, $idPara, $_SESSION['id']));

        if ($verificaAmizade->rowCount() == 1) {
            return false; // Já existe um pedido de amizade.
        } else {
            return true; // Não existe pedido de amizade pendente.
        }
    }

    public static function atualizarPedidoAmizade($enviou,$estado){
        $pdo = \DankiCode\MySql::connect();

        if($estado == 0){
            //Recusei o pedido.
            
            $del  = $pdo->prepare("DELETE FROM amizades WHERE enviou = ? AND recebeu = ? AND estado = 0");
            $del->execute(array($enviou,$_SESSION['id']));

        }else if($estado == 1){
            $aceitarPedido = $pdo->prepare("UPDATE amizades SET estado = 1 WHERE enviou = ? AND recebeu  = ?");

            $aceitarPedido->execute(array($enviou,$_SESSION['id']));

            if($aceitarPedido->rowCount() == 1){
                return true;
            }else{
                return false;
            }
        }

    }
}
