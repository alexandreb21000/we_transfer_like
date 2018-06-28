<?php
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
            $fichier   = fopen("index.php", "r");
            $attachement = fread($fichier, filesize("index.php"));
            $attachement = chunk_split(base64_encode($attachement));
            fclose($fichier);
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
            $message.= "Content-Type: image/jpeg; name=\"index.php\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: base64".$passage_ligne;
            $message.= "Content-Disposition: attachment; filename=\"index.php\"".$passage_ligne;
            $message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
            $message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
            //========== 
            //=====Envoi de l'e-mail.
            mail($mail,$sujet,$message,$header);
            //==========

?>

<?php 
        $serveur ="localhost";
        $login = "root";
        $pass = "";

        try{
        $connexion = new PDO("mysql:host=$serveur;dbname=wetransfert",$login, $pass);
        $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //recupere le nom de l'expediteur
        if(isset($_POST['mailUploader'])){
            $mailUploader = $_POST['mailUploader'];
            }

        // action sur le fichier d'abord s'il y en a un
        if(isset($_FILES['fichierUpload']['tmp_name'])){

                $content_dir = 'dossier/'; // dossier où sera déplacé le fichier
                
                //recuperation du fichier en variable
                $tables = $_FILES['fichierUpload']['tmp_name'];

                foreach($tables as $table){ 
                }

                echo $table;
                $tmp_file = $_FILES['fichierUpload']['tmp_name'];

                
                //si le fichier a ete uploader
                if( !is_uploaded_file($table) )
                {
                    exit("Le fichier est introuvable");
                }
            
            
                // on copie le fichier dans le dossier de destination
                $name_file = $_FILES['fichierUpload']['name'];

                // Je recupere le nom de l'image en variable car certaine syntaxe de fonction n'accepte pas les tableaux
                $tabless = $_FILES['fichierUpload']['name'];
                
                foreach($tabless as $tableau){ 
                }
               
                // Compte le nombre de fichiers
                $countfiles = count($_FILES['fichierUpload']['name']);

                // Looping all filesnames
                for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['fichierUpload']['name'][$i];
                }

                // Looping all files                
                for($i=0;$i<$countfiles;$i++){
                    $file = $_FILES['fichierUpload']['tmp_name'][$i];
                    }


                //Deplacement fichier uploader via bouton upload        
                if( !move_uploaded_file($table, $content_dir . $tableau) )
                {
                    exit("Impossible de copier le fichier dans $content_dir");
                }
                // Je recupere le nom de l'image en tableau
                $imgName = $_FILES['fichierUpload']['name'];
               

                $fichierUpload = $imgName;
        }

        $dateUpload = date('d-m-Y-G-i');

        $stmt = $connexion->prepare("INSERT INTO Upload(fichierUpload,mailUploader,dateUpload) VALUES (:fichierUpload,:mailUploader,:dateUpload)");

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->bindParam(':fichierUpload',$table);
        $stmt->bindParam(':mailUploader',$mailUploader);
        $stmt->bindParam(':dateUpload',$dateUpload);        
        $stmt->execute();
       /* header("Status: 301 Moved Permanently", false, 301);
        header("Location: uploadfait.php");
        exit();*/
    }
    catch(PDOException $e) {
        echo"echec : ".$e -> getMessage();
        }
    ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/wetransfert.css">
    <title>We transfert</title>
</head>
<body>

        <header class="h10vh bgblack clrwhite d_flexcenter">
            <p>We transfert</p>
        </header>
        
            
        <section class="d_flexcenter row h80vh">

            <p class="fs100">UPLOAD EN COURS...</p>
            <?php
                $archivecree= array();
              if(isset($_POST['submit'])){
                    
                // Count total files
                $countfiles = count($_FILES['fichierUpload']['name']);

                // Looping all files
                for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['fichierUpload']['name'][$i];
                $archivecree[$i]= $filename;

                $essais = $archivecree;

                foreach($essais as $essai){ 
                }

                echo $essai;
                 // Je cree l'archive
                 $zip = new ZipArchive();
                 //nom de l'archive
                 $nomzip = "./".$filename."_".date('d-m-Y-G-i-s').".zip";
 
                 if ($zip->open($nomzip, ZipArchive::CREATE)!==TRUE) {
                     exit("Impossible d'ouvrir le fichier <$nomzip>\n");
                 }
                 //ajout fichier
                 $zip->addFile("./dossier/".$essai);
                 echo "Nombre de fichiers : " . $zip->numFiles . "\n";
                 echo "Statut :" . $zip->status . "\n";
                 $zip->close();
                
                }
                
            } 
            ?>
      
        </section>

 
        <footer class="h10vh bgblack clrwhite d_flexcenter">
            <p> lien lien lien lien</p>
        </footer>

    <script type="text/javascript" src="js/wetransfert.js"> </script>
</body>
</html>