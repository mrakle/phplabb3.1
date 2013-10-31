<?php

namespace controll;
require_once 'index.php';
require_once 'View.php';
require_once 'Model.php';

class Controller {

	public $alertMessage = null;
	public $usernameSave;
	public $errorMsg = null;
	private $viewClass;

	public function __construct() {
		//$this->session = $_SESSION['user_sess'];
		$this -> secretKey = $secretKey = 'secretKey';
		$this -> alertMessage = $alertMessage = null;
		$this -> errorMsg = $errorMsg = null;
		$this -> viewClass = $viewClass = new \view\View();
		$this -> modelClass = $modelClass = new \model\Model();
		$this -> login = $login = false;
		$this -> logout = $logout = false;
	}
	

	/**
	 * TODO kvar i controller?
	 */
	public function checkLoginSes($userName, $password) {
		
		////echo __FILE__ .' '. __LINE__ .' '. __FUNCTION__.'<br/>';
		$this -> checkIfIpIsFine();
		$cookieUserName = $this->modelClass->getUserName();
		$cookiepassWord = $this->modelClass->getFakePassWord();
		
		if($this->viewClass->getLogoutButton()){
			$this-> logoutController();	
			$this -> viewClass -> getPage();
		}
		elseif (\model\Model::checkIfSessionIsSet()) {
			
			$this -> viewClass -> logedInPage();
		}
		elseif($this->cookieController()){
				
			$this -> viewClass -> logedInPage();
			
		} else{

			$this -> modelClass -> unsetModelSession();//Tar bort -Du är utloggad
			$this -> viewClass -> getPage();
		}
	   }
	
	public function loginController() {
		//echo __FILE__ .' '. __LINE__ .' '. __FUNCTION__.'<br/>';
		$userName = $this->viewClass->getUserId();
		$passWord = $this->viewClass->getPassId();
		$cookiepassWord = $this->modelClass->getFakePassWord();
		
		
		/**
		 * TODO till VYN. KLAR!
		 */
		if ($this -> viewClass -> tryToLogIn()) {
				
			$this->viewClass->setPost();
			
			//Användare och lösenord är rätt, kommer den in här.
			if ($this->modelClass->loginSucces($userName, $passWord) == true) {
				//$this->viewClass->logedInPage();
				
				$this -> logout = true;

				if ($this -> viewClass -> autoLogin) {
					$this -> viewClass -> alertMessage = "DINA UPPGIFTER ÄR SPARADE!!!";
					$this -> viewClass -> myCookie($userName,$cookiepassWord);
					$this -> viewClass -> checkCookie($userName, $cookiepassWord);
				}
				
				if ($this->modelClass->sessIsSet()) {
					
					$this->modelClass->mySession();	
					//Meddelandet försvinner..
					
					if ($this -> login == false) {
						$this -> viewClass ->  errorMsg = "<br>Du är inloggad!<br/>";
						$this -> login = true;//Model
					}
				}
			}else{
				$this->viewClass->errorMessages();
			} 
		}
		$this -> checkLoginSes($userName,$passWord);
	}

	public function cookieController(){
		$this->modelClass->endTime();
		if($this->modelClass->sessIsSet() && $this->viewClass->cookieIsset() && $this->viewClass->cookieUser()){
				
			$cookiepassWord = $this->modelClass->getFakePassWord();
			
			if($this->viewClass->cookiePassword($cookiepassWord)){
				$this->modelClass->mySession();
				return true;
			}
			return false;
		}
		$this->viewClass->checkCookie();			
	}
	
	public function logoutController(){
		//echo __FILE__ .' '. __LINE__ .' '. __FUNCTION__.'<br/>';
		if($this->viewClass->getLogoutButton()){
			
			$this->modelClass->logoutModel();
			$this->viewClass->cookieTimeForSess();
			
		}
	}

	public function checkIfIpIsFine(){
		//$this->viewClass->cookieTimeForSess();
		$this->modelClass->checkIpSess();
	}
}
