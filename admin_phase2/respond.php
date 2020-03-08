<?php
        include("../include/config.php");
	session_start();

	$response=$_GET['json'];
	$rep=json_decode($response);

	$database= pg_connect("host={$db_host} dbname={$db_name} user={$db_user} password={$db_pass}");
	if($_SESSION['id_user']!=NULL && $_SESSION['id_user']>=27750)
	{
		$user=$_SESSION['id_user'];
		$query="select resp.id_w, resp.word from resp where id_u=$user order by resp.id_w";
		$res=pg_query($query);
		$cpt=1;

		foreach ($_SESSION['tableau'] as &$var)
		{
			$synonym=$rep[$cpt-1]->var;
			$arr = pg_fetch_array($res,$cpt-1);
			if($synonym!='' && $var == $arr['id_w'] && $arr['word']!= $synonym)
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
