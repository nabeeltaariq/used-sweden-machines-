<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AdminPages;
use App\UserPages;

class Admin extends Controller
{
    public function getPages(Request $request)
    {
        $pages = AdminPages::all();
        return json_encode($pages);

    }


    public function Index(Request $request)
    {
        //c:f%B'De}!2$uKr5

        if ($request->session()->has("activeUser")) {
            return view("admin.dashboard");

        }
        return view("loginPage");
    }


     public function Logout()
    {
      session()->pull("activeUser");

        return redirect("/admin");
    }

    public function ChangePassword(Request $request)
    {
        return view("admin.changePasswordForm");

    }

    //need to append main website
    public function MakeBackupDb(Request $request)
    {
        $this->EXPORT_DATABASE("localhost", "trepakpk_usmdemo", "Godisgreat@134", "trepakpk_usmdemo");
        return back();
    }

    protected function EXPORT_DATABASE($host, $user, $pass, $name, $tables = false, $backup_name = false)
    {
        set_time_limit(3000);
        $mysqli = new \mysqli($host, $user, $pass, $name);
        $mysqli->select_db($name);
        $mysqli->query("SET NAMES 'utf8'");
        $queryTables = $mysqli->query('SHOW TABLES');
        while ($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if ($tables !== false) {
            $target_tables = array_intersect($target_tables, $tables);
        }
        $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $name . "`\r\n--\r\n\r\n\r\n";
        foreach ($target_tables as $table) {
            if (empty($table)) {
                continue;
            }
            $result = $mysqli->query('SELECT * FROM `' . $table . '`');
            $fields_amount = $result->field_count;
            $rows_num = $mysqli->affected_rows;
            $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
            $TableMLine = $res->fetch_row();
            $content .= "\n\n" . $TableMLine[1] . ";\n\n";
            $TableMLine[1] = str_ireplace('CREATE TABLE `', 'CREATE TABLE IF NOT EXISTS `', $TableMLine[1]);
            for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
                while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                    if ($st_counter % 100 == 0 || $st_counter == 0) {
                        $content .= "\nINSERT INTO " . $table . " VALUES";
                    }
                    $content .= "\n(";
                    for ($j = 0; $j < $fields_amount; $j++) {
                        $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                        if (isset($row[$j])) {
                            $content .= '"' . $row[$j] . '"';
                        } else {
                            $content .= '""';
                        }
                        if ($j < ($fields_amount - 1)) {
                            $content .= ',';
                        }
                    }
                    $content .= ")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                        $content .= ";";
                    } else {
                        $content .= ",";
                    }
                    $st_counter = $st_counter + 1;
                }
            }
            $content .= "\n\n\n";
        }
        $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
        $backup_name = $backup_name ? $backup_name : $name . '___(' . date('H-i-s') . '_' . date('d-m-Y') . ').sql';
        ob_get_clean();
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header('Content-Length: ' . (function_exists('mb_strlen') ? mb_strlen($content, '8bit') : strlen($content)));
        header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");
        echo $content;
        exit;
    }

//end of need to append main website

    public function SavePassword(Request $request)
    {
        if ($request->input("password") == $request->input("confirmPassword")) {
            $activeUser = $request->session()->get("activeUser");
            $activeUser->pass = md5($request->input("password"));
            unset($activeUser->password);
            $activeUser->save();

            $request->session()->put("activeUser", $activeUser);

            return view("admin.changePasswordForm", ["success" => "Password Changed Successfully"]);
        } else {
            return view("admin.changePasswordForm", ["error" => "Password and Confirm Passwords are not same"]);
        }
    }

    protected function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    protected function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/OPR/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        } elseif (preg_match('/Edge/i', $u_agent)) {
            $bname = 'Edge';
            $ub = "Edge";
        } elseif (preg_match('/Trident/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern
        );
    }

    protected function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city" => @$ipdat->geoplugin_city,
                            "state" => @$ipdat->geoplugin_regionName,
                            "country" => @$ipdat->geoplugin_countryName,
                            "country_code" => @$ipdat->geoplugin_countryCode,
                            "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

    public function ProcessRequest(Request $request)
    {

//        $url = "https://www.google.com/recaptcha/api/siteverify";
//		  $testdata = [
//			  "secret" => "6LeZq9gUAAAAAJeFL1UopthwusHQBs_ntRx92S78",
//			  "response" => $_POST["token"],
//			  "remoteip" => $_SERVER["REMOTE_ADDR"]
//		  ];
//
//		  $options = array(
//			  'http' => array(
//				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//				'method'  => 'POST',
//				'content' => http_build_query($testdata)
//			  )
//			);
//
//
//	  //captcha integration ended
//	  $context  = stream_context_create($options);
//	  $response = file_get_contents($url, false, $context);

//	$res = json_decode($response, true);
//	if($res['success'] == true) {

        $username = $request->input("username");
        $password = $request->input("password");
       

        $count = User::where("username", $username)->where("pass", md5($password))->count();

        if ($count >= 1) {
//            date_default_timezone_set("Asia/Karachi");
            $user = User::where("username", $username)->where("pass", md5($password))->first();
            $request->session()->put("activeUser", $user);
//            //sending email
//                $message = "The following user has been login to admin panel of USM\n";
//                $message.= "Username: $username\n";
//                $message.= "Having ip address: " . $this->get_client_ip() . "\n";
//                $message .= "Using Browser: " . $this->getBrowser()["name"] . "\n";
//                $message .= "Country: " . $this->ip_info("Visitor","Country") . "\n";
//
//                $message .= "City: " . $this->ip_info("Visitor","City") . "\n";
//                $message .= "Login date and Time: " . date("Y-m-d h:i:s") . "\n";
//                mail("inquiry@trepak.pk","New Login USM",$message,"From:no-reply@usedswedenmachines.com\r\n");

            //end of sending email
            return redirect("/admin");
        } else {
            return view("loginPage", ["error" => ""]);
        }
//        }else{
//            return view("loginPage",["error" => ""]);
//        }


    }

    public function userManagement(Request $request)
    {
        return view("admin.userManagement", ["users" => User::all()]);

    }

    public function newUserForm(Request $request)
    {
        return view("admin.newUserForm");
    }

    public function addNewUser(Request $request)
    {
        $user = new User();
        $user->fname = $request->fname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->pass = md5($request->pass);
        $user->MobNo = $request->MobNo;
        $user->roleId = $request->roleId;
        $user->save();

        $pages = $request->pageName;
        foreach ($pages as $pageId) {
            $userPage = new UserPages();
            $userPage->pageId = $pageId;
            $userPage->userId = $user->uId;
            $userPage->save();
        }
        return view("admin.newUserForm", ["message" => "User Add Successfully with ID: " . $user->uId]);
    }

    public function editUserForm(Request $request, $uId)
    {
        $user = User::find($uId);

        return view("admin.editUserForm", ["user" => $user]);
    }

    public function updateUser(Request $request, $uId)
    {
        $delUser = UserPages::where("userId", $uId);
        $delUser->delete();
        $pages = $request->pageName;
        foreach ($pages as $pageId) {
            $userPage = new UserPages();
            $userPage->pageId = $pageId;
            $userPage->userId = $uId;
            $userPage->save();
        }
        $user = User::find($uId);
        $user->fname = $request->fname;
        $user->username = $request->username;
        $user->email = $request->email;
        if (!empty($request->pass)) {
            $user->pass = md5($request->pass);
        }
        $user->MobNo = $request->MobNo;
        $user->roleId = $request->roleId;
        $user->save();
        return view("admin.editUserForm", ["user" => $user, "message" => "User Updated Successfully."]);
    }

    public function removeUser($uid)
    {
        $user = User::find($uid);
        $userPages= UserPages::where("userId", $user->uId)->delete();
        $user->delete();
        return [
            'message'=>'Delete User Successfully'
        ];
    }
}
