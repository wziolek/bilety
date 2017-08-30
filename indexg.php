<?php
	include "php.php";
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
		<script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script type="text/javascript">
			//plugin bootstrap minus and plus
			//http://jsfiddle.net/laelitenetwork/puJ6G/
			$( document ).ready(function() {
			    $('.btn-number').click(function(e){
			        e.preventDefault();
			        
			        var fieldName = $(this).attr('data-field');
			        var type      = $(this).attr('data-type');
			        var input = $("input[name='"+fieldName+"']");
			        var currentVal = parseInt(input.val());
			        if (!isNaN(currentVal)) {
			            if(type == 'minus') {
			                var minValue = parseInt(input.attr('min')); 
			                if(!minValue) minValue = 0;
			                if(currentVal > minValue) {
			                    input.val(currentVal - 1).change();
			                } 
			                if(parseInt(input.val()) == minValue) {
			                    $(this).attr('disabled', true);
			                }
			    
			            } else if(type == 'plus') {
			                var maxValue = parseInt(input.attr('max'));
			                if(!maxValue) maxValue = 9999999999999;
			                if(currentVal < maxValue) {
			                    input.val(currentVal + 1).change();
			                }
			                if(parseInt(input.val()) == maxValue) {
			                    $(this).attr('disabled', true);
			                }
			    
			            }
			        } else {
			            input.val(0);
			        }

			    });
			    $('.input-number').focusin(function(){
			       $(this).data('oldValue', $(this).val());
			    });
			    $('.input-number').change(function() {
			        
			        var minValue =  parseInt($(this).attr('min'));
			        var maxValue =  parseInt($(this).attr('max'));
			        if(!minValue) minValue = 0;
			        if(!maxValue) maxValue = 9999999999999;
			        var valueCurrent = parseInt($(this).val());
			        
			        var name = $(this).attr('name');
			        if(valueCurrent >= minValue) {
			            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
			        } else {
			            alert('Sorry, the minimum value was reached');
			            $(this).val($(this).data('oldValue'));
			        }
			        if(valueCurrent <= maxValue) {
			            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
			        } else {
			            alert('Sorry, the maximum value was reached');
			            $(this).val($(this).data('oldValue'));
			        }
			        
			        
			    });
			    $(".input-number").keydown(function (e) {
			            // Allow: backspace, delete, tab, escape, enter and .
			            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
			                 // Allow: Ctrl+A
			                (e.keyCode == 65 && e.ctrlKey === true) || 
			                 // Allow: home, end, left, right
			                (e.keyCode >= 35 && e.keyCode <= 39)) {
			                     // let it happen, don't do anything
			                     return;
			            }
			            // Ensure that it is a number and stop the keypress
			            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			                e.preventDefault();
			            }
			    });
			});		
		</script>
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
				      	<button type="submit" type="button" class="btn btn-default submit">SIGN IN</button></p>
			      	</div>
				</div>
		    	</div>
		  	</div>
		</div><!-- Modal -->
		<header>
			<!-- Nav -->
			<nav class="navbar navbar-inverse navbar-fixed-top">
		      	<div class="container">
			        <div class="navbar-header">
			          	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
			          	</button>
			          	<a class="navbar-brand" href="#">BuyTicket</a>
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
		    </nav><!-- Nav -->
		</header>
		<div class="container page">
      		<div class="starter-template">
        		<h1>Buy ticket</h1>
       			<p class="lead">Tickets will be on sale at the latest from December 16, 2016 until June 5, 2017 <h6>We recommend you buy tickets from official sources only.<br> By purchasing a ticket outside the official outlet network,you risk to buy a forged ticket and therefore may not be admitted to the Event.</h6></p>
      		</div>
			<div class="row ">
				<div class="select">
					<p>Select the date you would like to attend (if more than one is available) and the quantity of each ticket type you would like to purchase for that date.<br>Click 'Continue'</p>
					<form action="basket.php" method="post">
		 				<?php
		 					$query = mysql_query("SELECT * FROM tickets") or die ("die");
							while ($row = mysql_fetch_array($query)){
								echo('<div class="col-md-1 ticket">
										<div class="ticket-text">
										  	<h3>'.$row[2].'</h3><p>- electronic ticket to the bearer</p>
										  	<h1>'.$row[1].'E</h1>
										</div>
										<div class="center">
											<hr>
											<p>Choose quantity</p>
											<div class="input-group">
												<span class="input-group-btn">
													<button type="button" class="btn btn-default btn-number box1" disabled="disabled" data-type="minus" data-field="ticket['.$row[0].']">
														<span class="glyphicon glyphicon-minus"></span>
													</button>
												</span>
												<input type="text" name="ticket['.$row[0].']" class="form-control input-number box1" value="0">
												<span class="input-group-btn">
													<button type="button" class="btn btn-default btn-number box1" data-type="plus" data-field="ticket['.$row[0].']">
														<span class="glyphicon glyphicon-plus"></span>
													</button>
												</span>
											</div>
											<p></p>
										</div>
									</div>');
							};
		 				?>
	 					<button type="submit" class="btn btn-default submit"<a href="basket.php"></a> Continue </button>
	 				</form>
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
		</footer>
	</body>
</html>

  