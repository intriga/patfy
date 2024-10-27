<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogUserController extends Controller
{
    public static function getUserIpAddr(){
        
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;

    }

    /**
     * Get the operative system
     */
    public static function getOS() { 
        //global $user_agent;
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform  = "Unknown OS Platform";
        $os_array     = array(
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

        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;

        return $os_platform;
    }

    /**
     * Get the browser
     */
    public static function getBrowser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        //global $user_agent;
        $browser        = "Unknown Browser";
        $browser_array = array(
                                '/msie/i'      => 'Internet Explorer',
                                '/firefox/i'   => 'Firefox',
                                '/safari/i'    => 'Safari',
                                '/chrome/i'    => 'Chrome',
                                '/edge/i'      => 'Edge',
                                '/opera/i'     => 'Opera',
                                '/netscape/i'  => 'Netscape',
                                '/maxthon/i'   => 'Maxthon',
                                '/konqueror/i' => 'Konqueror',
                                '/mobile/i'    => 'Browser Phone Default'
                         );
    
        foreach ($browser_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $browser = $value;
    
        return $browser;
    }

    /**
     * 
     */
    public static function getLocationUser(){
        /**
         * Get the more details from user
         */
        $PublicIP = static::getUserIpAddr();
        $details  = file_get_contents("http://ipwhois.app/json/$PublicIP");
        $details  = json_decode($details, true);
        $success  = $details['success'];

        if ($success==true) {
            $country  = $details['country'];
            $city     = $details['city'];
            $isp      = $details['isp'];
            $region   = $details['region'];
        }else if($success==false){
            $country  = 'localhost';
            $city     = 'localhost';
            $isp      = 'localhost';
            $region   = 'localhost';
        }
        
        $dataUser = array('country' => $country,
                          'city' => $city,
                          'region' => $region,
                          'isp' => $isp );
        
        return $dataUser;
    }

    /* 
    *
    */
    public static function getCoordinatesUser(){
        //$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        $ip  = static::getUserIpAddr();
        $url = "https://ipwhois.app/json/$ip";
        $ch  = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $data = curl_exec($ch);
        curl_close($ch);

        if ($ip == "127.0.0.1") {
            $lat = 'localhost';
            $lon = 'localhost';

            $coordinateUser = array('lat' => $lat,
                                    'lon' => $lon);
        }else{
            $location = json_decode($data);            

            //dd($location);
            $lat = $location->latitude;
            $lon = $location->longitude;

            $coordinateUser = array('lat' => $lat,
                                    'lon' => $lon);
        }
       /*  if ($data) {
            $location = json_decode($data);            

            dd($location);
            $lat = $location->latitude;
            $lon = $location->longitude;

            $coordinateUser = array('lat' => $lat,
                                    'lon' => $lon);
                        
        }else{
            $lat = 'localhost';
            $lon = 'localhost';

            $coordinateUser = array('lat' => $lat,
                                    'lon' => $lon);
        }
         */
        return $coordinateUser;
    }
}
