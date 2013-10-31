<?php

namespace model;
    
class Model{
		
		public $login = false;
		public $logout = false;
		public $userName = "Admin";//Model
		public $password = "Password";//Model
		public $fakepassword = "aifunsaefisnegin";
		private static $cookieUserSess = "user_sess";
		private static $sessionsTest = "session_test";
		private $user = "";
		private $pass = "";	
		
		
		public static function checkIfSessionIsSet() {
			return (isset($_SESSION[self::$cookieUserSess]) && $_SESSION[self::$cookieUserSess]);
		}
		
		public static function mySession(){
			return $_SESSION['user_sess'] = true;
		}
		
		public function endTime(){
			$cookieEndTime = file_get_contents("endtime.txt");
			//echo "$cookieEndTime";
		}
		
		public function loginSucces($userName,$password) {
			if ($userName == $this->userName && $password == $this->password) {
				return true;
			}
		}
		
		public function sessIsSet(){
			if(!isset($_SESSION[self::$cookieUserSess])){
				return true;
			}
			return false;
		}
		
		public function unsetModelSession(){
			unset($_SESSION['logout_message']);
		}
		
		public function getUserName(){
			
			return $this->userName;
		}
		
		public function getFakePassWord(){
			
			return $this->fakepassword;
		}
		
		public function checkIpSess(){
			
			if(isset($_SESSION[self::$sessionsTest]) == false){
				$_SESSION[self::$sessionsTest] = array();
				$_SESSION[self::$sessionsTest]["webbläsare"] = $_SERVER["HTTP_USER_AGENT"];
				$_SESSION[self::$sessionsTest]["ip"] = $_SERVER["REMOTE_ADDR"];
			}
			if($_SESSION[self::$sessionsTest]["webbläsare"] != $_SERVER["HTTP_USER_AGENT"]){
				//echo"SESSIONSTJUUUUV!!!";
				unset($_SESSION[self::$cookieUserSess]);
			}
			if($_SESSION[self::$sessionsTest]["ip"] != $_SERVER["REMOTE_ADDR"]){
				//echo "SESSIONSTJUV IP!!!";
				unset($_SESSION[$cookieUserSess]);
			}
		}
		
		public function logoutModel(){
			
			//session_start();
			unset($_SESSION[self::$cookieUserSess]);			
			//session_start();
			$_SESSION['logout_message'] = "<p>DU ÄR UTLOGGAD!<p/>";
			
		}
    }
