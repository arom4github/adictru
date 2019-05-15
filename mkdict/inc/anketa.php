<?php


function anketa_form($err){
	global $_POST;
	global $locale;
	global $native_lang;

?>
<form method="post">
<table border=0 width=400px class="anketa">
<tr><td colspan=2><center><?php echo $locale['anketa_title']; ?></center>
	</td>
</tr>
<tr><td colspan=2 style="color:red"><center><?php echo $err; ?></center>
	</td>
</tr>
<tr><td align=right><?php echo $locale['age']; ?>:&nbsp;</td>
	<td>
		<select name="age">
			<?php
				for($i=16; $i<=31; $i++)
					echo "<option value=\"{$i}\">".$i."</option>"
			?>
		</select><!-- 		<input type=text name="age" value="<?php echo $_POST['age']?>"> -->
        </td> 
<tr><td align=right><?php echo $locale['sex']; ?>:&nbsp;</td>
	<td>
		<?php echo $locale['sex_m']; ?><input type=radio name="sex" value="M" 
				<?php echo ($_POST['sex'] == "M" || $_POST['sex'] != "F")?"checked":""; ?>>
		<?php echo $locale['sex_f']; ?><input type=radio name="sex" value="F"
				<?php echo ($_POST['sex'] == "F")?"checked":""; ?>>
	</td>
<!-- <tr><td align=right><?php echo $locale['edu']; ?>:&nbsp;</td>
	<td>
		<select name="edu">
			<?php
				for($i=1; $i<6; $i++)
					echo "<option value=\"{$i}\" ".(($_POST['edu'] == $i)?"selected":"") .">".$locale['edu_'.$i]."</option>"
			?>
		</select>	</td>
</tr> -->
<tr><td align=right><?php echo $locale['spec']; ?>:&nbsp;</td>
<!--	<td><input type=text name="spec" value="<?php echo $_POST['spec']?>"></td> -->
	<td><select name="spec">
	    <?php
		$sp=1;
		while(isset($locale["sp".$sp])){
		    echo "<option value=\"sp{$sp}\" ";
		    if($_POST['spec'] == "sp".$sp) echo "selected";
		    echo ">{$locale["sp".$sp]}</option>";
		    $sp++;
		}
	    ?>
	    </select>
	</td>
<tr><td align=right valign=top><?php echo $locale['lang']; ?>:&nbsp;</td>
	<td>
		<select name="lang_n" onChange="var v=document.getElementById('nl').value; var o=document.getElementById('ooo'); o.value=''; if(v=='oo')o.disabled=false; else o.disabled=true;" id="nl">
			<?php
				for($i=0; $i<count($native_lang); $i++){
					echo "<option value=\"{$native_lang[$i]}\" ";
					echo ">{$locale[$native_lang[$i]]}</option>";
				}
			?>
		</select><br>
		Другой: <input id="ooo" type=text name="other" disabled="disabled">
	</td>
</tr>
<tr><td align=right><?php echo $locale['city']; ?>:&nbsp;</td>
        <td><input type=text name="city" value="<?php echo $_POST['city']?>"></td>
<tr><td align=right><?php echo $locale['region']; ?>:&nbsp;</td>
        <td>
	<select name="region">
			<?php
			$i = 1;
			while(isset($locale["reg".$i])){                                                                                                        
					echo "<option value=\"".($i+1)."\" ";
					if($_POST['region'] == $i+1){ echo "selected"; }
					echo ">{$locale["reg".$i]}</option>";
			    $i++;
			}
			?>
	</select>
	</td>
<tr><td colspan=2 align=right>
	<input type="submit" name="submit" value="<?php echo $locale['Submit']; ?>">
</td></tr>
</table>
</form>
<?php
}

?>
