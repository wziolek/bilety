<?php
	include "php.php";
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
				         			if(array_key_exists("is_admin", $_SESSION)){
				         					echo('<li><a href="userpageadmin.php">Hello '.$_SESSION["login"].'</a></li>');
				         					echo('<li><a href="logout.php">Sign out</a></li>');	
					         			}
					         		elseif (array_key_exists("login", $_SESSION)){
					         				echo('<li><a href="userpage.php">Hello '.$_SESSION["login"].'</a></li>');
					         				echo('<li><a href="logout.php">Sign out</a></li>');
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
      			<?php
				  	$query = mysql_query("SELECT first_name FROM Customer WHERE login='".$_SESSION["login"]."'");
					$row = mysql_fetch_array($query);
					echo('<h1>Hello '.$row[0].' <p class="glyphicon glyphicon-user"</p></h1>');
				?>
				<hr>
			</div>
    		<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="c">
		  				<div class="panel-group">
		    				<div class="panel panel-default">
		     					<div class="panel-heading">
		        					<h4 class="panel-title">
		          						<a data-toggle="collapse" href="#collapse1">
		          							<h1>Orders</h1>
										</a>
		        					</h4>
		      					</div>
		      					<div id="collapse1" class="panel-collapse collapse">
		        					<div class="panel-body" align="center">
			        					<?php
											$query = mysql_query("SELECT id_customer FROM Customer WHERE login='".$_SESSION["login"]."'") or die ('die');
										    $row = mysql_fetch_array($query);
										    $nr_customer=$row[0];
										            
										    $query_order = mysql_query("SELECT id_orders,value,order_date FROM orders WHERE id_customer='".$nr_customer."'") or die ('die');
										    echo("<table id='display'>");
										    			echo("<tr>
													    	<td>id_orders</td>
													    	<td>value</td>
													    	<td>order_date</td>
													    </tr>");
										    while ($row = mysql_fetch_array($query_order)) {
										        echo("<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td></tr>");  
										    }
										    echo("</table>");
						        		?>
		        					</div>
		      					</div>
		    				</div>
		  				</div>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="c">
		  				<div class="panel-group">
		    				<div class="panel panel-default">
		     					<div class="panel-heading">
		        					<h4 class="panel-title">
		          						<a data-toggle="collapse" href="#collapse2">
		          							<h1>Adress</h1>
										</a>
		        					</h4>
		      					</div>
		      					<div id="collapse2" class="panel-collapse collapse">
		        					<div class="panel-body">
										<div clas="user_order">
							       			<h4>Shipping address</h4>
								       		<?php
											 	$queryDane = mysql_query("SELECT * FROM Customer WHERE login='".$_SESSION["login"]."'");
													$row = mysql_fetch_array($queryDane);
													echo($row[1]);
													echo("<br>");
													echo($row[2]);
													echo("<br>");
													echo($row[5]);
													echo("<br>");
													echo($row[6]);
													echo("<br>");
													echo($row[8]);
													echo(" ");
													echo($row[7]);
											 ?>
										</div>
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









