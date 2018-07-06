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
                //$testcommentaires = Wetransfert::test_input($choixh);
        
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
                        $file_name = Wetransfert::cryptFileName($_FILES['q6']);
                        //$img = $_FILES['q6'];
                        //$ext = substr($img['name'], strrpos($img['name'], '.') + 1);
                        //$allow_ext = array("jpg", "JPG", "png", "PNG", "JPEG", "jpeg", "GIF", "gif");
        
                        //if(in_array($ext, $allow_ext)){
                            //définit l'image en cours
                            //$file_name = 'file_'.substr(md5($img['name']), 0, 5).'_'.time().'.'.$ext;
        
                            //Récupère le chemin temporaire + la direction où on veux l'envoyer.
                            $tmp_name = $_FILES["q6"]["tmp_name"];
                            $directory = $_SERVER['DOCUMENT_ROOT']."/we_transfer_like/app/assets/dossier/".$file_name;
                            //var_dump($_SERVER['DOCUMENT_ROOT']);die();
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

    //use PHPMailer\PHPMailer\PHPMailer;
    //use PHPMailer\PHPMailer\Exception;

    public static function cryptFileName($file)
{ 
     $img = $file;

     $ext = substr($img['name'], strrpos($img['name'], '.') + 1);
     //$allow_ext = array("jpg", "JPG", "png", "PNG", "JPEG", "jpeg", "GIF", "gif");
        
     //if(in_array($ext, $allow_ext)){
     //définit l'image en cours
     $file_name = 'file_'.substr(md5($img['name']), 0, 5).'_'.time().'.'.$ext;
     return $file_name;
}

    public static function envoimail() {
    $name = $_POST["q1"]; // input name
    $mailSender = $_POST["q2"]; // input mail sender
    $mailRecipient = $_POST["q3"]; // input mail recipient
    $mailFriend=$_POST["q4"]; // input mail copie
    $message=$_POST["message"]; 
    $fichierAEnvoyer=$_FILES["q6"]['name']; // nom du fichier à envoyer
    $fichierATelecharger=Wetransfert::cryptFileName($_FILES["q6"]); // nom du fichier crypté à télécharger 
     //$db = Database::getInstance();
    //Load Composer's autoloader
    $mail = new  PHPMailer\PHPMailer\PHPMailer();                              // Passing `true` enables exceptions
try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'abouhand@gmail.com'; "Laika Transfert";                 // SMTP username
            $mail->Password = 'Grigridu21';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($mailSender, $_POST['q1']);
            $mail->addAddress($mailRecipient, $mailRecipient);     // Add a recipient
            $mail->addAddress($mailFriend, $mailFriend);               // Name is optional
            $mail->addReplyTo($mailSender, 'sender');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'LAIKA TRANSFERT : vous avez un fichier à télécharger';
            $mail->Body    = '<table style="font-family:Arial;width:100vw;height:100vh" cellspacing="50">
                                <tr style="height:33%">
                                    <td style="width:16%"></td>
                                    <td style="width:68%;text-align:left;">
                                        <div onclick="alert(\'voir nos produits\')" style="cursor:pointer;">
                                            <table cellspacing="10">
                                                <tr>
                                                    <td style="width:30%; border:0px solid grey"><img src="../assets/img/chienne.png" alt="LAIKA Tansfert" style=" width:100%;" /></td>
                                                    <td style="width:70%; border:0px solid grey">Voir nos produits</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td style="width:16%"></td>
                                </tr>
                                <tr style="height:33%">
                                    <td style="width:16%"></td>
                                    <td style="width:68%"><div style="padding:15px;text-align:center;height:100%;background-color:#FFD8B9;border-radius:15px;border:2px solid #39134E;">'.$message .'</div></td>
                                    <td style="width:16%"></td>
                                </tr>
                                <tr style="height:20%">
                                    <td style="width:16%;"></td>
                                    <td style="width:68%"><div style="padding:15px;text-align:center;height:100%;background-color:#FFD8B9;border-radius:15px;border:2px solid #39134E;">
                                        <table style="width:100%"><tr><td style="width:20%"><img src="../assets/img/logo_laika_trasfert.png" alt="LAIKA Tansfert" style=" width:100%;" /></td><td>Vous avez un fichier à télécharger : <a href="http://urlpagetéléchargement/download/'.$fichierATelecharger.' ">cliquez ici pour accéder à la page de téléchargement</a></td></tr></table></div></td>
                                    <td style="width:16%"></td>
                                </tr>
                                <tr style="height:13%">
                                    <td style="width:16%"></td>
                                    <td style="text-align:center;width:68%"></td>
                                    <td style="width:16%"></td>
                                </tr>
                              </table>';
            $mail->AltBody = 'Laika transfert';
            $mail->send();
            echo 'Message has been sent';
            print_r($mail);
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }


    public static function downloadFile($filename)
    { $db = Database::getInstance();
      $sql = 
      "SELECT * FROM upload where fichierUpload = :fichier
      ";
      $stmt = $db->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->bindValue( ':fichier', $filename, PDO::PARAM_INT); 
      $stmt->execute();
        //print_r($stmt);
      return $stmt->fetchAll();
    }

}

