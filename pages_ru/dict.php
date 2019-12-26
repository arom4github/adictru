
<script type="text/javascript" language="javascript">
<?php
if($dict == "list")
    echo "function do_onLoad(){ch_list_dict_(1);}";
elseif($dict == "stim")
    echo "function do_onLoad(){hideAdv(); show_stim();}";
elseif($dict == "right")
    echo "function do_onLoad(){show_modal('#rdict_selector');}"; //AdvSearch_r();
else // back
	echo "function do_onLoad(){show_modal('#bdict_selector');}"; //AdvSearch_r();
?>

$(document).ready(function(){  
	//get the height and width of the page  
	var window_width = $(window).width();  
	var window_height = $(window).height();  
  
	//vertical and horizontal centering of modal window(s)  
	// we will use each function so if we have more then 1 modal window we center them all
	$('.bdict_selector').each(function(){  
    	//get the height and width of the modal  
    	var modal_height = $(this).outerHeight();  
    	var modal_width = $(this).outerWidth();  
  
    	//calculate top and left offset needed for centering  
    	var top = (window_height-modal_height)/2;  
    	var left = (window_width-modal_width)/2;  
  
    	//apply new top and left css values  
    	$(this).css({'top' : top , 'left' : left});  
	});

	$('.rdict_selector').each(function(){  
    	//get the height and width of the modal  
    	var modal_height = $(this).outerHeight();  
    	var modal_width = $(this).outerWidth();  
  
    	//calculate top and left offset needed for centering  
    	var top = (window_height-modal_height)/2;  
    	var left = (window_width-modal_width)/2;  
  
    	//apply new top and left css values  
    	$(this).css({'top' : top , 'left' : left});  
	});
	$('.db_selector').each(function(){  
    	//get the height and width of the modal  
    	var modal_height = $(this).outerHeight();  
    	var modal_width = $(this).outerWidth();  
  
    	//calculate top and left offset needed for centering  
    	var top = (window_height-modal_height)/2;  
    	var left = (window_width-modal_width)/2;  
  
    	//apply new top and left css values  
    	$(this).css({'top' : top , 'left' : left});  
	});
	$('.order').click(function(){
		var type = $(this).attr('name');
		close_modal('.rdict_selector');
		close_modal('.bdict_selector');
		close_modal('.db_selector');
		$("#"+type+'_order').css({'display':'block'});
	});
        $('.db_link').click(function(){
		var tid = $(this).attr('name');
		var date = new Date();
		close_modal("");
		date.setTime(date.getTime()+(30*24*60*60*1000));
		document.cookie='test='+tid+'; expires='+date.toGMTString();
		window.location="http://adictru.nsu.ru/dict";
	});
}); 
function close_modal(str){  
    //hide the mask  
    $('#mask').fadeOut(500);  
    //hide modal window(s)  
    $(str).fadeOut(500);  
}  
function show_modal(str){  
    //set display to block and opacity to 0 so we can use fadeTo  
    $('#mask').css({ 'display' : 'block', opacity : 0});  
    //fade in the mask to opacity 0.8  
    $('#mask').fadeTo(500,0.8);  
     //show the modal window  
    $(str).fadeIn(500);  
}
</script>
<?php
function uni_strsplit($string, $split_length=1)
{
    preg_match_all('`.`u', $string, $arr);
    $arr = array_chunk($arr[0], $split_length);
    $arr = array_map('implode', $arr);
    return $arr;
}
?>
<div class="dict_content">
    <div id="dict_menu">
        <?php
            $right_class = "dict";
            $back_class = "dict";
            $list_class = "dict";
            $stim_class = "dict";

            if($dict == "right"){
                $right_class .= "_act";
            }
            if($dict == "back"){
                $back_class .= "_act";
            }
            if($dict == "list"){
                $list_class .= "_act";
            }
            if($dict == "stim"){
                $stim_class .= "_act";
            }
        ?>
		<table border=0 width="100%" cellpadding=0 cellspacing=0>
		<td>
		<table id="nav-tbl">
        <td><a href="dictright" class="<?php echo $right_class; ?>"><?php echo $locale['right']; ?></a></td>
        <td><a href="dictback"  class="<?php echo $back_class; ?>"><?php echo $locale['back']; ?></a></td>
<!--        <td><a href="<?php /* echo "dictlist"; */?>"  class="<?php echo $list_class; ?>"><?php echo $locale['anketas']; ?></a></td> -->
        <td><a href="stimlist"  class="<?php echo $stim_class; ?>"><?php echo $locale['stimulas']; ?></a></td>
        <td><a href="#" class="dict" onClick="show_modal('.db_selector');"><?php echo "База данных" ?></a></td>
		</table>
		</td>
		<td>
		<img src="imgs/document-print.png" alt="print" align="right" width="20px" border="0"
                 onclick="my_print('<?php echo "{$dict}_{$test}"; ?>');">
		</td>
		</table>
		<?php 
			$rows = db_get_tests();
        		for($i=0; $i<count($rows); $i++){
                		if($rows[$i][3] == $_COOKIE['test']) 
					echo "{$rows[$i][2]}";
        		}
		
		?>

    </div>
    <div class="search_criteria" id="s_criteria">
    <form action="" enctype="application/x-www-form-urlencoded">
        <fieldset class="fs">
            <legend class="search_criteria"><?php echo $locale['s_criteria']; ?></legend>
            <?php include 'include/search_creteria.php';?>
        </fieldset>
    </form>
    </div>
    <div class="abc">
	<form action="" onsubmit="search_word(); return false;">
        <?php
        if($dict == "right"){
		?>
		<div id='rabc_order' class='abc_in'>
		<?php
	    $abc = "АБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЫЭЮЯ";
	    //$abc1= "абвгдежзийклмнопрстуфхцчшщыэюя";
	    $aabc = uni_strsplit($abc);
            for($i=0; $i<strlen($abc); $i++){
              //    echo "<span  class=\"abc_link\" onclick=\"chDict('".(ord($abc[2*$i])*256 + ord($abc[2*$i+1]))."')\">".$aabc[$i]."</span>";
                  echo "<span  class=\"abc_link\" onclick=\"chDict('{$aabc[$i]}')\">".$aabc[$i]."</span>";
            }
	?>
	      </div>
              <div id='rword_order' class='abc_in'>
		<?php echo "{$locale['stimul']}:";?> 
		<input type="text" name="stimul" value=""/>
            	<input type="button" value="Найти" onclick="search_word();">
	      </div>
       
        <?php
	}
	if($dict == "back"){
	?>
			<div id='abc_order' class='abc_in'>
        	<?php   
			//$num = "?0123456789";
            		//for($i=0; $i<strlen($num); $i++){
                  	//	echo "<span  class=\"abc_link\" onclick=\"chDict('".(ord($num[$i]))."')\">".$num[$i]."</span>";
            		//}		
	    		$abc = "?0123456789АБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЫЭЮЯ";
	   		$aabc = uni_strsplit($abc);
            		for($i=0; $i<strlen($abc); $i++){
                  		//echo "<span  class=\"abc_link\" onclick=\"chDict('".(ord($abc[2*$i])*256 + ord($abc[2*$i+1]))."')\">".$aabc[$i]."</span>";
                  		echo "<span  class=\"abc_link\" onclick=\"chDict('{$aabc[$i]}')\">".$aabc[$i]."</span>";
            		}		
	?>
			</div>
            <div id='word_order' class='abc_in'>
				<?php echo "{$locale['resp']}:";?> <input type="text" name="stimul" value=""/>
            	<input type="button" value="Найти" onclick="search_word();">
			</div>
			<div id='stim_order' class='abc_in'>
				Количество стимулов: 
					<span  class="abc_link" onclick="chDict_st(600, 200);">600-200</span>&nbsp;
					<span  class="abc_link" onclick="chDict_st(199, 150);">199-150</span>&nbsp;
					<span  class="abc_link" onclick="chDict_st(149, 100);">149-100</span>&nbsp;
					<span  class="abc_link" onclick="chDict_st(90, 50);">99-50</span>&nbsp;
					<span  class="abc_link" onclick="chDict_st(49, 1);">49-1</span>&nbsp;
			</div>
			<div id='resp_order' class='abc_in'>
				Количество реакций:
					<span  class="abc_link" onclick="chDict_rs(11000, 2000);">11000-2000</span>&nbsp;
					<span  class="abc_link" onclick="chDict_rs(1999, 1500);">1999-1500</span>&nbsp;
					<span  class="abc_link" onclick="chDict_rs(1499, 1000);">1499-1000</span>&nbsp;
					<span  class="abc_link" onclick="chDict_rs(999, 750);">999-750</span>&nbsp;
					<span  class="abc_link" onclick="chDict_rs(749, 500);">749-500</span>&nbsp;
					<span  class="abc_link" onclick="chDict_rs(499, 250);">499-250</span>&nbsp;
					<span  class="abc_link" onclick="chDict_rs(249, 1);">249-1</span>&nbsp;
			</div>
        <?php
	}
        if($dict == "list"){
        ?>
            <span class="abc_link" onClick="getAnketa(-100);">&lt;&lt;&lt;</span>&nbsp;
            <span class="abc_link" onClick="getAnketa(-10);">&lt;&lt;</span>&nbsp;
            <span class="abc_link" onClick="getAnketa(-1);">Пред.</span>&nbsp;
            <span id="anketa">1</span> из <span id="anketas">1</span>&nbsp;
            <span class="abc_link" onClick="getAnketa(+1);">След.</span>&nbsp;
            <span class="abc_link" onClick="getAnketa(+10);">&gt;&gt;</span>&nbsp;
            <span class="abc_link" onClick="getAnketa(+100);">&gt;&gt;&gt;</span>
        <?php
        }
        if($dict == "stim"){
            echo "Выберите стимул из списка";
        }
        ?>
            		</form>
    </div>
    <div class="searc_result">
        <fieldset class="fs">
            <legend class="search_result"><?php echo $locale['s_result']; ?></legend>
            <div id="results">
                Выберите первую букву стимула/реакции<br>
            </div>
        </fieldset>
    </div>
</div>
<div id='mask'></div> 
<div id='info'></div> 
<div id="bdict_selector" class="bdict_selector">
	Выбор порядка представления информации:
	<ul>
		<li><a href="#" name="abc" class="order">В алфавитном порядке реакций</a> 
		<li><a href="#" name="stim" class="order">По количеству стимулов</a>
		<li><a href="#" name="resp" class="order">По количеству реакций</a>
		<li><a href="#" name="word" class="order">По отдельному слову</a>
	</ul>
</div>
<div id="rdict_selector" class="rdict_selector">
	Выбор порядка представления информации:
	<ul>
		<li><a href="#" name="rabc" class="order">В алфавитном порядке реакций</a> 
		<li><a href="#" name="rword" class="order">По отдельному слову</a>
	</ul>
</div>
<div id="db_selector" class="db_selector">
	Выбор базы данных словарей
	<ul>
           <li><a href="#" class="db_link" name="1">СИБАС основной корпус</a>
           <li><a href="#" class="db_link" name="21">Подкорпус ассоциаций военных</a>
           <li><a href="#" class="db_link" name="22">Подкорпус вербальных ассоциаций носителей русского языка в Казахстане</a>
	</ul>
</div>
<?php $url="http://adictru.nsu.ru/dict{$dict}"; ?>

