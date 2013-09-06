<?php
    class UserController extends Controller
    {
    	function __construct()
		{
			// Dummy constructor to prevent calling parent.
		}
		
		/**
		 * Allow users to log in
		 * 
		 * @param array $params
		 */
		 function login($array = array())
		 {

		 	if(count($_POST) < 2 || (!isset($_POST["username"]) || !isset($_POST["password"]) || empty($_POST["username"]) || empty($_POST["password"])))
				die("missing parameters");
			
		 	$username = $_POST["username"];
			$password = $_POST["password"];
			
			$user = User::getUserByUsername($username);
			
			if(crypt($password,Database::getInstance()->getSalt()) == $user->getPassword())
			{
				echo "Should have stored ".$user->getUsername() . " in session variable now";
				$_SESSION["user_id"] = $user->getID();
				
			}
			
			//$this->redirect("index.php?route=post/all/");
		 }
    }
?>
