<?php namespace DankiCode\Controllers;

class ComunidadeController{
    
    public function index(){
        if(isset($_SESSION['login'])){

            if(isset($_GET['solicitarAmizade'])){
                $idPara = (int) $_GET['solicitarAmizade'];
                if(\DankiCode\Models\UsuariosModel::solicitarAmizade($idPara)){

                }
            }
        \DankiCode\Views\MainView::render('comunidade');
    }else{
        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
    }

    }
}