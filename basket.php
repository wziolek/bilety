<?php
$db=mysql_connect('localhost','root');//konektor laczy sie z baza danych http://localhost/koncert/wyglad/indexg.php
mysql_select_db("TechnikiInternetu");
?>

<html>
	<head>
	<title> Szablon HTML </title>

	<meta http-equiv="Content-type" content="text/html; charset=iso-8859-2">
	<meta name="Description" content="Mechanizm rejestracji użytkownika w aplikacji internetowej">
	<meta name="Keywords" content="dane">
	<meta name="Author" content=" Weronika Krasoń">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="stylesg.css">

	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">-->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script>
		$(document).on('click', 'a', function(event){
	    event.preventDefault();
	    $('body').animate({
	        scrollTop: $($.attr(this, 'href')).offset().top
	   	 }, 800);
		});
	</script>
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
				      	<a class=" logo navbar-brand" href="http://localhost/koncert/wyglad/indexg.php">BuyTicket</a>
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
        					<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> My bag</a></li>
      					</ul>
       				</div>
				</div>
			</div>
		</header>
		<div class="container page">
        		<h3>Shopping bag</h3>
       			<div class="container shopping">

				  	<div class="row">
					    <div class="col-md-4 col-sm-4 col-xs-12">
					       <h6>Item</h6>
					    </div>
					    <div class="col-md-2 col-sm-2 col-xs-12">
					       <h6>Quantity</h6>
					    </div>
					    <div class="col-md-2 col-sm-2 col-xs-12">
					        <h6>Unit price</h6>
					    </div>
					    <div class="col-md-2 col-sm-2 col-xs-12">
					        <h6>Total price</h6>
					    </div>
					    <div class="col-md-2 col-sm-2 col-xs-12">
					      	<h6>Remove</h6>
					    </div>
				  	</div>
				  	<hr>
					<div class="row">
					    <div class="col-md-6 col-sm-6 col-xs-12">
					    	<h6>PLEASE ENTER YOUR PROMOTION CODE</h6>
							<form class="form-inline">
							  <div class="form-group">
							    <label for="promocode" class="sr-only">Email</label>

						    	<input type="text" placeholder="Enter your code" name="uname" required></input>
							    <!--<input type="text" readonly class="form-control-plaintext" id="promocode" value="promo123">-->
							  </div>
							  <button type="submit" type="button" class="btn btn-default">OK</button>
							</form>
					    </div>
					    <div class="col-md-3 col-sm-3 col-xs-6">
					    	<div class="row">
					    		<div class="col-md-12 col-sm-12 col-xs-12">
					    			<h6>ITEM TOTAL:</h6>
					    		</div>
					    		<div class="col-md-12 col-sm-12 col-xs-12">
					    			<h6>SHIPPING FEE:</h6>
					    		</div>
					    		<div class="col-md-12 col-sm-12 col-xs-12">
					    			<h6>SUB TOTAL:</h6>
					    		</div>
							</div>
					    </div>
					    <div class="col-md-3 col-sm-3 col-xs-6">
					    	<div class="row">
					    		<div class="col-md-12 col-sm-12 col-xs-12">
					    			<h6>E</h6>
					    		</div>
					    		<div class="col-md-12 col-sm-12 col-xs-12">
					    			<h6>E</h6>
					    		</div>
					    		<div class="col-md-12 col-sm-12 col-xs-12">
					    			<h6>E</h6>
					    		</div>
							</div>
					    </div>

					    </div>
				  	</div>
				<button type="button" class="btn btn-default" > Continue </button>			  	
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
				      			<p><a href="buyticket@buyticket.com" target="_top"><span class="glyphicon glyphicon-envelope"></span><h5>buyticket@buyticket.com</h5></a></p> 
				      			
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

  