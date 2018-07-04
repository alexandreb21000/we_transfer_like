<?php

class SuccesController extends Controller {
    public function index(){

    
        $limit = $this->route['params']["limit"];

        $template = $this->twig->loadTemplate('/Page/succes.html.twig');
        echo $template->render(array(
            'wetransfert' => isset($upload)
        ));


    }
}
