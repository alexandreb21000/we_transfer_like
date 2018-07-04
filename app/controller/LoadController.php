<?php

class LoadController extends Controller {
    public function load(){
        $fileToLoad = $this->route["params"]["filename"];

        $downloadFile = Wetransfert::downloadFile($fileToLoad);
         /*print_r($downloadFile);
         var_dump($downloadFile);*/

//         foreach($downloadFile as $download){
//         $test = $download;
//         print_r( $test);
//}
//print_r($downloadFile);





        $template = $this->twig->loadTemplate('/Page/telechargement.html.twig');
        echo $template->render(array(
           'fileToLoad' => $downloadFile
           
        ));


    }
}