<?php

# File created using Visual Studio Code: https://code.visualstudio.com/
# Created by Naisend. Telegram contact: https://t.me/elipheleh



function getVisitorIPAddress()
{
    if (getenv('HTTP_CLIENT_IP')) {
        return getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
        return getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('HTTP_X_FORWARDED')) {
        return getenv('HTTP_X_FORWARDED');
    } elseif (getenv('HTTP_FORWARDED_FOR')) {
        return getenv('HTTP_FORWARDED_FOR');
    } elseif (getenv('HTTP_FORWARDED')) {
        return getenv('HTTP_FORWARDED');
    } elseif (getenv('REMOTE_ADDR')) {
        return getenv('REMOTE_ADDR');
    } else {
        return 'UNKNOWN';
    }
}


/**
 * This function takes one optional parameter
 * @param: $ip : Optional IP address/hostname of visitor
 */
function getVisitorCountry($ip = null)
{
    if ($ip == null) {
        $ip = getVisitorIPAddress();
    }
    if ($ip === 'UNKNOWN') {
        return '';
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/".$ip);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    $IP_LOOKUP = @json_decode($result);
    return $IP_LOOKUP->country;
}


function getVisitorOS()
{
    $OS_ERROR = "Unknown OS Platform";
    $OS = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );
    foreach ($OS as $regex => $value) {
        if (preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
            $OS_ERROR = $value;
        }
    }
    return $OS_ERROR;
}


function getVisitorBrowser()
{
    $BROWSER_ERROR = "Unknown Browser";
    $BROWSER = array(
        '/msie/i'       =>  'Internet Explorer',
        '/firefox/i'    =>  'Firefox',
        '/safari/i'     =>  'Safari',
        '/chrome/i'     =>  'Chrome',
        '/edge/i'       =>  'Edge',
        '/opera/i'      =>  'Opera',
        '/netscape/i'   =>  'Netscape',
        '/maxthon/i'    =>  'Maxthon',
        '/konqueror/i'  =>  'Konqueror',
        '/mobile/i'     =>  'Handheld Browser'
    );
    foreach ($BROWSER as $regex => $value) {
        if (preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
            $BROWSER_ERROR = $value;
        }
    }
    return $BROWSER_ERROR;
}
