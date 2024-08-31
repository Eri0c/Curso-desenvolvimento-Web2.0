<?php
namespace DankiCode\Models;

class HomeModel {

    public static function postFeed($post){
        $pdo = \DankiCode\MySql::connect();
        $post = strip_tags($post);
        //TODO: substituir texto de imagem pela tag
        if(preg_match('/\[imagem/',$post)){
            $post = preg_replace('/(.*?)\[imagem=(.*?)\]/','<p>$1</p><img src=$2 />', $post);
        }else{
            $post = '<p>'.$post.'</p>';
        }
    
        //Inserindo posts na base de dados
        $postFeed = $pdo->prepare("INSERT INTO `posts` VALUES (null,?,?,?)");
        $postFeed->execute(array($_SESSION['id'],$post,date('Y-m-d H:i:s',time())));

        //Atualizando o usuario do ultimo post
        
        $atualizaUsuario = $pdo->prepare("UPDATE usuarios SET ultimo_post = ? WHERE id = ?");
        $atualizaUsuario->execute (array(date('Y-m-d H:i:s',time()),$_SESSION['id']));
    }

}
    