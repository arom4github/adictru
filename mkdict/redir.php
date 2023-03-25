<?php
session_start();
$t = "";
if(isset($_GET['t'])){
    $t = $_GET['t'];
    if($t == '5FRx9MlmlVNmB')
		$_SESSION["test_id"] = 20;
    elseif($t == '16IiQtRLgAYrA')
		$_SESSION["test_id"] = 3;
//    elseif($t == 'OW0LU1jT7Hl9c')
//		$_SESSION["test_id"] = 15;
//    elseif($t == 'eMPamhq4rSWF2')
//		$_SESSION["test_id"] = 16;
//    elseif($t == '9npQgdtDeftpY')
//		$_SESSION["test_id"] = 17;
//    elseif($t == '1FhDnkdfHyHRA')
//		$_SESSION["test_id"] = 18;
//    elseif($t == '1LF623Vmx8Noc')
//		$_SESSION["test_id"] = 19;
    else {
		echo "The link seems to be broken";
		$t = "";
	}
}
if($t != ""){
?>
<html>	
<body onLoad="document.forms[0].submit();">
<form method="post" action="index.php"></form>
</body>
</html>
<?php 
}
?>
