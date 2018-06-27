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

            echo "email envoyé";
?>

<?php 
        $serveur ="localhost";
        $login = "root";
        $pass = "";

        try{
        $connexion = new PDO("mysql:host=$serveur;dbname=wetransfert",$login, $pass);
        $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_POST['mailUploader'])){
            $mailUploader = $_POST['mailUploader'];
            }
        if(isset($_FILES['fichierUpload']['tmp_name'])){

                $content_dir = 'dossier/'; // dossier où sera déplacé le fichier

                $tmp_file = $_FILES['fichierUpload']['tmp_name'];
                if( !is_uploaded_file($tmp_file) )
                {
                    exit("Le fichier est introuvable");
                }
            
            
                // on copie le fichier dans le dossier de destination
                $name_file = $_FILES['fichierUpload']['name'];


                /*
                
                while( !empty($tmp_file)){
                
                    echo $name_file;

                }
                */
            
                if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
                {
                    exit("Impossible de copier le fichier dans $content_dir");
                }

                $imgExt = substr($_FILES['fichierUpload']['name'], strrpos($_FILES['fichierUpload']['name'], '.') + 1);                
                $imgName = $_FILES['fichierUpload']['name'];                
                $fichierUpload = $imgName;
            }

        $dateUpload = date('d-m-Y-G-i');

        $stmt = $connexion->prepare("INSERT INTO Upload(fichierUpload,mailUploader,dateUpload) VALUES (:fichierUpload,:mailUploader,:dateUpload)");

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->bindParam(':fichierUpload',$fichierUpload);
        $stmt->bindParam(':mailUploader',$mailUploader);
        $stmt->bindParam(':dateUpload',$dateUpload);        
        $stmt->execute();
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
    <META HTTP-EQUIV="Refresh" CONTENT="5; URL=uploadfait.php">
    <link rel="stylesheet" href="css/wetransfert.css">
    <title>We transfert</title>
</head>
<body onload="depart();">

        <header class="h10vh bgblack clrwhite d_flexcenter">
            <p>We transfert</p>
        </header>
        
            
        <section class="d_flexcenter row h80vh">

            <p class="fs100">UPLOAD EN COURS...</p>
            <?php

            print_r($_FILES['fichierUpload']);
            
            ?>

        </section>

 
        <footer class="h10vh bgblack clrwhite d_flexcenter">
            <p> lien lien lien lien</p>
        </footer>

    <script type="text/javascript" src="js/wetransfert.js"> </script>
</body>
</html>