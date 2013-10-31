<?php

namespace view;

class View {

	private static $lgotMsg = 'logout_message';

	//public memberUserName =
	public $errorMsg;
	public $logoutMessage;
	public $alertMessage;
	public static $cookieUser = 'cookieUser';
	public static $cookiePass = 'cookiePass';
	public $secretKey = 'secretKey';
	public static $userID = 'userNameId';
	public static $passID = 'passwordID';
	public static $logoutButton = "logOutButton";
		
	function __construct() {


	}

	
	public function setPost(){
		$this -> user = $_POST['userNameId'];
		$this -> pass = $_POST['passwordID'];
		$this -> autoLogin = isset($_POST['autoLogin']);
	}
	
		
	/**
	 * TODO vyn
	 */
	public static function getUserId() {
		if (isset($_POST[self::$userID])) {
			return $_POST[self::$userID];
		}
	}

	public static function getPassId() {
		if (isset($_POST[self::$passID])) {
			return $_POST[self::$passID];
		}
	}
	
	public static function getLogoutButton(){
		
		if(isset($_POST[self::$logoutButton])){
			
			return true;
		}
		
		return false;
	}
	
	public function errorMessages(){
		if ($this -> user == null) {
					$this -> errorMsg = "<br>FYLL I ANVÄNDARNAMN<br/>";
				} elseif ($this -> pass == null) {
					$this -> errorMsg = "<br>FYLL I LÖSENORD<br/>";
				} else {
					$this -> errorMsg = "DINA UPPGIFTER ÄR FELAKTIGA!";
				}
	}
	
	/**
	 * TODO ta bort strängberoende
	 */
	public function tryToLogIn(){
		if(isset($_POST['loginButton'])){
			return true;
		}
		return false;
	}
	
	public function myCookie($userName, $password) {
		//echo __FILE__ .' '. __LINE__ .' '. __FUNCTION__.'. Innehåller echo.<br/>';
		$endtime = time() + 600;
		file_put_contents("endtime.txt", "$endtime");
		setcookie(self::$cookieUser, $userName, $endtime);
		$cryptPass = md5($password, $this -> secretKey);
		setcookie(self::$cookiePass, $cryptPass, $endtime);
		
	}
	
	public function cookieTimeForSess(){
		//echo __FILE__ .' '. __LINE__ .' '. __FUNCTION__.'<br/>';
		setcookie("cookieUser","",time()-70200);
		setcookie("cookiePass","",time()-70200);
	}
	
	public function cookieIsset(){
		if(isset($_COOKIE[self::$cookiePass]) && $_COOKIE[self::$cookiePass]){
			return true;
		}
		return false;
	}
	
	public function cookieUser(){
		if(isset($_COOKIE[self::$cookieUser])){
			return true;
		}
		return false;
	}
	
	public function cookiePassword($password){
		if($_COOKIE[self::$cookiePass] == md5($password, $this -> secretKey)){
			return true;
		}
		return false;
	}
	/**
	 * TODO Bryta ut denna function.
	 */
	public function checkCookie() {
		

			if (!isset($_SESSION["user_sess"]) && isset($_COOKIE[self::$cookieUser]) 
											&& $_COOKIE[self::$cookieUser] 
											!== $userName 
											&& isset($_COOKIE[self::$cookiePass]) 
											&& $_COOKIE[self::$cookiePass]
											!== md5($password, $this -> secretKey) 
											&& time() > $cookieEndTime) {
				echo "Cookie är felaktig!!";
				setcookie(self::$cookieUser, "", time() - 70200);
				setcookie(self::$cookiePass, "", time() - 70200);
				unset($_SESSION["user_sess"]);

			}

		
		
		
	}

	public function logedInPage($alertMessage = null, $errorMsg = null) {
		//echo __FILE__ .' '. __LINE__ .' '. __FUNCTION__.'. Innehåller echo.<br/>';
		
		echo "
		<!DOCTYPE html>
		<html>
		<head> 
		
             <title>Laboration. Inloggad</title> 
             <meta http-equiv='content-type' content='text/html; charset=utf-8' /> 
             
          </head> 
          <body>
          $this->alertMessage
		  $this->errorMsg
            <h1>Laborationskod am222pr</h1>
				<h2>Admin är inloggad</h2>
				 	 <form action='?logout' method='post' enctype='multipart/form-data'>
				 	 <input type='submit' name='".self::$logoutButton."'  value='Logga ut' />
				 <p><p>" . strftime('%A, den %d %B år %Y. Klockan är: [%H:%M:%S] ') . "<p>
          </body>
          </html>
          	";
	}

	public function getPage($logoutMessage = null, $errorMsg = null, $usernameSave = null) {
		//echo __FILE__ .' '. __LINE__ .' '. __FUNCTION__.'. Innehåller echo.<br/>';
		//http://stackoverflow.com/questions/2621007/keep-username-in-username-field-when-incorrect-password
		if (isset($_SESSION[self::$lgotMsg])) {
			 $logoutMessage = $_SESSION[self::$lgotMsg];
		}
		
		echo "
		<!DOCTYPE html>
		<html>
		<head> 
			
             <title>Laboration. Inte inloggad</title> 
             <meta http-equiv='content-type' content='text/html; charset=utf-8' /> 
             
          </head> 
          <body> 
          
            <h1>Laborationskod am222pr</h1><h2>Ej Inloggad</h2>
				  	
			<form action='?login' method='post' enctype='multipart/form-data'>
				<fieldset>
					$logoutMessage
					$this->errorMsg
					<legend>Login - Skriv in användarnamn och lösenord</legend>
					<label for='userNameId' >Användarnamn :</label>
					<input type='text' size='20' name='" .self::$userID . "' id='userNameId' value='" . self::getUserID() . "' />
					<label for='passwordID' >Lösenord  :</label>
					<input type='password' size='20' name='passwordID' id='passwordID' value='' />
					<label for='autoLogin' >Håll mig inloggad  :</label>
					<input type='checkbox' name='autoLogin' id='autoLogin' />
					<input type='submit' name='loginButton'  value='Logga in' />
				</fieldset>
			</form>
				 <p><p>" . strftime('%A, den %d %B år %Y. Klockan är: [%H:%M:%S] ') . "<p>
          </body>
        	<html>
        	";

	}

}
