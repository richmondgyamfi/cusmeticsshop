<?php
//core app class
# ************************************************************
# Developer Richmond Gyamfi Nketia 
# Year 2019
# Version 1.0
#
# https://www.comedigitalize.com
# https://github.com/richmondgyamfi
#
#
# ************************************************************
 class Core{
 	protected $currentController = 'Pages';
 	protected $currentMethod = 'index';
 	protected $params = [];

 	public function __construct(){
 		// print_r($this->getUrl());
 		$url = $this->getUrl();
		//  var_dump($url);
		//  echo 'pa';
		//  echo $url[0];
		// $cam = explode('.',$url[2]);
		
		// die();
		//look in 'controllers' for first value, ucwords will capitalize first letter
 		if (file_exists(APPROOT.'/controllers/' . ucwords($url[0]) . '.php')) {
 			# code...
 			$this->currentController = ucwords($url[0]);
 			unset($url[0]);
		 }

		 if(isset($url[1])){
			$cam = explode('.',$url[1]);
			// var_dump($cam[0]);
			if(file_exists(APPROOT.'/controllers/' . ucwords($url[1]). '.php')){
			  // If exists, set as controller
			  $this->currentController = ucwords($url[1]);
			  // Unset 0 Index
			  unset($url[1]);
			}
		  }
		 
		 if(isset($url[3])){
			$cam = explode('.',$url[3]);
			// var_dump($cam[0]);
			if(file_exists(APPROOT.'/controllers/' . ucwords($url[2]). '.php')){
			  // If exists, set as controller
			  $this->currentController = ucwords($url[2]);
			  // Unset 0 Index
			  unset($url[2]);
			}
		  }
	
		  if(isset($url[2])){
			$cam = explode('.',$url[2]);
			// var_dump($cam[0]);
			if(file_exists(APPROOT.'/controllers/' . ucwords($url[2]). '.php')){
			  // If exists, set as controller
			  $this->currentController = ucwords($url[2]);
			  // Unset 0 Index
			  unset($url[2]);
			}
		  }
		//   echo $this->currentController;
		//   die();

 		//require the controller
 		require_once APPROOT.'/controllers/' . $this->currentController . '.php';
		//  var_dump($url);
		 $this->currentController = new $this->currentController;
		 if(empty($url[0])){
			if (method_exists($this->currentController, $url[0])) {
			   $this->currentMethod = $currentMethod;
			   unset($currentMethod);
			}
	   }
// die();
		 if(isset($url[0])){
			// Check to see if method exists in controller
			if(method_exists($this->currentController, $url[0])){
			  $this->currentMethod = $url[0];
			  // Unset 1 index
			  unset($url[0]);
			}
		  }

		  if(isset($cam[0])){
			// Check to see if method exists in controller
			if(method_exists($this->currentController, $cam[0])){
			  $this->currentMethod = $cam[0];
			  // Unset 1 index
			  unset($cam[0]);
			}
		  }

 		//check for second part of the URL
 		if (isset($url[1])) {
 			if (method_exists($this->currentController, $url[1])) {
 				$this->currentMethod = $url[1];
 				unset($url[1]);
 			}
		 }
		 
		 if (isset($url[2])) {
			if (method_exists($this->currentController, $url[2])) {
			  $this->currentMethod = $url[2];
			  unset($url[2]);
			}
		  }

 		//Get parameters
 		$this->params = $url ? array_values($url) : [];
		//  echo '<br>';

 		// print_r($this->params);
		//  echo '<br>';
		//  echo $this->currentMethod;
		//  echo '<br>';
		//  echo $this->currentController;
 		// die();

 		//call a callback with array of params
 		call_user_func_array([$this->currentController, $this->currentMethod], $this->params); 
 	}

 	public function getUrl(){
    //   echo $_SERVER['REQUEST_URI'];
		//  echo $_GET['url'];
		//  die();
 		// if (isset($_GET['url'])) {
 		// 	# code...
 		// 	$url = rtrim($_GET['url'],'/');
 		// 	//Allow us to remove and filter variables such as string or numbers
 		// 	$url = filter_var($url, FILTER_SANITIZE_URL);

 		// 	//breaking url into an array
 		// 	$url = explode('/', $url);
 		// 	return $url;
		 // }
		 
		 if (isset($_SERVER['REQUEST_URI'])) {
			# code...
			$url = rtrim($_SERVER['REQUEST_URI'],'/');
			//Allow us to remove and filter variables such as string or numbers
			$url = filter_var($url, FILTER_SANITIZE_URL);

			//breaking url into an array
			$url = explode('/', $url);
			return $url;
		}
 	}
 }

?>