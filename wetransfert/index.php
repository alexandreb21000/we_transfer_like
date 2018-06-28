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
    <link rel="stylesheet" href="css/wetransfert.css">
    <title>We transfert</title>
</head>
<body>

        <header class="h10vh bgblack clrwhite d_flexcenter">
            <p>We transfert</p>
        </header>
        
            
        <section class="d_flexcenter row h80vh">

            <img class="col m4 s10 h30vh bgWhite p0 bordure" name="output_img" class="" id="ajax"/>

            <form class="dflex flex_column border" method="POST" action="fichierUpload.php" enctype="multipart/form-data">
            <label for="mailUploader">mail exp&eacute;diteur</label>
            <input type="text" name="mailUploader">

            <label for="mailCopy">mail copie</label>            
            <input type="text" name="mailCopy">

            <label for="mailUploader">Message</label>            
            <textarea name="message" rows="8" class="h20vh w20vh" cols="45">Message...</textarea><br>

            <input type="file" name="fichierUpload[]" id="fichierUpload" multiple>

            <input type="submit" name="submit" id="submit" value="Cr&eacute;er">
            </form>

                      <?php 
                    if(isset($_POST['submit'])){
                    
                    // Count total files
                    $countfiles = count($_FILES['file']['name']);

                    // Looping all files
                    for($i=0;$i<$countfiles;$i++){
                    $filename = $_FILES['file']['name'][$i];
                    
                    echo $filename;
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