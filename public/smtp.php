<?php
require_once "../session.php";
$titleHtml = 'MAP';
require_once "./ht/head.php";
$forClass = 1;
if ($isActiv){
	echo "<p style = \"text-align: right;\"><a href=\"./signout.php\">Exit</a></p><br><br>";
}
require_once '../vendor/autoload.php';
require_once '../sendmail.php';

$error = [];
if (isset($_SESSION['hostProfile'])){
   if (!isset($_POST['host'])){
   $_POST['host']=$_SESSION['hostProfile']['shost'];
   }
  if (!isset($_POST['port'])){
   $_POST['port']=$_SESSION['hostProfile']['port'];
   }
   if (!isset($_POST['cript'])){
   $_POST['cript']=$_SESSION['hostProfile']['cript'];
   }
  if (!isset($_POST['email'])){
   $_POST['email']=$_SESSION['hostProfile']['email'];
   }
   if (!isset($_POST['pass'])){
   $_POST['pass']=$_SESSION['hostProfile']['pass'];
   }
  }
    

if (isset($_POST['dopost'])){
    if (!isset($_POST['image'])){
        $error[] = "Не выбрана картинка";
    }else {
        $image = "./images/thumbnail/image_".$_POST['image'].".jpg";
    }
    if ($_POST['subject'] == ''){
        $error[] = "Не указана тема";
    }else {
        $subject = $_POST['subject'];
    }
    if ($_POST['maintext'] == ''){
        $error[] = "Не указан текс письма";
    }else {
        $sendtext = $_POST['maintext'];
    }


    if ($_POST['sendto'] == ''){
        $error[] = "Не указан получатель";
    } else {
        $pre_sendto = trim($_POST['sendto']);
        /*$sendto = explode(", ", $_POST['sendto']);
      echo "<pre>";
      echo "/1/";
         print_r($sendto);
      echo "</pre>";
         //var_dump($sendto);*/
        if (substr_count($pre_sendto, '@') == 1 ){
        	$sendto = $pre_sendto;
        }else {
	        if (stripos($pre_sendto, ",")){
	            $split = ",";
	        }else if (stripos($pre_sendto, ";")){
	            $split = ";";
	        }else if (stripos($pre_sendto, " ")){
	            $split = " ";
	        }else {
	        	$error[] = "Адрес получателя указан с ошибкой";
	        }
	        
	        if (isset($split)){
	            $sendto = explode($split, $pre_sendto);
	            //print_r($sendto);
	        }
	    }
    }



    if (empty($error)){
$options = array(
    "host" => $_POST["host"],
    "port" => $_POST["port"],
    "cript" => $_POST["cript"],
    "login" => $_POST["email"],//stristr($_POST["email"], '@', true),
	"password" => $_POST["pass"],
    "senderMail" => $_POST["email"],
    "senderName" => "sender",
);
     // echo "<pre>";
     // print_r($options);
     // echo "</pre>";
      if (!sendMail($options, $sendto, $subject, $sendtext, $image)){
            $error[] = 'Ошибка отправки почты';
        }else{
        	$error[] = 'Письмо отправленно';
        	unset($_POST);
        }
    //var_dump($options);
    }

}


?>


  <p>Будем слать Телеграммы!</p>
  <p class = "error"><?= $error[0] ?? "" ?></p>
  <form method="POST">
  <input type="text" id="host" name="host" list="HostName" placeholder="Host" value="<?=$_POST['host'] ?? ''; ?>">
    <datalist id="HostName">
      <option value="mail.gmx.com">
      <option value="exampl">
    </datalist>
    
    <select id="port" name="port">
          <option value="465" selected>465</option>
      	<option value="587" >587</option>
        </select>
    <select id="cript" name="cript">
          <option value="ssl" selected>ssl</option>
      <option value="STARTTLS">STARTTLS</option>
      STARTTLS
        </select>

    <br>
  <input type="text" id="email" name="email" placeholder="Email" value="<?=$_POST['email'] ?? ''; ?>"><br>
  <input type="password" id="pass" name="pass" placeholder="Password" value="<?=$_POST['pass'] ?? ''; ?>"><br><br>
  <p><input type="text" name="sendto" placeholder="Адреса получателей" value="<?= $_POST['sendto'] ?? "" ?>"></p>
  <p><input type="text" name="subject" placeholder="Тема" value="<?= $_POST['subject'] ?? "" ?>"></p>
  <p><textarea rows="4" cols="35" name="maintext" placeholder="Текст" ><?= $_POST['maintext'] ?? "" ?></textarea></p>
  <p><b>Выберети картинку</b></p>
  <p><input type="radio" name="image" value="1"><img src="./images/thumbnail/image_1.jpg">&nbsp
  <input type="radio" name="image" value="2"><img src="./images/thumbnail/image_2.jpg">&nbsp
  <input type="radio" name="image" value="3"><img src="./images/thumbnail/image_3.jpg">&nbsp</p>
  <p><input type="radio" name="image" value="4"><img src="./images/thumbnail/image_4.jpg">&nbsp
  <input type="radio" name="image" value="5"><img src="./images/thumbnail/image_5.jpg">&nbsp
  <input type="radio" name="image" value="6"><img src="./images/thumbnail/image_6.jpg"></p>
  <p><input type="radio" name="image" value="7"><img src="./images/thumbnail/image_7.jpg">

  <p><input type="submit" name="dopost" value="Отправить"></p>
 </form>


 </body>
</html>
