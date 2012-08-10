function post(cmd,params,loader_id,callback) {
    $('#'+loader_id).show();
    var paramset="";
    for(var i=0;i<params.length;i++) paramset+="/"+Base64.encode(params[i]);
    var query=domain+cmd+paramset;
    $.post(query,{},function(data){
        $('#'+loader_id).hide();
        callback(data);
    });
}

function get(cmd,params,loader_id,callback) {
    $('#'+loader_id).show();
    var paramset="";
    for(var i=0;i<params.length;i++) paramset+="/"+Base64.encode(params[i]);
    var query=domain+cmd+paramset;
    $.get(query,{},function(data){
        $('#'+loader_id).hide();
        callback(data);
    });
}

function getPairs(form) {
    var pairs=new Array();
    $(form).find('input[type=text],input[type=password]').each(function(){
        var name=$(this).attr('name');
        var text=$(this).val();
        pairs.push(name+"="+text);
    });
    return pairs;
}

function submitForm(form,cmd,loader,callback) {
    var pairs=getPairs(form);
    post(cmd,pairs,loader,callback);
    return false;
}

function authenticate(form,cmd,loader,callback) {
    var pairs=getPairs(form);
    var xml='<auth>';
    for(var i=0;i<pairs.length;i++) {
        var set=pairs[i].split('=');
        if(set[0]=='userid') xml+='<username>'+set[1]+'</username>';
        else if(set[0]=='password') xml+='<password>'+set[1]+'</password>';
    }
    xml+='</auth>';
    var param=new Array("data="+xml);
    post(cmd,param,loader,callback);
    return false;
}

function changeCSSGradient(element,start,stop) {
    var xml_raw='<?xml version="1.0" ?><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1 1" preserveAspectRatio="none"><linearGradient id="grad-ucgg-generated" gradientUnits="userSpaceOnUse" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%"stop-color="#'+start+'" stop-opacity="1"/><stop offset="100%"stop-color="#'+stop+'" stop-opacity="1"/></linearGradient><rect x="0" y="0" width="1" height="1" fill="url(#grad-ucgg-generated)" /></svg>';
    var xml_enc=Base64.encode(xml_raw);
    var attr="#"+start+" 0%, #"+stop+" 100%";
    $(element).css({
        'background':'#'+start,
        'background':'url(data:image/svg+xml;base64,'+xml_enc+')',
        'background':'-moz-linear-gradient(top,  '+attr+')',
        'background':'-webkit-linear-gradient(top,  '+attr+')',
        'background':'-o-linear-gradient(top,  '+attr+')',
        'background':'-ms-linear-gradient(top,  '+attr+')',
        'background':'linear-gradient(top,  '+attr+')',
        'background':'-webkit-gradient(linear, left top, left bottom, color-stop(0%,#"'+start+'"), color-stop(100%,#"'+stop+'"))',
        'filter':"progid:DXImageTransform.Microsoft.gradient( startColorstr='#"+start+"', endColorstr='#"+stop+"',GradientType=0 )"
    });
}

function changeCSSShadow(element,x,y,blur,color,inset) {
    var attr=x+'px '+y+'px '+blur+'px #'+color;
    if(inset) attr='inset '+attr;
    $(element).css({
        'box-shadow':attr,
        '-moz-box-shadow':attr,
        '-webkit-box-shadow':attr
    });
}

function changeCSSTransparency(element,amount) {
    $(element).css({
        'filter':'alpha(opacity='+amount*100+')',
        '-moz-opacity':amount,
        '-khtml-opacity':amount,
        'opacity':amount,
        '-ms-filter':'"progid:DXImageTransform.Microsoft.Alpha(Opacity='+amount*100+')"'
    });
}

var poll_time;
var poll_command;
var poll_callback;
function startPolling(time,command,callback) {
    poll_time=time;
    poll_command=command;
    poll_callback=callback;
    poll();
}

function poll() {
    $.get(domain+poll_command,{},function(data){
        poll_callback(data);
    });
    setTimeout("poll()",poll_time);
}