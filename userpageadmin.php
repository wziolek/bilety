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
		 <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
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
	</div><!-- Modal -->

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
		        					<div class="panel-body">
			        					<?php
								        	$query_order = mysql_query("SELECT * FROM Orders WHERE id_orders>0");
										    echo("<table id='tabela' cellpadding=\"2\" border=1>");
										    	echo("<tr>
												    	<td>id_orders</td>
												    	<td>id_customer</td>
												    	<td>value</td>
												    	<td>order_date</td>
												    	<td>shipped_date</td>
												    	<td>ship_via</td>
												    	<td>paid</td>
												    	<td>payment_method</td>
												    </tr>");
										    while ($row = mysql_fetch_array($query_order)) {
										        echo("<tr><td>{$row[0]}</td>
													    	<td>{$row[1]}</td>
													    	<td>{$row[2]}</td>
													    	<td>{$row[3]}</td>
													    	<td>{$row[4]}</td>
													    	<td>{$row[5]}</td>
													    	<td>{$row[6]}</td>
													    	<td>{$row[7]}</td></tr>");  
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
											<h1>Customers</h1>
										</a>
		        					</h4>
		      					</div>
		      					<div id="collapse2" class="panel-collapse collapse">
		        					<div class="panel-body">
		        						<?php
							        		$query_c = mysql_query("SELECT * FROM Customer WHERE id_customer>0");
										    echo("<table cellpadding=\"2\" border=1>");
										    		echo("<tr>
												    	<td>id_customer</td>
												    	<td>first_name</td>
												    	<td>last_name</td>
												    	<td>login</td>
												    	<td>e_mail</td>
												    	<td>adress</td>
												    	<td>city</td>
												    	<td>postal_code</td>
												    	<td>is_admin</td>
												    	<td>date</td>
												    </tr>");
										    while($row = mysql_fetch_array($query_c)){ 
										    	echo("<tr>
										    	<td>{$row[0]}</td>
										    	<td>{$row[1]}</td>
										    	<td>{$row[2]}</td>
										    	<td>{$row[3]}</td>
										    	<td>{$row[5]}</td>
										    	<td>{$row[6]}</td>
										    	<td>{$row[7]}</td>
										    	<td>{$row[8]}</td>
										    	<td>{$row[9]}</td>
										    	<td>{$row[10]}</td>
										    	</tr>");

										   	} 
										    echo "</table>";  
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
		          						<a data-toggle="collapse" href="#collapse3">
		          							<h1>Tickets</h1>
										</a>
		        					</h4>
		      					</div>
		      					<div id="collapse3" class="panel-collapse collapse">
		        					<div class="panel-body">
		        					<?php
						        		$query = mysql_query("SELECT * FROM tickets WHERE id_tickets>0");
										    echo "<table cellpadding=\"2\" border=1>"; 
										    echo("<tr>
										    	<td>id_tickets</td>
										    	<td>price</td>
										    	<td>name</td>
										    	<td>description</td>
										    	</tr>");
										    while($row = mysql_fetch_array($query)){ 
										    	echo( "<tr>
										    	<td>{$row[0]}</td>
										    	<td>{$row[1]}</td>
										    	<td>{$row[2]}</td>
										    	<td>{$row[3]}</td>
										    	</tr>");

										   	} 
										    echo "</table>"; 
									?>

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




?>


