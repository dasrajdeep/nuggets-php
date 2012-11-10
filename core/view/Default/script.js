$(document).ready(function(){
	$('.loader').hide();
	themeLink();
	themeButton();
	themeText();
	themeTable();
});
function themeTable() {
	var sel='table[class="themed"]';
	$(sel).css({'color':'#2c7cb4'});
	$(sel).attr("cellspacing", "0px");
	var flag=0;
	$(sel).find('tr').each(function(){
		if(flag==0) $(this).css({'background-color':'#b0b0b0'});
		flag=1-flag;
	});
	$('<tr><td></td></tr>').appendTo(sel);
}
function themeLink() {
	$('a').hover(function(){
		$(this).css({'color':'#FF6347'});
	}, function(){
		$(this).css({'color':'#B0C4DE'});
	});
}
function themeButton() {
	var sel='input[type=button],button,input[type=submit],input[type=reset]';
	$(sel).hover(function(){$(this).css({
		'color':'#1c5a85',
		'box-shadow':'0px 0px 5px #ebedee',
		'-moz-box-shadow':'0px 0px 5px #ebedee',
		'-webkit-box-shadow':'0px 0px 5px #ebedee',
		'text-shadow':'0px 0px 5px #3093c7'
	});}, function(){$(this).css({
		'color':'#1c5a85',
		'box-shadow':'none',
		'-moz-box-shadow':'none',
		'-webkit-box-shadow':'none',
		'text-shadow':'none'
	});});
	$(sel).mousedown(function(){$(this).css({
		'box-shadow':'inset 0px 0px 5px #333333',
		'-moz-box-shadow':'inset 0px 0px 5px #333333',
		'-webkit-box-shadow':'inset 0px 0px 5px #333333'
	});});
	$(sel).mouseup(function(){$(this).css({
		'box-shadow':'0px 0px 5px #ebedee',
		'-moz-box-shadow':'0px 0px 5px #ebedee',
		'-webkit-box-shadow':'0px 0px 5px #ebedee'
	});});
}
function themeText() {
	var txt=$('input[type=text],input[type=password],textarea');
	$(txt).focus(function(){$(this).css({
		'box-shadow':'inset 0px 0px 10px #1c5a85',
		'-moz-box-shadow':'inset 0px 0px 10px #1c5a85',
		'-webkit-box-shadow':'inset 0px 0px 10px #1c5a85'
	});});
	$(txt).blur(function(){$(this).css({
		'box-shadow':'inset 0px 0px 5px #1c5a85',
		'-moz-box-shadow':'inset 0px 0px 5px #1c5a85',
		'-webkit-box-shadow':'inset 0px 0px 5px #1c5a85'
	});});
}