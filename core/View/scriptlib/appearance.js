var nf=nf || {};

nf.changeCSSGradient=function(element,start,stop) {
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

nf.changeCSSShadow=function(element,x,y,blur,color,inset) {
    var attr=x+'px '+y+'px '+blur+'px #'+color;
    if(inset) attr='inset '+attr;
    $(element).css({
        'box-shadow':attr,
        '-moz-box-shadow':attr,
        '-webkit-box-shadow':attr
    });
}

nf.changeCSSTransparency=function(element,amount) {
    $(element).css({
        'filter':'alpha(opacity='+amount*100+')',
        '-moz-opacity':amount,
        '-khtml-opacity':amount,
        'opacity':amount,
        '-ms-filter':'"progid:DXImageTransform.Microsoft.Alpha(Opacity='+amount*100+')"'
    });
}
