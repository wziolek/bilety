<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
//session_start();
$db=mysql_connect('localhost','root');//konektor laczy sie z baza danych http://localhost/koncert/wyglad/indexg.php
mysql_select_db("TechnikiInternetu");

$cart_count=0;
// $loggedin="";
echo("<br>");
if (!empty($_POST)){//sprawdzam czy tickets istnieje w sesji
	if(array_key_exists("ticket", $_POST)){
		if(array_key_exists("tickets", $_SESSION) ){
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
	}
}//sprawdza czy zostało przesłane

if (array_key_exists("tickets", $_SESSION)){//jesli tickets istnieje w sesji
	foreach ($_SESSION["tickets"] as $key => $value) {
		//echo($key);
		//echo($value);
		$cart_count =$cart_count+$value;
	}
}

//system logowania

if(array_key_exists("login", $_POST) && array_key_exists("password", $_POST)){
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
     		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Sign up</h4>
      		</div>
      		<div class="modal-body">
				<label class="h">Email</label>
		    	<input type="text" placeholder="Enter Username" name="login" required></input>
		    	<label class="h">Password</label>
		    	<input type="password" placeholder="Enter Password" name="password" required></input>
		     	<p><a class="forgotten" href="#">Forgotten your password?</a></p>
		     	<div class="signin">
		      		<button type="submit" type="button" class="btn btn-default submit">SIGN IN</button>
		      	</div>
			</div>
    	</div>
  	</div>
</div>
<!-- Modal -->

		<header>
			<nav class="navbar navbar-inverse navbar-fixed-top">
		      	<div class="container">
			        <div class="navbar-header">
			          	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
			          </button>
			          <a class="navbar-brand" href="indexg.php">BuyTicket</a>
			        </div>
		        	<div id="navbar" class="collapse navbar-collapse">
			          	<ul class="nav navbar-nav">
			            	<li class="active"><a href="indexg.php">Home</a></li>
			            	<li><a href="#about">Tickets</a></li>
			            	<li><a href="#contact">Contact</a></li>
			          	</ul>
			         	<ul class="nav navbar-nav navbar-right">
			         		<?php
			         		if(!empty($_SESSION)){
			         			if(array_key_exists("login", $_SESSION)){
			         				echo('<li><a href="userpage.php">Hello '.$_SESSION["login"].'</a></li>');
			         			}
			         		}else{
			         			echo('<li><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> Sign in</a></li>');
			         		}
			         		?>		
			        		<li><a href="basket.php"><span class="glyphicon glyphicon-shopping-cart"></span> My bag(<?php echo($cart_count);?>)</a></li>
			      		</ul>
		        	</div><!--/.nav-collapse -->
		      	</div>
		    </nav>
		</header>	
		<div class="container page">
      		<div class="starter-template">
        		<h1>Login / Register <p class="glyphicon glyphicon-lock "></p></h1>
       		<hr>
      		</div>
				<div class="row">
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="c">
			  				<div class="panel-group">
			    				<div class="panel panel-default">
			     					<div class="panel-heading">
			        					<h4 class="panel-title">
			          						<a data-toggle="collapse" href="#collapse1">
			          							<h1 >Returning Customer</h1>
												<h6>Login using your email address and password.</h6>
											</a>
			        					</h4>
			      					</div>
			      					<div id="collapse1" class="panel-collapse collapse">
			        					<div class="panel-body">
			        						<form class=" container form" action="rejestracja.php" method="post"> 
												<fieldset class="c">
													<div class="box">
														<p>										
															<label for="imie" accesskey="i">Imię</label>
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
															<label for="password" accesskey="h">Hasło </label>
															<input type="password" name="password" />
														</p>
													</div>
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
														
															<label for="email_2" accesskey="e">Powtórz e-mail </label>
															<input type="text" name="email_2" />
													
															<label for="adres" accesskey="a">Ulica, numer domu/mieszkania:</label>
															<input type="text" name="adres" />
												
															<label for="kod_pocztowy" accesskey="m">Kod pocztowy </label>
															<input type="text" name="kod_pocztowy" />
															
												
															<label for="miejscowosc" accesskey="k">miejscowość </label>
															<input type="text" name="miejscowosc" />
													
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
													</p>
												</fieldset>
												<p>
													<input type="submit" class="btn btn-default submit" value="Przeslij dane"/>			
												</p>
											</form>
			        					</div>
			      					</div>
			    				</div>
			  				</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="c">
			  				<div class="panel-group">
			    				<div class="panel panel-default">
			      					<div class="panel-heading">
			        					<h4 class="panel-title">
			          						<a data-toggle="collapse" href="#collapse2">
			          							<h1>Register for an account</h1>
												<h6>Enables you to track orders and save time</h6>
											</a>
			        					</h4>
			      					</div>
			      					<div id="collapse2" class="panel-collapse collapse">
			        					<div class="panel-body">
			        						<form action="rejestracja.php" method="post">
						    					<div class="login">
													<label class="h">Email</label>
											    	<input type="text" placeholder="Enter Username" name="login" required></input>
											    	<label class="h">Password</label>
											    	<input type="password" placeholder="Enter Password" name="password" required></input>
											     	<p><a class="forgotten" href="#">Forgotten your password?</a></p>
											      	<button type="submit" type="button" class="btn btn-default submit">SIGN IN</button></p>
						    					</div>
					  						</form>	
			        					</div>
			      					</div>
			    				</div>
			  				</div>
						</div>
					</div>			
				</div>        
    		</div>
    	</div>
		<footer>
			<div class="container contact">
  				<div class="row">
  					<div class="col-md-6 map">
	  					<div id="map"></div>
					    	<script>
					    		function initMap() {
	       						var styledMapType = new google.maps.StyledMapType(
								[
								  {
								    "elementType": "geometry",
								    "stylers": [
								      {
								        "color": "#f5f5f5"
								      }
								    ]
								  },
								  {
								    "elementType": "labels.icon",
								    "stylers": [
								      {
								        "visibility": "off"
								      }
								    ]
								  },
								  {
								    "elementType": "labels.text.fill",
								    "stylers": [
								      {
								        "color": "#616161"
								      }
								    ]
								  },
								  {
								    "elementType": "labels.text.stroke",
								    "stylers": [
								      {
								        "color": "#f5f5f5"
								      }
								    ]
								  },
								  {
								    "featureType": "administrative.land_parcel",
								    "elementType": "labels.text.fill",
								    "stylers": [
								      {
								        "color": "#bdbdbd"
								      }
								    ]
								  },
								  {
								    "featureType": "poi",
								    "elementType": "geometry",
								    "stylers": [
								      {
								        "color": "#eeeeee"
								      }
								    ]
								  },
								  {
								    "featureType": "poi",
								    "elementType": "labels.text.fill",
								    "stylers": [
								      {
								        "color": "#757575"
								      }
								    ]
								  },
								  {
								    "featureType": "poi.park",
								    "elementType": "geometry",
								    "stylers": [
								      {
								        "color": "#e5e5e5"
								      }
								    ]
								  },
								  {
								    "featureType": "poi.park",
								    "elementType": "labels.text.fill",
								    "stylers": [
								      {
								        "color": "#9e9e9e"
								      }
								    ]
								  },
								  {
								    "featureType": "road",
								    "elementType": "geometry",
								    "stylers": [
								      {
								        "color": "#ffffff"
								      }
								    ]
								  },
								  {
								    "featureType": "road.arterial",
								    "elementType": "labels.text.fill",
								    "stylers": [
								      {
								        "color": "#757575"
								      }
								    ]
								  },
								  {
								    "featureType": "road.highway",
								    "elementType": "geometry",
								    "stylers": [
								      {
								        "color": "#dadada"
								      }
								    ]
								  },
								  {
								    "featureType": "road.highway",
								    "elementType": "labels.text.fill",
								    "stylers": [
								      {
								        "color": "#616161"
								      }
								    ]
								  },
								  {
								    "featureType": "road.local",
								    "elementType": "labels.text.fill",
								    "stylers": [
								      {
								        "color": "#9e9e9e"
								      }
								    ]
								  },
								  {
								    "featureType": "transit.line",
								    "elementType": "geometry",
								    "stylers": [
								      {
								        "color": "#e5e5e5"
								      }
								    ]
								  },
								  {
								    "featureType": "transit.station",
								    "elementType": "geometry",
								    "stylers": [
								      {
								        "color": "#eeeeee"
								      }
								    ]
								  },
								  {
								    "featureType": "water",
								    "elementType": "geometry",
								    "stylers": [
								      {
								        "color": "#c9c9c9"
								      }
								    ]
								  },
								  {
								    "featureType": "water",
								    "elementType": "labels.text.fill",
								    "stylers": [
								      {
								        "color": "#9e9e9e"
								      }
								    ]
								  }
								],
									{name: 'Styled Map'});
								var krakow = {lat: 50.0466814, lng: 19.8647886};
						        var map = new google.maps.Map(document.getElementById('map'), {
						          center: krakow,
						          zoom: 11,
						          mapTypeControlOptions: {
						            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
						                    'styled_map']
						          }
						        });
						       	var marker = new google.maps.Marker({
	        						position: krakow,
	         						map: map
	        					});
						        map.mapTypes.set('styled_map', styledMapType);
						        map.setMapTypeId('styled_map');
						      }
			   				</script>
						    <script async defer
						    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMDdr8kG0EB6kg1UpTu1iSmuQ1YKH8eQ0&callback=initMap">
						    </script>
					</div>
					<div class="col-md-6 adress">
						<div class="row ">
							<h2>Buy Ticket</h2>
							<p class="lead">Give us a call or send us an email and we will get back to you as soon as possible!</p>
							<div class="col-md-6 icons">
				      			<a href="buyticket@buyticket.com" target="_top"><span class="glyphicon glyphicon-envelope"></span> <h5>buyticket@buyticket.com</h5></a> 
							</div>
							<div class="col-md-6 icons">
								<p><span class="glyphicon glyphicon-phone"></span></p> 
				      			<h5>tel:</b> 00 48 666 777</h5>
				      		</div>
		      			</div>	
		   			</div>
		  		</div>
				<hr>
				<h6>@WeronikaKrasoń</h6>
			</div>
		</footer>   	<!-- /.container -->
	</body>
</html>



