<?php

class PageController extends Controller {
    public function index(){

        //Check les erreurs lors de l'upload
        if(!empty($_FILES)){
            if(isset($_FILES))
            $upload = Wetransfert::upload();
            $envoimail = Wetransfert::envoimail();
        } 


        $limit = $this->route['params']["limit"];

        $template = $this->twig->loadTemplate('/Page/index.html.twig');
        echo $template->render(array(
            'wetransfert' => isset($upload)
        ));


    }
}