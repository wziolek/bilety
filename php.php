<?php
		if(session_id() == '' || !isset($_SESSION)) {
		    // session isn't started
		    session_start();
		}
		//session_start();
		$db=mysql_connect('localhost','root');//konektor laczy sie z baza danych http://localhost/koncert/wyglad/indexg.php
		mysql_select_db("TechnikiInternetu");
		$cart_count=0;
		if (array_key_exists("tickets", $_SESSION)){//jesli tickets istnieje w sesji
			foreach ($_SESSION["tickets"] as $key => $value) {
				$cart_count =$cart_count+$value;
			}
		}
		//system logowania
		if(array_key_exists("login", $_POST) && array_key_exists("password", $_POST)){
			unset($_SESSION['login']);
			unset($_SESSION['is_admin']);
			$login = $_POST["login"];
			$password = $_POST["password"];
			$login = stripcslashes($login);//pozbywa sie slashy
			$password = stripcslashes($password);
			$login = mysql_real_escape_string($login);//zamienia znaki na tekst ( string)
			$password = mysql_real_escape_string($password);
			//$password = password_hash($password,PASSWORD_DEFAULT);
			$query = mysql_query("SELECT login, password, is_admin FROM Customer WHERE login='".$login."'") or die ('die');
			$result = mysql_fetch_assoc($query);//pobranie
			if($result){//&& $result['login'] == $login && $result['password'] == $password){//jezeli istnieje result , i 
				if (password_verify($password, $result['password'])) {
					$_SESSION["login"]= $result['login'];
				    if($result['is_admin']==1){
						// $loggedin = "Hello admin".$result['login'];
						$_SESSION["is_admin"]=1;
					// }else{
					// 	$loggedin = "Hello ".$result['login'];
					}
				} else {
				    echo 'Invalid password.';
				}
			}else{
				echo " Błędne logowanie!";
			}
		}//system logowania
?>








