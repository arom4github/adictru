<?php
	include("../include/config.php");
	session_start();
	$database= pg_connect("host={$db_host} dbname={$db_name} user={$db_user} password={$db_pass}");
	if(isset($_POST['id_submit']))
	{
		$_SESSION['id_user']=(int) $_POST['id_number'];
	}
	if(isset($_POST['submit']))
	{
		$_SESSION['age']=$_POST['age'];
		$_SESSION['gender']=$_POST['gender'];
		$_SESSION['language']=$_POST['language'];
		$_SESSION['city']=$_POST['city'];
		$_SESSION['district']=$_POST['district'];
		$_SESSION['spec']=$_POST['spec'];
		$age=(int) $_SESSION['age'];
		$gender=$_SESSION['gender'];
		$language=$_SESSION['language'];
		$city=$_SESSION['city'];
		$district=(int) $_SESSION['district'];
		$spec=$_SESSION['spec'];
		$id_user=$_SESSION['id_user'];
		if($language!=NULL && $city!=NULL && $spec!=NULL)
		{
			$query="UPDATE users SET sex='$gender', spec='$spec', lang_n='$language', region='$district', city='$city', age='$age' WHERE id=$id_user";
			$result=pg_exec($query);
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>форма</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="body_bg">

	<div class="top_line">

	</div>

	<div class="menu_bg">
		<div id="navigator">
		</div>
	</div>

	<div id="form">
		<form id="identification" method="POST" action="admin.php">
		<fieldset class="fs">
			<legend class="search_criteria">Загрузить зарегистрированного пользователя</legend>
			<table>
				<tr>
					<?php
						$id_user=$_SESSION['id_user'];
						$query="SELECT * FROM users WHERE id=$id_user";
						$id_user_query=pg_query($database,$query);
						$user=pg_fetch_array($id_user_query);
						if(isset($_POST['id_submit']))
						{
							$_SESSION['age']=$user[8];
							$_SESSION['gender']=$user[1];
							$_SESSION['language']=$user[3];
							$_SESSION['city']=$user[5];
							$_SESSION['district']=$user[6];
							$_SESSION['spec']=$user[2];
						}
						if($user==NULL)
						{
							header('Location:index.html');
							exit();
						}
						else
						{
							echo "<td style='text-align: center; width: 200px;'>Идентификационный номер</td>";
							echo "<td><input type='number' id='id_number' name='id_number' value='$id_user'></td>";
							echo "<td><input class='mySubmit' onclick='display_loader()' type='submit' name='id_submit' id='id_submit' value='Отправить'></td>";
						}

					?>
				</tr>
			</table>
		</fieldset>
		</form>

		<form id="identification" method="POST" action="admin.php">
		<fieldset class="fs" id="new_user">
			<legend class="search_criteria">Информация о респонденте</legend>
			<table>
				<?php
					echo "<tr>";
					echo "<td style='text-align: center;'>возраст</td>";
					$age=$_SESSION['age'];
					echo "<td><input type='number' id='age' name='age' value='$age'></td>";

					echo "<td style='text-align: center;'>Пол</td>";
					$gender=$_SESSION['gender'];
					echo "<td><select id='gender' name='gender'>";
					if($gender=='t')
					{
						echo "<option value='t' selected> мужчина </option>";
						echo "<option value='f'> Женщина</option>";
					}
					else
					{
						echo "<option value='t'> мужчина </option>";
						echo "<option value='f' selected> Женщина</option>";
					}
					echo "</select></td>";

					echo "<td style='width: 200px; padding-left:20px;'>язык</td>";
					$language=$_SESSION['language'];
					echo "<td style='text-align:right;'><input style='width:240px;' type='text' id='language' name='language' value='$language'></td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td style='text-align: center;'>город</td>";
					$city=$_SESSION['city'];
					echo "<td colspan='3'><input type='text' id='city' name='city' value='$city'></td>";

					echo "<td colspan=1 style='padding-left:20px;'>Область</td>";
					$district=$_SESSION['district'];
					echo "<td><select id='district' name='district'>";
					if($district=='3')
					{
						echo "<option value='2'>Дальневосточный федеральный округ</option>";
						echo "<option value='3' selected>Сибирский федеральный округ</option>";
						echo "<option value='5'>Уральский федеральный округ</option>";
						echo "<option value='4'>Центральный федеральный округ</option>";
						echo "<option value='-1'>Не Россия</option>";
					}
					elseif($district=='2')
					{
						echo "<option value='2' selected>Дальневосточный федеральный округ</option>";
						echo "<option value='3'>Сибирский федеральный округ</option>";
						echo "<option value='5'>Уральский федеральный округ</option>";
						echo "<option value='4'>Центральный федеральный округ</option>";
						echo "<option value='-1'>Не Россия</option>";
					}
					elseif($district=='4')
					{
						echo "<option value='2'>Дальневосточный федеральный округ</option>";
						echo "<option value='3'>Сибирский федеральный округ</option>";
						echo "<option value='5'>Уральский федеральный округ</option>";
						echo "<option value='4' selected>Центральный федеральный округ</option>";
						echo "<option value='-1'>Не Россия</option>";
					}
					elseif($district=='5')
					{
						echo "<option value='2'>Дальневосточный федеральный округ</option>";
						echo "<option value='3'>Сибирский федеральный округ</option>";
						echo "<option value='5' selected>Уральский федеральный округ</option>";
						echo "<option value='4'> Центральный федеральный округ</option>";
						echo "<option value='-1'>Не Россия</option>";
					}
					else
					{
						echo "<option value='2'>Дальневосточный федеральный округ</option>";
						echo "<option value='3'>Сибирский федеральный округ</option>";
						echo "<option value='5'>Уральский федеральный округ</option>";
						echo "<option value='4'>Центральный федеральный округ</option>";
						echo "<option value='-1' selected>Не Россия</option>";
					}
					echo "</select></td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td style='text-align: center;'>специализация</td>";
					$spec=$_SESSION['spec'];
					echo "<td colspan=3><input type='text' id='spec' name='spec' value='$spec'></td>";
					echo "<td colspan=2 style='text-align: center;'>";
					echo "<div class='button'>";
					echo "<input class='mySubmit' onclick='display_loader()' type='submit' name='submit' id='submit' value='изменение'>";
					echo "</div>";
					echo "</td>";
					echo "</tr>";
				?>
			</table>
		</fieldset>
		</form>
	</div>

	<div id="form">
		<form id="words" method="POST" action="admin.php">
		</form>
	</div>

	<div class="left_side">
		<img id="left_arrow" src="imgs/left_arrow.png" alt="left_arrow"> 
	</div>

	<div class="right_side">
		<img id="right_arrow" src="imgs/right_arrow.png" alt="right_arrow"> 
	</div>


	<div id="res"></div>

	<div id="container"><div id="loader"></div></div>



<?php
	$id_user=$_SESSION['id_user'];
	$_SESSION['tableau']=array();
	//$query="SELECT id_w FROM resp WHERE id_u=$id_user";
	$query="select resp.id_w, resp.word, dict.word from resp inner join dict on resp.id_w=dict.id where id_u=$id_user order by resp.id_w";
	$res = pg_query($database,$query);
	if(!$res || pg_num_rows($res) == 0)
	{
		echo "Данные не найдены";
	}
	else
	{
		echo "<div id='form'>";
		echo "<table>";
		$cpt=1;
		while($row = pg_fetch_row($res)) {
                        array_push($_SESSION['tableau'], $row[0]);
			$result = $row[2];
			$prevSynonymString=$row[1];			
			if($result) {
				if($cpt%2==1) {
					echo "<tr>";
				}
				echo "<th class='left_tab'>".$cpt.". "." ".$result."<th>";
				echo "<th>"."<input class='input_word' type='text' id='synonym".$cpt."' name='synonym".$cpt."' value='$prevSynonymString'>"."<th>";	
				$cpt++;
				if($cpt%2==1) {
					echo"</tr>";
				}
			}
		}
                $_SESSION['cpt'] = $cpt;
		echo "<tr id='low_tab'>";
		echo "<th  colspan=8 style='padding-left:370px'>";
		echo "<button class='myButton'  onclick='save_to_data(); display_loader();'>";
		echo "послать";
		echo" </button>";
		echo "</th>";
		echo "</tr>";
		echo "</table>";
		echo "</div>";
	}

?>
<div id="msg" style="height: 100px;"></div>

</body>
</html>

<script>
	function display_loader()
	{
		document.getElementById('container').style.display="block";
	}

	function remove_display_loader()
	{
		document.getElementById('container').style.display="none";
	}

	var variable=<?php echo json_encode($_SESSION['id_user']); ?>;
	variable=parseInt(variable);

	$(document).ready(function(){
		$(".left_side").click(function(){
			$("#id_number").val(variable-1);
			$("#id_submit").click();
		});
		$(".right_side").click(function(){
			$("#id_number").val(variable+1);
			$("#id_submit").click();
		});
	});

	function save_to_json(number)
	{
		var variable=document.getElementById("synonym"+number).value;
		var jj= {"var":variable};
		return jj;
	}

	function save_to_data()
	{
		var length=<?php echo json_encode($_SESSION['cpt']); ?>;
		var i;
		var responses=[];
		for(i=1;i<length;i++)
		{
			var jj= save_to_json(i);
			responses.push(jj);
			var jjj=JSON.stringify(responses);
		}
		console.log(jjj);
		var xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("msg").innerHTML=this.responseText;
                remove_display_loader();
            }
        }
        //Sending infortation to servors
        xhttp.open("GET","respond.php?json="+jjj,true);
        xhttp.setRequestHeader('Contest-Type','application/x-www-form-urlencoded ;charset=utf-8');
        xhttp.send();
      }
</script>
