<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
//session_start();
$db=mysql_connect('localhost','root');//konektor laczy sie z baza danych http://localhost/koncert/wyglad/indexg.php
mysql_select_db("TechnikiInternetu");

$cart_count=0;
echo("<br>");
if (!empty($_POST)){//sprawdzam czy tickets istnieje w sesji
	if(array_key_exists("tickets", $_SESSION)){
		foreach ($_POST["ticket"] as $key => $value){
			if(array_key_exists($key, $_SESSION["tickets"])){
				$_SESSION["tickets"][$key] += $value;
			}else{
				$_SESSION["tickets"][$key] = $value;
			}
		}

	}else{
			$_SESSION["tickets"]=$_POST["ticket"];
	}
}//sprawdza czy zostało przesłane


if (array_key_exists("tickets", $_SESSION)){//jesli tickets istnieje w sesji
	foreach ($_SESSION["tickets"] as $key => $value) {
		//echo($key);
		//echo($value);
		$cart_count =$cart_count+$value;
	}
}

?>

<html>
	<head>
	<title> Szablon HTML </title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="Description" content="Mechanizm rejestracji użytkownika w aplikacji internetowej">
	<meta name="Keywords" content="dane">
	<meta name="Author" content=" Weronika Krasoń">
	<link rel="stylesheet" href="stylesg.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	// 	$(document).on('click', 'a', function(event){
	//     event.preventDefault();
	//     $('body').animate({
	//         scrollTop: $($.attr(this, 'href')).offset().top
	//    	 }, 800);
	// 	});
	 </script>
	<script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	</head>
	<body>
		<div id="id01" class="modal" tabindex="-1" role="dialog">
			<div class="modal-dialog animate" role="document">
				<div class="modal-content">
					<div class="modal-body">
					  	<form action="/action_page.php">
						    <div class="imgcontainer">
						        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
						    </div>
						    <div class="login">
						    	<h2>Sign up</h2>
						    	<hr>
						     	<label class="h">Email</label>
						    	<input type="text" placeholder="Enter Username" name="uname" required></input>

						    	<label class="h">Password</label>
						    	<input type="password" placeholder="Enter Password" name="psw" required></input>
						     	<a class="remember" href="#">CAN'T REMEMBER YOUR PASSWORD?</a>
						      	<button type="submit" type="button" class="btn btn-default">SIGN IN</button>
						      	<input type="checkbox" checked="checked">Remember me</input>
						    </div>
					  	</form>
					</div>
				</div>
			</div>
		</div>
		<header>
			<div class="navbar navbar-fixed-top" role="navigation">
				<div class="container">
				    <div class="navbar-header">
				        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
			          	</button>
				      	<a class=" logo navbar-brand" href="indexg.php">BuyTicket</a>
				    </div>
				    <div class="collapse navbar-collapse">
          				<ul class="nav navbar-nav">
				            <li><a href="header">Home</a></li>
				            <li><a href=".row" href="#row">Tickets</a></li>
				            <li><a href=".contact">Contact</a></li>
			         	</ul>
			         	<ul class="nav navbar-nav navbar-right">
       						<li><a href="#"onclick="document.getElementById('id01').style.display='block'"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>

							</li>				
        					<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> My bag(<?php echo($cart_count);?>)</a></li>
      					</ul>
       				</div>
				</div>
			</div>
		</header>	
		<br>
		<br>
		<br>
		<div class="row">

			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="container">
				  <h2>Collapsible Panel</h2>
				  <p>Click on the collapsible panel to open and close it.</p>
				  <div class="panel-group">
				    <div class="panel panel-default">
				      <div class="panel-heading">
				        <h4 class="panel-title">
				          <a data-toggle="collapse" href="#collapse1">Collapsible panel</a>
				        </h4>
				      </div>
				      <div id="collapse1" class="panel-collapse collapse">
				        <div class="panel-body">
				        	<form class=" container form" action="rejestracja.php" method="post"> 
								<fieldset class="container">
									<legend>Dane osobowe</legend>
									<div class="box">
										<p>
											<label for="imie" accesskey="i"><p>Imię </p></label>
											<input type="text" name="imie" />
										</p>
									</div>
									<div class="box">
										<p>
											<label for="nazwisko" accesskey="n">Nazwisko </label>
											<input type="text" name="nazwisko" />
										</p>
									</div>
									<div class="box">
										<p>
											<label for="login" accesskey="l">Login </label>
											<input type="text" name="login" />
										</p>	
									</div>
									<div class="box">
										<p>
											<label for="haslo" accesskey="h">Hasło </label>
											<input type="password" name="haslo" />
										</p>
									<div class="box">
										<p>
											<label for="haslo2" accesskey="h">Powtórz hasło </label>
											<input type="password" name="haslo2" />
										</p>
									</div>
									<div class="box">
										<p>
											<label for="email" accesskey="e">e-mail </label>
											<input type="text" name="email" />
										</p>
									</div>
									<div class="box">			
										<p>
											<label for="email_2" accesskey="e">Powtórz e-mail </label>
											<input type="text" name="email_2" />
										</p>
									</div>
									<div class="box">		
										<p>
											<label for="adres" accesskey="a">Ulica, numer domu/mieszkania:</label>
											<input type="text" name="adres" />
										</p>
									</div>
									<div class="box">			
										<p>
											<label for="kod_pocztowy" accesskey="m">Kod pocztowy </label>
											<input type="text" name="kod_pocztowy" />
										</p>
									</div>
									<div class="box">			
										<p>
											<label for="miejscowosc" accesskey="k">miejscowość </label>
											<input type="text" name="miejscowosc" />
										</p>
									</div>
									<p>
									<label for="kraj" accesskey="r">Kraj</label>
									<select name="kraj" size="1">
										<option label="Austria" value="1">Austria</option>
										<option label="Belgia" value="2">Belgia</option>
										<option label="Bułgaria" value="3">Bułgaria</option>
										<option label="Chorwacja" value="4">Chorwacja</option>
										<option label="Cypr" value="5">Cypr</option>
										<option label="Czechy" value="6">Czechy</option>
										<option label="Dania" value="7">Dania</option>
										<option label="Estonia" value="8">Estonia</option>
										<option label="Finlandia" value="9">Finlandia</option>
										<option label="Francja" value="10">Francja</option>
										<option label="Grecja" value="11">Grecja</option>
										<option label="Hiszpania" value="12">Hiszpania</option>
										<option label="Holandia" value="13">Holandia</option>
										<option label="Irlandia" value="14">Irlandia</option>
										<option label="Litwa" value="15">Litwa</option>
										<option label="Luksemburg" value="16">Luksemburg</option>
										<option label="Łotwa" value="17">Łotwa</option>
										<option label="Malta" value="18">Malta</option>
										<option label="Niemcy" value="19">Niemcy</option>
										<option label="Polska" value="20">Polska</option>
										<option label="Portugalia" value="21">Portugalia</option>
										<option label="Rumunia" value="22">Rumunia</option>
										<option label="Słowacja" value="23">Słowacja</option>
										<option label="Słowenia" value="24">Słowenia</option>
										<option label="Szwecja" value="25">Szwecja</option>
										<option label="Węgry" value="26">Węgry</option>
										<option label="Włochy" value="27">Włochy</option>
										<option label="Zjednoczone Królestwo" value="28">Zjednoczone Królestwo</option>
									</select>
									</p>
									<p>
										<label for="media" accesskey="m">W jaki sposób dowiedziałaś/eś się o koncercie?  (mozna zaznaczyc kilka opcji)</label><br>
										<input type="checkbox" name="media[]" value="1" /> telewizja
										<input type="checkbox" name="media[]" value="2"/> radio
										<input type="checkbox" name="media[]" value="3"/> internet
										<input type="checkbox" name="media[]" value="4" /> prasa 
										<input type="checkbox" name="media[]" value="5" /> znajomi 
									</fieldset>
										<p>
											<input type="submit" class="btn btn-default" value="Przeslij dane"/>			
										</p>
							</form>
				        </div>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="container">
				  <h2>Collapsible Panel</h2>
				  <p>Click on the collapsible panel to open and close it.</p>
				  <div class="panel-group">
				    <div class="panel panel-default">
				      <div class="panel-heading">
				        <h4 class="panel-title">
				          <a data-toggle="collapse" href="#collapse2">Collapsible panel</a>
				        </h4>
				      </div>
				      <div id="collapse2" class="panel-collapse collapse">
				        <div class="panel-body">
				        	<form action="/action_page.php">
							    <div class="imgcontainer">
							        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
							    </div>
							    <div class="login">
							    	<h2>Sign up</h2>
							    	<hr>
							     	<label class="h">Email</label>
							    	<input type="text" placeholder="Enter Username" name="uname" required></input>

							    	<label class="h">Password</label>
							    	<input type="password" placeholder="Enter Password" name="psw" required></input>
							     	<a class="remember" href="#">CAN'T REMEMBER YOUR PASSWORD?</a>
							      	<button type="submit" type="button" class="btn btn-default">SIGN IN</button>
							      	<input type="checkbox" checked="checked">Remember me</input>
							    </div>
						  	</form>	
				        </div>
				      </div>
				    </div>
				  </div>
				</div>
			</div>			
		</div>
	</body>
</html>



