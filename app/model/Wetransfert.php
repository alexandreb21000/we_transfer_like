<?php

Class Wetransfert extends Model{

    public function test_input($data) {
        $data = trim($data );
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function upload() {
       
        
                //recupere le nom de l'expediteur                    
                if(isset($_POST['q1'])){
                $nomexpediteur = $_POST['q1'];
                }
                
                $choixg = isset($_POST['q1']) ? $_POST['q1'] : NULL;
   
                if(empty($choixg)){
                    echo "Remplis l'information Nom de famille<br>";
                }else {
                }

                if (!preg_match("/^[a-zA-Z ]*$/",$choixg)) {
                    echo "un chiffre dans le nom ?<br>";
                }

                //recupere le mail de l'expediteur        
                if(isset($_POST['q2'])){
                $mailUploader = $_POST['q2'];
                }
                $choixi = isset($_POST['q2']) ? $_POST['q2'] : NULL;

                if (empty($_POST["q2"])) {
                    $CourrielErr = "Email is required";
                    echo $CourrielErr;
                } else if (!filter_var($choixi, FILTER_VALIDATE_EMAIL)) {
                    $CourrielErr = "Invalid email format"; 
                    echo $CourrielErr;
                } 
                //recupere recipent    
                if(isset($_POST['q3'])){
                $recipent = $_POST['q3'];
                }

                //recupere le mail for friends        
                if(isset($_POST['q4'])){
                $mailFriends = $_POST['q4'];
                }

                $choixig = isset($_POST['q4']) ? $_POST['q4'] : NULL;

                if (empty($_POST["q4"])) {
                    $CourrielErr = "Email is required";
                    echo $CourrielErr;
                } else if (!filter_var($choixi, FILTER_VALIDATE_EMAIL)) {
                    $CourrielErr = "Invalid email format"; 
                    echo $CourrielErr;
                } 

                //recupere le messagesender        
                if(isset($_POST['message'])){
                    $messagesender = $_POST['message'];
                }
                $choixh = isset($_POST['message']) ? $_POST['message'] : NULL;
                $testcommentaires = Wetransfert::test_input($choixh);
        
                $nb_erreur = 0;
                if(!empty($_FILES)){
            
                    if(isset($_FILES['q6']['error'])){
                        switch($_FILES['q6']['error']){
                            case 1:
                                $message['urlImg'] = '';
                                $message['msg'] = "Votre fichier ne doit pas dépasser 1Go";
                                $message['type'] = 'error';
                                $nb_erreur++;
                                break;
                            case 2:
                                $message['urlImg'] = '';
                                $message['msg'] = "Erreur";
                                $message['type'] = 'error';
                                $nb_erreur++;
                                break;
                            case 3:
                                $message['urlImg'] = '';
                                $message['msg'] = "Une erreur est survenue lors du téléchargement.";
                                $message['type'] = 'error';
                                $nb_erreur++;
                                break;
                            case 4:
                                $message['urlImg'] = '';
                                $message['msg'] = "Aucun fichier n'a été séléctionné.";
                                $message['type'] = 'error';
                                $nb_erreur++;
                                break; 
                        }
                    }
                    
                    if($nb_erreur == 0){
        
                        $img = $_FILES['q6'];

                        $ext = substr($img['name'], strrpos($img['name'], '.') + 1);
                        //$allow_ext = array("jpg", "JPG", "png", "PNG", "JPEG", "jpeg", "GIF", "gif");
        
                        //if(in_array($ext, $allow_ext)){
                            //définit l'image en cours
                            $file_name = 'image_'.substr(md5($img['name']), 0, 5).'_'.time().'.'.$ext;
        
                            //Récupère le chemin temporaire + la direction où on veux l'envoyer.
                            $tmp_name = $_FILES["q6"]["tmp_name"];
                            $directory = $_SERVER['DOCUMENT_ROOT']."/wetransfertdef/app/assets/dossier/".$file_name;

                            move_uploaded_file($tmp_name, $directory);
                        //}
                    
                        $dateUpload = date('d-m-Y-G-i');


                    //upload
                    $db = Database::getInstance();
                    $stmt = $db->prepare("INSERT INTO upload(fichierUpload,mailUploader,dateUpload) VALUES (:fichierUpload,:mailUploader,:dateUpload)");
        
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
                    $stmt->bindParam(':fichierUpload',$file_name);
                    $stmt->bindParam(':mailUploader',$mailUploader);
                    $stmt->bindParam(':dateUpload',$dateUpload);        
                    $stmt->execute();
                        
            }
        }
    }

    public static function envoimail() {
        
    }

}

