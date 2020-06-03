/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var resp_type = [];


function GetXmlHttpObject() {
  var xmlHttp;

  try {
    // Для всех, кроме IE6 и позже
    xmlHttp = new XMLHttpRequest();
  }
  catch(e) {
    var xmlVers = new Array ("MSXML2.XMLHTTP.6.0",
            "MSXML2.XMLHTTP.5.0",
            "MSXML2.XMLHTTP.4.0",
            "MSXML2.XMLHTTP.3.0",
            "MSXML2.XMLHTTP",
            "Microsoft.XMLHTTP");
    // Перебираем возможные варианты, пока не получится
    for (var i=0; i<xmlVers.length && !xmlHttp; i++) {
      try {
        xmlHttp = new ActiveXObject(xmlVers[i]);
      }
      catch(e) {}
    }
  }

  if (!xmlHttp) {
    alert ("Ошибка создания xmlHttp");
    return false;
  }

  return xmlHttp;
}

function GetXmlHttpObject_() {
  var xmlHttp=null;
  try {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
  } catch (e) {
    // Internet Explorer
    try {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
  return xmlHttp;
}

function stateChanged_data_() {
        if (xmlHttp.readyState==1){
                document.getElementById("results").innerHTML="Loading...";
        }
        if (xmlHttp.readyState==2){
                document.getElementById("results").innerHTML="Loading...1";
        }
        if (xmlHttp.readyState==3){
                document.getElementById("results").innerHTML="Loading...2";
        }
        if (xmlHttp.readyState==4){
                var resp = xmlHttp.responseText.replace(/:([0-9]+)/g, "&nbsp;($1)");
                resp = resp.replace(/{f ([^{}]+)}/g, "<td valign=\"top\" class=\"sr_\" class=\"nchk\">$1</td>");
                resp = resp.replace(/{t ([^{}]+)}/g, "<td valign=\"top\" class=\"sr_\">$1</td>");
                resp = resp.replace(/{([^{}]+)}/g, "<td valign=\"top\">$1</td>");
                resp = resp.replace(/\\([0-9]+)\\/g, "<b>$1</b>");
                resp = resp.replace(/\|/g, "<br>");
                document.getElementById("results").innerHTML=resp;
//              alert(xmlHttp.responseText.length+":"+resp.length);
                resp = xmlHttp.responseText.match(/<!-- ([0-9]+) -->/g);
                var obj = document.getElementById("anketas");
                if(obj) obj.innerHTML=resp[1].toString().match(/[0-9]+/);
                //alert(resp);
                obj = document.getElementById("anketa");
                if(obj) obj.innerHTML=resp[0].toString().match(/[0-9]+/);
		$('.rsp').click(function(e){
                     var url = "";
		     url  = "http://search1.ruscorpora.ru/search.xml?env=alpha&mycorp=&mysent=&mysize=&mysentsize="+
                               "&mydocsize=&dpp=&spp=&spd=&text=lexform&mode=main&sort=gr_tagging&lang=ru&nodia=1&req=";
		     if (e.ctrlKey)
                         url+="\""+$(this).parent().parent().children('td.sr_').text()+"\"+\""+$(this).text()+"\"";
		     else
                         url+="\""+$(this).text()+"\"+\""+$(this).parent().parent().children('td.sr_').text()+"\"";
                     var win = window.open(url, '_blank');
                     win.focus();
		     //alert($(this).text()+" <- "+$(this).parent().parent().children('td.sr_').text());
		});
		$('.rsp').mouseenter(function(e){
			x = e.pageX; y = e.pageY; //console.log(x, y);
  			$('#info').css({ "display":"block","top": y-70, "left": x-200});
			$('#info').text($(this).parent().parent().children('td.sr_').text()+" -> "+$(this).text()+ "<br>"+str);
		});
		$('.rsp').mouseleave(function(e){
  			$('#info').css({"display": "none"});
		});
        }
//        edit_reg=0;
}

function stateChanged_data() {
        if (xmlHttp.readyState==1){
                document.getElementById("results").innerHTML="Loading...";
        }
        if (xmlHttp.readyState==2){
                document.getElementById("results").innerHTML="Loading...1";
        }
        if (xmlHttp.readyState==3){
                document.getElementById("results").innerHTML="Loading...2";
        }
        if (xmlHttp.readyState==4){
                var resp = xmlHttp.responseText;
		var jstr = resp.substring(0,resp.search("<table"));
		resp = resp.substring(resp.search("<table"),resp.length);
		var str = "";
		if(jstr.length>0){
			var  json_ = JSON.parse(jstr);
			if(json_.length>0) str = parse_dict(json_);
		}
		resp = resp.replace(/:([0-9]+)/g, "&nbsp;($1)");
                resp = resp.replace(/{f ([^{}]+)}/g, "<td valign=\"top\" class=\"sr_\" class=\"nchk\">$1</td>");
                resp = resp.replace(/{t ([^{}]+)}/g, "<td valign=\"top\" class=\"sr_\">$1</td>");
                resp = resp.replace(/{([^{}]+)}/g, "<td valign=\"top\">$1</td>");
                resp = resp.replace(/\\([0-9]+)\\/g, "<b>$1</b>");
                resp = resp.replace(/\|/g, "<br>");
                document.getElementById("results").innerHTML=resp; //str;
                resp = xmlHttp.responseText.match(/<!-- ([0-9]+) -->/g);
                var obj = document.getElementById("anketas");
                if(obj) obj.innerHTML=resp[1].toString().match(/[0-9]+/);
                obj = document.getElementById("anketa");
                if(obj) obj.innerHTML=resp[0].toString().match(/[0-9]+/);
		$('.rsp').click(function(e){
                     var url = "";
		     url  = "http://search1.ruscorpora.ru/search.xml?env=alpha&mycorp=&mysent=&mysize=&mysentsize="+
                               "&mydocsize=&dpp=&spp=&spd=&text=lexform&mode=main&sort=gr_tagging&lang=ru&nodia=1&req=";
		     if (e.ctrlKey)
                         url+="\""+$(this).parent().parent().children('td.sr_').text()+"\"+\""+$(this).text()+"\"";
		     else
                         url+="\""+$(this).text()+"\"+\""+$(this).parent().parent().children('td.sr_').text()+"\"";
                     var win = window.open(url, '_blank');
                     win.focus();
		});
		$('.rsp').mouseenter(function(e){
			x = e.pageX; y = e.pageY; //console.log(x, y);
			str = $(this).parent().parent().children('td.sr_').text()+" -> "+$(this).text();
			if($(this).text() in resp_type && resp_type[$(this).text()] != null) str = $(this).text() + ": " + resp_type[$(this).text()]; 
  			$('#info').css({ "display":"block","top": y-70, "left": x-200});
			$('#info').text(str);
		});
		$('.rsp').mouseleave(function(e){
  			$('#info').css({"display": "none"});
		});
        }
}

function parse_dict(json_){
	var str = "";
	resp_type = [];

	str = "<table width=\"100%\" border=1 class=\"result\">"
		+ "<tr><td>&nbsp;</td>"
        	+ "<td width=\"150px\"><b><span class='res_header'>Stimul</span></b><img src='imgs/sort.png' alt='sort' border=0 class='sort'></td>"
        	+ "<td><b><span class='res_header'>Response</span></b> <img src='imgs/sort.png' alt='sort' border=0 class='sort'></td></tr>";
	for(i=0; i<json_.length; i++){
		var s = "<tr><td valign=\"top\">"+(i+1)+"</td><td valign=\"top\" class=\"sr_\" class=\"nchk\">"+json_[i].word+"</td><td>";
		for(j=0; j<json_[i].data.length; j++){
			for(k=0; k<json_[i].data[j].words.length; k++){
				resp_type[json_[i].data[j].words[k]] = json_[i].data[j].wtype[k];
				if(k==0)
					s+=" <span class='rsp'>"+json_[i].data[j].words[k]+"</span>";
				else
					s+="; "+"<span class='rsp'>"+json_[i].data[j].words[k]+"</span>";
			}
			s+= " <b>"+json_[i].data[j].val+"</b>; ";
		}
		s+="<br>("+json_[i].stat[0]+", "+json_[i].stat[1]+", "+json_[i].stat[2]+", "+json_[i].stat[3]+")</td></tr>\n";
		str += s
	}
	str = str + "</table>";
	console.log(resp_type);
	return str;
}

