<?php
require_once "../session.php";
require_once('../lib/class.imap.php');
require_once "./ht/head.php";
$forClass = 1;
$titleHtml = 'MAP';
if ($isActiv){
	echo "<p style = \"text-align: right;\"><a href=\"./signout.php\">Exit</a></p><br><br>";
}


if (isset($_SESSION['hostProfile'])){
   if (!isset($_POST['host'])){
   $_POST['host']=$_SESSION['hostProfile']['ihost'];
   }
  if (!isset($_POST['email'])){
   $_POST['email']=$_SESSION['hostProfile']['email'];
   }
   if (!isset($_POST['pass'])){
   $_POST['pass']=$_SESSION['hostProfile']['pass'];
   }
  }

function map(){
	$imap = new Imap();
    $connection_result = $imap->connect('{'.$_POST['host'].'/imap/ssl}INBOX', $_POST['email'], $_POST['pass']);
	if ($connection_result !== true) {
        //return $connection_result; //Error message!
        
    }else {
        //return $imap->setLimit(10)->getMessages('text', 'asc');
        return "OK";
    }
	
}

if (isset($_POST['Sub'])) {
 // echo "OK";
$messages = map();
 echo '<pre>';
print_r($messages);
echo '</pre>';
}




?>
<form action="/imap.php" method="post">
  <input type="text" id="host" name="host" list="HostName" placeholder="Host" value="<?=$_POST['host'] ?? ''; ?>"><br>
    <datalist id="HostName">
      <option value="imap.gmx.com:993">
      <option value="exampl">
    </datalist>
  <input type="text" id="email" name="email" placeholder="Email" value="<?=$_POST['email'] ?? ''; ?>"><br>
  <input type="password" id="pass" name="pass" placeholder="Password" value="<?=$_POST['pass'] ?? ''; ?>"><br><br>
  <input type="submit" value="Submit" name="Sub">
</form> 
<?= require_once "./ht/futter.php";?>
