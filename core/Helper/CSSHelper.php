<?php
/**
 * This file contains the CSSHelper class.
 * 
 * PHP version 5.3
 * 
 * LICENSE: This file is part of Nuggets-PHP.
 * Nuggets-PHP is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * Nuggets-PHP is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Nuggets-PHP. If not, see <http://www.gnu.org/licenses/>. 
 */
namespace nuggets;

require_once('core/Helper/Helper.php');

/**
 * This class provides helper features for Cascading Style Sheets.
 * 
 * @package    nuggets\Helper
 * @category   PHP
 * @author     Rajdeep Das <das.rajdeep97@gmail.com>
 * @copyright  Copyright 2012 Rajdeep Das
 * @license    http://www.gnu.org/licenses/gpl.txt  The GNU General Public License
 * @version    GIT: v3.5
 * @link       https://github.com/dasrajdeep/nuggets-php
 * @since      Class available since Release 1.0
 */
class CSSHelper extends Helper {
    
    /**
     * Generates a CSS box shadow.
     * 
     * @param int $x
     * @param int $y
     * @param int $blur
     * @param string $color
     * @param boolean $inset
     * @return string
     */
    public static function getShadow($x,$y,$blur,$color,$inset=FALSE) {
        if($inset) $inset='inset';
        else $inset='';
        $attr=sprintf('%s %spx %spx %spx #%s',$inset,$x,$y,$blur,$color);
        $css='box-shadow:%s;
	-moz-box-shadow:%s;
	-webkit-box-shadow:%s;';
        return sprintf($css,$attr,$attr,$attr);
    }
    
    /**
     * Generates a CSS gradient.
     * 
     * @param string $start
     * @param string $stop
     * @return string
     */
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
    
    /**
     * Generates CSS transparency.
     * 
     * @param int $amount
     * @return string
     */
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
