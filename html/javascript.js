function addtag(tag,single) {
	var txt = document.getElementById('post');
	if(document.selection) {
		txt.focus();
		sel = document.selection.createRange();
		if(single == true) {
			sel.text = '[' + tag + ']';
		} else {
		    sel.text = '[' + tag + ']' + sel.text + '[/' + tag + ']';
		}
	} else if(txt.selectionStart || txt.selectionStart == '0') {
		if(single == true) {
			txt.value = (txt.value).substring(0, txt.selectionStart) + "["+tag+"]" + (txt.value).substring(txt.selectionEnd, txt.textLength);
		} else {
			txt.value = (txt.value).substring(0, txt.selectionStart) + "["+tag+"]" + (txt.value).substring(txt.selectionStart, txt.selectionEnd) + "[/"+tag+"]" + (txt.value).substring(txt.selectionEnd, txt.textLength);
		}
	} else {
		if(single) {
			txt.value = '[' + tag + ']';
		} else {
			txt.value = '[' + tag + '][/' + tag + ']';
		}
	}
	return;
}
function addurltag(type) {
	var txt = document.getElementById('post');
	if(type == "website")
	{
	var link = prompt("Type the address:", "http://");
	if(link.length == 0 || link == "http://") {
		return;
	} else {
		var link = "=" + link;
		var text;
		var sel2 = "";
		if(document.selection) {
			txt.focus();
			sel = document.selection.createRange();
			sel2 = sel.text;
		} else if(txt.selectionStart || txt.selectionStart == '0') {
			sel2 = (txt.value).substring(txt.selectionStart, txt.selectionEnd);
		}
		if(sel2.length > 0) {
			text = sel2;
		} else {
			text = prompt("Enter the link text:", "");
		}
	}
	if(document.selection) {
		txt.focus();
		sel = document.selection.createRange();
		sel.text = "[url" + link + "]" + text + "[/url]";
	} else {
		txt.value = (txt.value).substring(0, txt.selectionStart) + "[url" + link + "]" + text + "[/url]" + (txt.value).substring(txt.selectionEnd, txt.textLength);
	}
	
	}
	else if(type == "media")
	{
	var link = prompt("Type the address:", "http://");
	if(link.length == 0 || link == "http://") {
		return;
	} else {

		text = prompt("Enter media type:\r\n audio = 1, video = 2", "");
	}
	if((text.length == 0) || ((text != "1") && (text != "2")) ) {
	return;
	}
	else if (text == 1)
	{
	text = 'audio';
	}else if(text == 2)
	{
	text = 'video';
	}

		txt.value = (txt.value).substring(0, txt.selectionStart) + "[media=" + text + " " + info + "]" + link + "[/media]" + (txt.value).substring(txt.selectionEnd, txt.textLength);
	
	
	}
	else if(type == "flash")
	{
	var link = prompt("Type the address:", "http://");
	if(link.length == 0 || link == "http://") {
		return;
	} else {
	
		var info = prompt("Enter media width and height:\r\n Use this format: W#|H#", "W320|H240");

		if(info.length == 0)
		info = 'W320|H240';
		else
		{
		info;
		}
		
	}

	if(document.selection) {
		txt.focus();
		sel = document.selection.createRange();
		sel.text = "[flash=W320|H240]" + link + "[/flash]";
	} else { 
		txt.value = (txt.value).substring(0, txt.selectionStart) + "[flash=" + info + "]" + link + "[/flash]" + (txt.value).substring(txt.selectionEnd, txt.textLength);
	}
}
	return;
}
function addvaluetag(sValue,tag) {
	if(sValue=="") {
		return;
	}
	var txt = document.getElementById('post');
	if(document.selection) {
		txt.focus();
		sel = document.selection.createRange();
		sel.text = '['+tag+'=' + sValue + ']' + sel.text + '[/'+tag+']';
	} else if(txt.selectionStart || txt.selectionStart == '0') {	
		txt.value = (txt.value).substring(0, txt.selectionStart) + "["+tag+"="+sValue+"]" + (txt.value).substring(txt.selectionStart, txt.selectionEnd) + "[/"+tag+"]" + (txt.value).substring(txt.selectionEnd, txt.textLength);
	} else {
		txt.value = '['+tag+'=' + sValue + '][/'+tag+']';
	}
	return;
}

function addtxt(input,add) {
var obj=document.getElementById(input)
obj.value = obj.value + add;
}


function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit) 
	{
		field.value = field.value.substring(0, maxlimit);
	}
	else
	{
		countfield.value = maxlimit - field.value.length;
		if(countfield.value == 0)
	{
		alert("Number of carchters exceeded maxlimit");
	}

	}
}

function checkAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}

function popup(external, height, width) {
    options = 'height=' + height + ',width=' + width + ',scrollbars=yes,resizable=yes,top=0,left=0';
window.open(external, 'freedomcms', options);
}