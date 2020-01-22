/*Img Error*/
$(document).ready(function(){
	$('img').error(function(){
		this.src='img/icons/default.png';
	});
});
/*Login window*/
function on(){
	setTimeout("document.getElementById('loginbg').style.display='block'", 100);
}	
function off(){
	setTimeout("document.getElementById('loginbg').style.display='none'", 100);
}
/*MobileMenu*/
function showMainMenu(){
	if ($('#navbar').css('display') == 'none'){
		$('#navbar').css("display", "block");
	}
	else{
		$('#navbar').css("display", "none");
	}
}
/*LoadPDF*/
function loadpdf(file, id){
	var blockid = "#pdf" + id;
	$.ajax ({
		url: "/fns/pdfhelper.php", 
		type: "POST",
		data: ({pdffile: file}), 
		dataType: "html", 
		success: function(data){
			$(blockid).html(data);
		}
	})
}
/*Pagedownloading*/
$(document).ready(function(){
	var pause = false;
	$(window).scroll(function(){
		if ($("div").is("#scrollifon")){
			var target = $('#scrollifon');
			var targetPos = target.offset().top;
			var winHeight = $(window).height();
			var scrollToElem = targetPos - winHeight;
			var winScrollTop = $(this).scrollTop();
			if ((winScrollTop >= scrollToElem) && (pause == false)){
				lastid = $( '.artid' ).filter(':last').val();
				$.ajax ({
					url: "/fns/downloadmore.php", 
					type: "POST",
					data: ({last: lastid, session: $('#scrollifon').html()}), 
					dataType: "html", 
					beforeSend: function(){
						pause = true;
					},
					success: function(data){
						$('#scrollifon').before(data);
						pause = false;
					}
				})
			}
		}
	});
});
/*SaveResults*/
function saveresults(){
	$.ajax({
        url: "/fns/addartfns.php", 
        type: "POST", 
        dataType: "html", 
        data: $("#myform").serialize(), 
        success: function(data) { //Если все нормально
			result = $.parseJSON(data);
			if (result.success == 0){
				alert("Can not save changes!!!");
			}
			else{
				alert("Changes saved!");
				if (result.last_id != -1){
					window.location.href = 'index.php?view=editarticle&id=' + result.last_id;
				}
			}	
        },
		error: function() { //Если ошибка
			alert("Can not save changes!");
		}
    });
}

/*Artsubject*/
function artsubject(){
	if (document.getElementById('artsubjects').style.display=='block') {
		setTimeout("document.getElementById('artsubjects').style.display='none'", 0);
	}
	else {
		setTimeout("document.getElementById('artsubjects').style.display='block'", 0);
	}
}
function artsubjectoff(){
	setTimeout("document.getElementById('artsubjects').style.display='none'", 0);
}
/*Upload window*/
function uploadon(){
	setTimeout("document.getElementById('uploadbg').style.display='block'", 100);
}	
function uploadoff(){
	setTimeout("document.getElementById('uploadbg').style.display='none'", 100);
}
/*Article Edit*/
function rtfsize(){
	if (document.getElementById('arteditdet').open == false){ $('#richTextField').css("height", "360px"); }
	else { $('#richTextField').css("height", "506px"); }
};
/*Textarea Edit*/
function iFrameEdit(){
	richTextField.document.designMode = 'On';	
	window.frames['richTextField'].document.body.innerHTML=document.getElementById('hiddentext').value;
	document.getElementById('selectfontfamily').value="Font Family";
	document.getElementById('selectfontsize').value="Size";
}
/*Textarea*/
function iFrameOn(){
	richTextField.document.designMode = 'On';	
}
function iBold(){
	richTextField.document.execCommand('bold',false,null); 
}
function iUnderline(){
	richTextField.document.execCommand('underline',false,null);
}
function iItalic(){
	richTextField.document.execCommand('italic',false,null); 
}
function iSubscript(){
	richTextField.document.execCommand('Subscript',false,null); 
}
function iSuperscript(){
	richTextField.document.execCommand('Superscript',false,null); 
}
function iStrikeThrough(){
	richTextField.document.execCommand('strikeThrough',false,null); 
}
function iHorizontalRule(){
	richTextField.document.execCommand('inserthorizontalrule',false);
}
function iUnorderedList(){
	richTextField.document.execCommand("InsertOrderedList", false,"newOL");
}
function iOrderedList(){
	richTextField.document.execCommand("InsertUnorderedList", false,"newUL");
}
function iLink(){
	var linkURL = prompt("Enter the URL for this link:", "http://"); 
	if(linkURL != 'http://' && linkURL != null){
		richTextField.document.execCommand("CreateLink", false, linkURL);
	}
}
function iUnLink(){
	richTextField.document.execCommand("Unlink", false, null);
}
function iImage(){
	var imgSrc = prompt('Enter image location', '');
	if(imgSrc != ''){
        richTextField.document.execCommand('insertimage', false, imgSrc); 
    }
}
function iSelectAll() {
		richTextField.document.execCommand("selectAll", false, null);
}
function iFontName(name){
	richTextField.document.execCommand("fontName", false, name);
	document.getElementById('selectfontfamily').value="Font Family";
}
function iFontSize(size){
	richTextField.document.execCommand('FontSize',false, size);
	document.getElementById('selectfontsize').value="Size";
}
function iHeading(head){
	richTextField.document.execCommand('formatBlock',false, head);
	document.getElementById('selectheading').value="Head";
}
function iRemoveFormat(){
	richTextField.document.execCommand('removeFormat',false,null); 
}
function iJustifyLeft(){
	richTextField.document.execCommand('justifyLeft',false,null); 
}
function iJustifyCenter(){
	richTextField.document.execCommand('justifyCenter',false,null); 
}
function iJustifyRight(){
	richTextField.document.execCommand('justifyRight',false,null); 
}
function iJustifyFull(){
	richTextField.document.execCommand('justifyFull',false,null); 
}
function iSpoiler(){
	var command = "<details class = 'spdet'><summary class = 'spsum'>Spoiler</summary><p><br></p></details><br>";
	richTextField.document.execCommand('insertHTML',false, command); 
}
function showcolorpanel(id){
	document.getElementById(id).style.display = 'block';
	document.getElementById("colorpanelclose").style.display = 'block';
}
function closecolorpanel(){
	document.getElementById('colorpanel1').style.display = 'none';
	document.getElementById('colorpanel2').style.display = 'none';
	document.getElementById("colorpanelclose").style.display = 'none';
}
function iHiliteColor(color){
	richTextField.document.execCommand('hiliteColor',false,color);
	document.getElementById('colorpanel1').style.display = 'none';
	document.getElementById("colorpanelclose").style.display = 'none';
}
function iForeColor(color){
	richTextField.document.execCommand('foreColor',false,color);
	document.getElementById('colorpanel2').style.display = 'none';
	document.getElementById("colorpanelclose").style.display = 'none';
}
function resize(size, name) {	
	var a = richTextField.document.getElementById(name).naturalWidth/1000*size;
	if (a>=32){ richTextField.document.getElementById(name).width=a; }
}
function resizeon(src){
	window.open(document.getElementById(src).src);
}
function submit_form(){
	var spoilers = richTextField.document.getElementsByTagName('details')
    for (var i = 0; i < spoilers.length; i++) spoilers[i].open = false;
	var theForm = document.getElementById("myform");
	theForm.elements["myTextArea"].value = window.frames['richTextField'].document.body.innerHTML;
	saveresults();
}
function submit_form2(){
	var spoilers = richTextField.document.getElementsByTagName('details')
    for (var i = 0; i < spoilers.length; i++) spoilers[i].open = false;
	var theForm = document.getElementById("myform");
	theForm.elements["myTextArea"].value = window.frames['richTextField'].document.body.innerHTML;
	theForm.submit();
}