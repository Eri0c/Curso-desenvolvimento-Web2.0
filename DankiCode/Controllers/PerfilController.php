<?php 


namespace DankiCode\Controllers;

class PerfilController{

    public function index(){
        if(isset($_SESSION['login'])){
            \DankiCode\Views\MainView::render('perfil');
        }else{
            \DankiCode\Utilidades::redirect(INCLUDE_PATH);
        }
    }
}