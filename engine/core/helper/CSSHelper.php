<?php
Engine::uses("Helper");

class CSSHelper extends Helper {
    
    public static function getShadow($x,$y,$blur,$color,$inset=FALSE) {
        if($inset) $inset='inset';
        else $inset='';
        $attr=sprintf('%s %spx %spx %spx #%s',$inset,$x,$y,$blur,$color);
        $css='box-shadow:%s;
	-moz-box-shadow:%s;
	-webkit-box-shadow:%s;';
        return sprintf($css,$attr,$attr,$attr);
    }
    
    public static function getGradient($start,$stop) {
        $raw_xml='<?xml version="1.0" ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1 1" preserveAspectRatio="none">
            <linearGradient id="grad-ucgg-generated" gradientUnits="userSpaceOnUse" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%"'.sprintf(' stop-color="#%s"',$start).' stop-opacity="1"/>
                <stop offset="100%"'.sprintf(' stop-color="#%s"',$stop).' stop-opacity="1"/>
            </linearGradient>
            <rect x="0" y="0" width="1" height="1" fill="url(#grad-ucgg-generated)" />
            </svg>';
        $enc_xml=base64_encode($raw_xml);
        $attr="#".$start." 0%, #".$stop." 100%";
        $css=sprintf("background: #%s;
        background: url(data:image/svg+xml;base64,%s);",$start,$enc_xml).sprintf("
        background: -moz-linear-gradient(top,  %s);
        background: -webkit-linear-gradient(top,  %s);
        background: -o-linear-gradient(top,  %s);
        background: -ms-linear-gradient(top,  %s);
        background: linear-gradient(top,  %s);",$attr,$attr,$attr,$attr,$attr)."
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#".$start."), color-stop(100%,#".$stop."));
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#".$start."', endColorstr='#".$stop."',GradientType=0 );";
        return $css;
    }
    
    public static function getTransparency($amount) {
        $css='filter:alpha(opacity=%s);
            -moz-opacity:%s;
            -khtml-opacity:%s;
            opacity:%s;
            -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=%s)";';
        return sprintf($css,$amount*100,$amount,$amount,$amount,$amount*100);
    }
}

?>
