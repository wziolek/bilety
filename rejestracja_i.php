<?php
$db=mysql_connect('localhost','root');//konektor laczy sie z baza danych
mysql_select_db("TechnikiInternetu");// wybór bd na serwerze

// //system logowania
// $login = $_POST["login"];
// $password = $_POST["password"];
// $login = stripcslashes($login);
// $password = stripcslashes($password);
// $login = mysql_real_escape_string($login);
// $password = mysql_real_escape_string($password);
// $password = password_hash($password, PASSWORD_DEFAULT);

// $query = mysql_query("SELECT login,password FROM Customers WHERE login='".mysql_escape_string($login)."' AND password='".mysql_escape_string($password)."' LIMIT 1") or die ("umarłem");
// $result = mysql_fetch_array($query);
// if($result && $result['login'] == $login && $result['password'] == $password){
// 	echo " poprawne zalogowanie".$result['login'];
// } else {
// 	echo " Błędne logowanie!";
// }


//first_name
strlen($_POST["first_name"]);
if(empty($_POST["first_name"])) {
	$status = false;
	$_SESSION['e_first_name']="Imię jest wymagane!";
	echo "Imię jest wymagane!";
}
if(strlen($_POST["first_name"])>= 20 || strlen($_POST["first_name"])<= 2){
	$status = false;
	$_SESSION['e_first_name']="Imię musi posiadać od 2 do 20 znaków!";
	echo "Imię musi posiadać od 2 do 20 znaków!";
}
$sprawdz = '/^[A-ZŁŚ]{1}+[a-ząęółśżźćń]+$/';
if(!preg_match($sprawdz, $_POST["first_name"]) and !empty($_POST["first_name"])){
	$status=false;
   	$_SESSION['e_first_name']="Niedozwolone znaki";
   	echo "błędne first_name";
}

//last_name
strlen($_POST["last_name"]);
if(empty($_POST["last_name"])) {
	$status=false;
	$_SESSION['e_last_name']="last_name jest wymagane!";
	echo "last_name jest wymagane!";
}
if(strlen($_POST["last_name"])>= 20 ||strlen($_POST["last_name"])<= 2){
	$status=false;
	$_SESSION['e_last_name']="last_name musi posiadać od 2 do 20 znaków!";
	echo "last_name musi posiadać od 2 do 20 znaków!";
}
if(!preg_match($sprawdz, $_POST["last_name"]) and !empty($_POST["last_name"])){ //ereg
	$status=false;
   	$_SESSION['e_last_name']="Niedozwolone znaki";
    echo "błędne last_name";  	
}
//login
strlen($_POST["login"]);
if(empty($_POST["login"])) {
	$status=false;
	$_SESSION['e_login']="Login jest wymagany!";
}
if(strlen($_POST["login"])> 20 || strlen($_POST["login"])<3){
    echo "Błędny login.";
}
$login=$_POST['login']; 
$query = mysql_query("SELECT * FROM Customers WHERE login ='$login'");
$result= mysql_num_rows($query);
if($result > 0) { 
	$status = false;
	$_SESSION['e_login']="Podany login istnieje juz w bazie";
   	echo"Podany login istnieje juz w bazie";
}

//e_mail
if(empty($_POST["e_mail"])) {
	$status=false;
   	$_SESSION['e_e_mail']="e_mail jest wymagany";
   	echo "e_mail jest wymagany";
} else {
	if(!filter_var($_POST["e_mail"], FILTER_VALIDATE_EMAIL)) {
    	$status=false;
   		$_SESSION['e_e_mail']="Zly format e_mail";
   		echo "Zly format e_mail";
   	}
}
$e_mail=$_POST['e_mail']; 
$query = mysql_query ("SELECT * FROM Customers WHERE e_mail='$e_mail'"); 
$row = mysql_num_rows($query); 
if($row > 0) {
	$status = false;
   	$_SESSION['e_mail'] = "Podany adres e-mail istnieje juz w bazie";
   	echo "Podany adres e-mail istnieje juz w bazie";
} 
 
if($_POST["e_mail"]!=$_POST["e_mail_2"]){
	$status=false;
	$_SESSION['e_e_mail_2']="Podane e_mail nie są identyczne";
	echo "Podane e_mailnie są identyczne";
}

// //password
// if(empty($_POST["password"])) {
// 	$status=false;
//    	$_SESSION['password']="password jest wymagane";
//    	echo "password jest wymagane";
// } else {
// 	if(!preg_match("^(?=.*\d)(?=.*[a-z])(?=.*[\!\@\#\$\%\^\&\*\(\)\_\+\-\=])(?=.*[A-Z])(?!.*\s).{6,}$",$_POST["password"]){
//     	$status=false;
//    		$_SESSION['e_password']="Niedozwolone znaki w hasle";
//    		echo "Niedozwolone znaki w hasle";
//    	}
// }

// //haszowanie
// $login = addslashes($_POST['login']);
// $password = password_hash(addslashes($_POST['e_password']), 8);
// $sel = $db->query("SELECT count(1) AS ile FROM users WHERE LOGIN='$login' AND password='$password'");


// if($_POST["password"]!=$_POST["password_2"]){
// 	$status=false;
// 	$_SESSION['e_password_2']="Podane hasła nie są identyczne";
// 	echo "Podane hasła nie są identyczne";
// }



//adres
strlen($_POST["adress"]);
if(empty($_POST["adress"])) {
	$status = false;
	$_SESSION['e_adress']="adress jest wymagany!";
	echo "adress jest wymagany!";
}
if(strlen($_POST["adress"])>= 100 || strlen($_POST["adress"])<= 5){
	$status = false;
	$_SESSION['e_adress']="adress musi posiadać od 5 do 100 znaków!";
	echo "adress musi posiadać od 5 do 100 znaków!";
}

//adres
strlen($_POST["id_country"]);
if(empty($_POST["id_country"])) {
	$status = false;
	$_SESSION['e_id_country']="Kraj jest wymagany!";
	echo "Kraj jest wymagany!";
}
if(strlen($_POST["id_country"])>= 100 || strlen($_POST["id_country"])<= 5){
	$status = false;
	$_SESSION['e_id_country']="adress musi posiadać od 5 do 100 znaków!";
	echo "adress musi posiadać od 5 do 100 znaków!";
}
//kod pocztowy
//if(!preg_match("/^([0-9]{2})(-[0-9]{3})?$/i",$_POST["postal_ode"])) 
if(!preg_match("/^[\-0-9]$/i",$_POST["postal_ode"])) 
    echo "Błędny kod pocztowy";

//sprawdz_czy_login_istenie($_POST['login']);
$hash_hasla = password_hash($_POST['password'], PASSWORD_DEFAULT);
$query="insert into Customer (first_name,last_name,login,password,e_mail ,adress,postal_ode,city, id_country) values
	('".$_POST["first_name"]."',
	'".$_POST["last_name"]."',
	'".$_POST["login"]."',
	'".$hash_hasla."',
	'".$_POST["e_mail"]."', 
	'".$_POST["adress"]."',
	'".$_POST["postal_ode"]."',
	'".$_POST["city"]."',
	'".$_POST["id_country"]."')";//zapytanie do bazy danych kolumny z bazy danych , małe litery to co w html - nazwy(z tego powstaje jeden string)
echo($query);//wydrukowanie stringa
mysql_query($query);//funkcja ktora wykonuje zapytanie przesłane w parametrze 
//jakby było krótkie to wtedy moge zrobic tak mysql_query("select * from KRAJ")
$last_id=mysql_insert_id();//ostatnie zapisane id do bazy danych 

foreach ($_POST["media"] as $value) {
	$zapytanie="insert into customer_media (id_customer,id_media) values (" .$last_id. ",'" .$value."')";
	mysql_query($zapytanie);
}//$_POST zmienna przesyłana do pliku przez serwer w tym wypadku jest to 1,2,3,(tlyko wartosci zaznaczone przez użytkownika) $_POST["media"] jest tablicą potem w daleszej częsci karzdy jeje element jest nazywany  $value
echo mysql_error();

?>
<html>
	<head>
	<title> Szablon HTML </title>
	<meta http-equiv="Content-type" content="text/html; charset=iso-8859-2">
	<meta name="Description" content="Mechanizm rejestracji użytkownika w aplikacji internetowej">
	<meta name="Keywords" content="dane">
	<meta name="Author" content=" Weronika Krasoń">
	<style type=text/css>
		div.pole {font-family: Arial, Helvetica, Sans; font-size: 10pt; line-height: 1.8em;} 
		.nazwa {font-weight: bold; color: #080;}
	</style>
	</head>
	<body>
		<!--dane formularza-->
		<div class="pole">
			<span class="nazwa">first_name:</span>
			<span class="wartosc"><?PHP echo $_POST["first_name"]; ?></span>
		</div>
		<div class="pole">
			<span class="nazwa">Last name:</span>
			<span class="wartosc"><?PHP echo $_POST["last_name"]; ?></span>
		</div>
		<div class="pole">
			<span class="nazwa">Login:</span>
			<span class="wartosc"><?PHP echo $_POST["login"]; ?></span>
		</div>		
		<div class="pole">
			<span class="nazwa">Password:</span>
			<span class="wartosc"><?PHP echo $_POST["password"]; ?></span>
		</div>
		<div class="pole">
			<span class="nazwa">e-mail:</span>
			<span class="wartosc"><?PHP echo $_POST["e_mail"]; ?></span>
		</div>	
		<div class="pole">
			<span class="nazwa">Adress:</span>
			<span class="wartosc"><?PHP echo $_POST["adress"]; ?></span>
		</div>
		<div class="pole">
			<span class="nazwa">City:</span>
			<span class="wartosc"><?PHP echo $_POST["city"]; ?></span>
		</div>
		<div class="pole">
			<span class="nazwa">Postal code:</span>
			<span class="wartosc"><?PHP echo $_POST["postal_ode"]; ?></span>
		</div>	
		<div class="pole">
			<span class="nazwa">Country:</span>
			<span class="wartosc"><?PHP echo $_POST["id_country"]; ?>
			</span>

		</div>
		<div class="pole">
			<span class="nazwa">Media:</span>
			<span class="wartosc"> <?PHP foreach ($_POST["media"] as $wartosc){
				echo $wartosc . " ";
			}?>
			</span>
		</div>
	</body>
</html>