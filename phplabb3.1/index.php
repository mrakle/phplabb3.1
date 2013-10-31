<?php
	
	require_once'Controller.php';
	require_once 'View.php';
	
	
	setlocale(LC_ALL, "sv_SE", "sv_SE.utf-8", "sv", "swedish");
	session_start();
	
	/*if(isset($_SESSION["session_test"]) == false){
		$_SESSION["session_test"] = array();
		$_SESSION["session_test"]["webbläsare"] = $_SERVER["HTTP_USER_AGENT"];
		$_SESSION["session_test"]["ip"] = $_SERVER["REMOTE_ADDR"];
	}
	if($_SESSION["session_test"]["webbläsare"] != $_SERVER["HTTP_USER_AGENT"]){
		echo"SESSIONSTJUUUUV!!!";
		setcookie("cookieUser","",time()-7200);
		setcookie("cookiePass","",time()-7200);
		unset($_SESSION["user_sess"]);
	}*/
	
	/**
	 * TODO testa med separata ip.
	 */
	/*if($_SESSION["session_test"]["ip"] != $_SERVER["REMOTE_ADDR"]){
		echo "SESSIONSTJUV IP!!!";
		setcookie("cookieUser","",time()-7200);
		setcookie("cookiePass","",time()-7200);
		unset($_SESSION["user_sess"]);
	}*/
	
	
		
	$pageView = new \view\View();
	$controllName = new \controll\Controller();
	$controllName->loginController();
	
	
	/**
	 * Skapa coockie
	 */
	
	//40 tecken till kryptering - Daniel
	
	
	
	
	 //http://www.webforum.nu/archive/index.php/t-182908.html
	
	
		
		
	
		
	/* function checkLoginSes(){
		
		if(isset($_SESSION['user_sess']) && $_SESSION['user_sess']){
			$pageView->logedInPage();
		}else{
			$pageView->getPage();
			unset($_SESSION['logout_message']);
		}
	}*/
		

	
	
	
	
	
		
	
	
         