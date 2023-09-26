<?php
require_once "../session.php";
$titleHtml = 'setting';
require_once "./ht/head.php";
$forClass = 1;
if ($isActiv){
	echo "<p style = \"text-align: right;\"><a href=\"./signout.php\">Exit</a></p><br><br>";
}
$error = [];
/*
echo "<pre>";
if (isset($_SESSION['hostProfile'])){
var_dump($_SESSION['hostProfile']);
}
if (isset($_POST)){
var_dump($_POST);
}
echo "</pre>";
 */   

if (isset($_POST['dopost'])){
    if (isset($_POST['shost']) && $_POST['shost'] != ''){
        $_SESSION['hostProfile']['shost']=$_POST['shost'];
    }
    if (isset($_POST['port']) && $_POST['port'] != ''){
        $_SESSION['hostProfile']['port']=$_POST['port'];
    }
    if (isset($_POST['cript']) && $_POST['cript'] != ''){
        $_SESSION['hostProfile']['cript']=$_POST['cript'];
    }
    if (isset($_POST['ihost']) && $_POST['ihost'] != ''){
        $_SESSION['hostProfile']['ihost']=$_POST['ihost'];
    }
    if (isset($_POST['email']) && $_POST['email'] != ''){
        $_SESSION['hostProfile']['email']=$_POST['email'];
    }
    if (isset($_POST['pass']) && $_POST['pass'] != ''){
        $_SESSION['hostProfile']['pass']=$_POST['pass'];
    }
    


echo "<pre>";
var_dump($_SESSION['hostProfile']);
echo "</pre>";
}

if (isset($_POST['outpost'])){
	$_POST['pass'] = $_SESSION['hostProfile']['pass'] ?? '';
	$_POST['email'] = $_SESSION['hostProfile']['email'] ?? '';
	$_POST['ihost'] = $_SESSION['hostProfile']['ihost'] ?? '';
	$_POST['cript'] = $_SESSION['hostProfile']['cript'] ?? '';
  	$_POST['port'] = $_SESSION['hostProfile']['port'] ?? '';
	$_POST['shost'] = $_SESSION['hostProfile']['shost'] ?? '';
}
  if (isset($_POST['delpost'])){
   unset($_SESSION['hostProfile']); 
    unset($_POST);
  }

?>


  <p class = "error"><?= $error[0] ?? "" ?></p>
  <form method="POST">
  <input type="text" id="shost" name="shost" list="SmtpHostName" placeholder="SMTP Host" value="<?=$_POST['shost'] ?? ''; ?>">
    <datalist id="SmtpHostName">
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
    <input type="text" id="ihost" name="ihost" list="ImapHostName" placeholder="IMAP Host" value="<?=$_POST['ihost'] ?? ''; ?>">
    <datalist id="ImapHostName">
      <option value="imap.gmx.com:993">
      <option value="exampl">
    </datalist>
    <br>
  <input type="text" id="email" name="email" placeholder="Email" value="<?=$_POST['email'] ?? ''; ?>"><br>
  <input type="password" id="pass" name="pass" placeholder="Password" value="<?=$_POST['pass'] ?? ''; ?>"><br><br>
  
  <p><input type="submit" name="dopost" value="set"></p>
  <p><input type="submit" name="outpost" value="get"></p>
    <br>
    <p><input type="submit" name="delpost" value="del"></p>
 </form>


 </body>
</html>
