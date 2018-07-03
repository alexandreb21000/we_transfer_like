<?php

Class Meme extends Model{

   

    public static function upload() {
        $db = Database::getInstance();
        function test_input($data) {
            $data = trim($data );
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
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
                $testcommentaires = test_input($choixh);
        
                // action sur le fichier d'abord s'il y en a un
                if(isset($_FILES['q6']['tmp_name'])){
        
                        $content_dir = 'C:\wamp64\www\PHP\wetransfertdef\app\assets\dossier/'; // dossier où sera déplacé le fichier
                        
                        //recuperation du fichier en variable
                        $tables = $_FILES['q6']['tmp_name'];
        
                        foreach($tables as $table){ 
                        }
                
        
                        $tmp_file = $_FILES['q6']['tmp_name'];
        
                        
                        //si le fichier a ete uploader
                        if( !is_uploaded_file($table) )
                        {
                            exit("Le fichier est introuvable");
                        }
                    
                    
                        // on copie le fichier dans le dossier de destination
                        $name_file = $_FILES['q6']['name'];
        
                        // Je recupere le nom de l'image en variable car certaine syntaxe de fonction n'accepte pas les tableaux
                        $tabless = $_FILES['q6']['name'];
                        
                        foreach($tabless as $tableau){ 
                        }
                       
                        // Compte le nombre de fichiers
                        $countfiles = count($_FILES['q6']['name']);
        
                        // Looping all filesnames
                        for($i=0;$i<$countfiles;$i++){
                        $filename = $_FILES['q6']['name'][$i];
                        }
        
                        // Looping all files                
                        for($i=0;$i<$countfiles;$i++){
                            $file = $_FILES['q6']['tmp_name'][$i];
                            }
        
        
                        //Deplacement fichier uploader via bouton upload        
                        if( !move_uploaded_file($table, $content_dir . $tableau) )
                        {
                            exit("Impossible de copier le fichier dans $content_dir");
                        }
                        // Je recupere le nom de l'image en tableau
                        $imgName = $_FILES['q6']['name'];
                       
        
                        $fichierUpload = $imgName;
                }
        
                $dateUpload = date('d-m-Y-G-i');


                    //upload
                $stmt = $db->prepare("INSERT INTO Upload(fichierUpload,mailUploader,dateUpload) VALUES (:fichierUpload,:mailUploader,:dateUpload)");
        
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
                $stmt->bindParam(':fichierUpload',$table);
                $stmt->bindParam(':mailUploader',$mailUploader);
                $stmt->bindParam(':dateUpload',$dateUpload);        
                $stmt->execute();
    }

    public static function envoimail() {
        $db = Database::getInstance();

            $mail = 'acssatge@gmail.com'; // Déclaration de l'adresse de destination.

            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|gmail).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
            {
                $passage_ligne = "\r\n";
            }
            else
            {
                $passage_ligne = "\n";
            }
            //=====Déclaration des messages au format texte et au format HTML.
            $message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
            $image = "https://sendeyo.com/show/4229983899";
            $message_html = "<html><head></head><body><img src='".$image."'>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
            //==========
            //=====Lecture et mise en forme de la pièce jointe.
            /*
            $fichier   = fopen("index.php", "r");
            $attachement = fread($fichier, filesize("index.php"));
            $attachement = chunk_split(base64_encode($attachement));
            fclose($fichier);*/
            //==========
            //=====Création de la boundary.
            $boundary = "-----=".md5(rand());
            $boundary_alt = "-----=".md5(rand());
            //==========
            //=====Définition du sujet.
            $sujet = "Hey mon ami !";
            //========
            //=====Création du header de l'e-mail.
            $header = "From: \"WeaponsB\"<acssatge@gmail.com>".$passage_ligne;
            $header.= "Reply-to: \"WeaponsB\" <acssatge@gmail.com".$passage_ligne;
            $header.= "MIME-Version: 1.0".$passage_ligne;
            $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
            //==========
            //=====Création du message.
            $message = $passage_ligne."--".$boundary.$passage_ligne;
            $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
            $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
            //=====Ajout du message au format texte.
            $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message.= $passage_ligne.$message_txt.$passage_ligne;
            //==========
            $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
            //=====Ajout du message au format HTML.
            $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message.= $passage_ligne.$message_html.$passage_ligne;
            //========
            //=====On ferme la boundary alternative.
            $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
            //=========
            $message.= $passage_ligne."--".$boundary.$passage_ligne;
            //=====Ajout de la pièce jointe.
            /*
            $message.= "Content-Type: image/jpeg; name=\"index.php\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: base64".$passage_ligne;
            $message.= "Content-Disposition: attachment; filename=\"index.php\"".$passage_ligne;
            $message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
            $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
            */ 
            //========== 
            //=====Envoi de l'e-mail.
            mail($mail,$sujet,$message,$header);
            //=========

    }

}

