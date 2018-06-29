<?php

class PageController extends Controller {
    public function index(){

        //Check les erreurs lors de l'upload
        if(!empty($_FILES)){
            if(isset($_FILES))
            $upload = Meme::upload();
            $envoimail = Meme::envoimail();
        } 


        $limit = $this->route['params']["limit"];

        $template = $this->twig->loadTemplate('/Page/index.html.twig');
        echo $template->render(array(
            'meme' => isset($upload)
        ));


    }
}