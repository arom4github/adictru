<?php
        include("../include/config.php");
	session_start();

	$response=$_GET['json'];
	$rep=json_decode($response);

	$database= pg_connect("host={$db_host} dbname={$db_name} user={$db_user} password={$db_pass}");
	$cpt=1;
	if($_SESSION['id_user']!=NULL && $_SESSION['id_user']>=27750)
	{
		$user=$_SESSION['id_user'];
		foreach ($_SESSION['tableau'] as &$var)
		{
			$synonym=$rep[$cpt-1]->variable;
			if($synonym!='')
			{
				$query1="UPDATE resp SET word='$synonym' WHERE id_w=$var AND id_u=$user";
				$result1=pg_query($query1);
				if (!$result1) {
		  			echo "Une erreur s'est produite.\n";
		  			exit;
		  		}
			}
			$cpt++;
		}
		echo "Данные были отправлены.";
	}
?>
