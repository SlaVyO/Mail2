<?php
require_once "../session.php";
//$category = [];
$fst = "";
$sec = "";
$forClass = 1;
$titleHtml = 'MAP';
require_once "./ht/head.php";
if ($isActiv){
	echo "<p style = \"text-align: right;\"><a href=\"./signout.php\">Exit</a></p><br><br>";
}

echo '<div class="smtp"><a href="./smtp.php">SMTP</a></div>';
echo '<div class="imap"><a href="./imap.php">IMAP</a></div>';
echo '<div class="imap"><a href="./setting.php">Setting</a></div>';
?> 
<?= require_once "./ht/futter.php";?>
