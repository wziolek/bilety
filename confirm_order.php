<?php
session_start();
$db=mysql_connect('localhost','root');//konektor laczy sie z baza danych http://localhost/koncert/wyglad/indexg.php
mysql_select_db("TechnikiInternetu");


$query = mysql_query("SELECT * FROM Customer WHERE login='".$_SESSION["login"]."'") or die ('die');
$result = mysql_fetch_assoc($query);
// print_r($result);
$sub_total=0;
$order_date;
$shipped_date;
$ship_via;
$paid;
$payment_method;
foreach ($_SESSION["tickets"] as $key => $value) {
	if ($value > 0 ){
		$query = mysql_query("SELECT * FROM tickets where id_tickets=".$key) or die ("die");
		$row = mysql_fetch_array($query);
		$sub_total=$sub_total+($value*$row[1]);
	}
}

$sub_total+=6;
// echo($sub_total);
$date = date('Y-m-d', time());

$query2 = mysql_query("INSERT INTO orders (id_customer, value, order_date) VALUES ('".$result['id_customer']."','".$sub_total."','".$date."')")or die ('die2');
$order_id = mysql_insert_id();
if($query2){
	// echo("zapisano");
	foreach ($_SESSION['tickets'] as $key => $value) {
		if($value > 0){
			$query3 = mysql_query("INSERT INTO order_details (id_tickets, id_orders, amount) VALUES ('".$key."','".$order_id."','".$value."')")or die ('die3');
		}
	}
}
// echo(mail('dziolas@gmail.com', $result['e_mail'], 'Order confirmation'));

$query3 = mysql_query("SELECT * FROM Customer WHERE login='".$_SESSION["login"]."'") or die ('die');
$result = mysql_fetch_assoc($query);
print_r($result);

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
	 </script>
	<script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	</head>
	<body>
		<div class="container order">
			<h4>Order nr: <?php echo($order_id); ?></h4>		
			<h4>Order data: <?php echo($date); ?></h4>
			<h5>Thank you for your order on the site ticketbuy.com</h5>
			<h4>ORDER INFORMATION:</h4>
			<h5>Ordered products:</h5>
   			<div class="container shopping">
			  	<div class="row">
				    <div class="col-md-6 col-sm-6 col-xs-6">
				       <h6>Item</h6>
				    </div>
				    <div class="col-md-2 col-sm-2 col-xs-2">
				       <h6>Quantity</h6>
				    </div>
				    <div class="col-md-2 col-sm-2 col-xs-2">
				        <h6>Unit price</h6>
				    </div>
				    <div class="col-md-2 col-sm-2 col-xs-2">
				        <h6>Total price</h6>
				    </div>
			  	</div>
				<?php
					$item_total=0;
					if (array_key_exists("tickets", $_SESSION)){//jesli tickets istnieje w sesji
						foreach ($_SESSION["tickets"] as $key => $value) {
							if ($value > 0 ){
								echo('<div class="row product">');
		   						echo('<div class="col-md-6 col-sm-6 col-xs-6">');
								$query = mysql_query("SELECT * FROM tickets where id_tickets=".$key) or die ("die");
								$row = mysql_fetch_array($query);
								echo($row[2]);
								//echo('<span>'.$key.'</span>');
								echo('</div>');
								echo('<div class="col-md-2 col-sm-2 col-xs-2">');
	    							//echo('<a href="#" title="Decrease quantity" class="glyphicon glyphicon-chevron-left icon"></a>');
	    						echo('<input class="quantityInput white" type="value" value="'.$value.'" readonly="readonly">');
	    							//echo('<a href="#" title="I\'d like more please" class="glyphicon glyphicon-chevron-right icon"></a>');
	    						echo('</div>');
	    						echo('<div class="col-md-2 col-sm-2 col-xs-2">');
	    						echo($row[1]);
	    						echo('</div>');
	    						echo('<div class="col-md-2 col-sm-2 col-xs-2">');
	    							echo($value*$row[1]);
	    						echo('</div>');		    									    						
	    						echo('</div>');
	    						$item_total=$item_total+($value*$row[1]);
							}
						}
					}
				?>
				<br>
				<br>
				<div class="row">
				    <div class="col-md-3 col-sm-3 col-xs-3">
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
				    <div class="col-md-3 col-sm-3 col-xs-3">
				    	<div class="row">
				    		<div>
				    			<h6>
				    			<?php echo($item_total);?>E</h6>
				    		</div>
				    		<div class="col-md-12 col-sm-12 col-xs-12">
				    			<h6>6E</h6>
				    		</div>
				    		<div class="col-md-12 col-sm-12 col-xs-12">
				    			<h6><?php echo($item_total+6);?>E</h6>
				    		</div>
						</div>
				    </div>
			  	</div>
			 </div>
			 <h4>PURCHASER</h4>
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
			<h4>PAYMENT INFORMATION AND IMPLEMENTATION OF THE CONTRACT:</h4>
			<h6>To pay the full cost of the order, please make a bank transfer to the following account:</h6>
			<h6>RECIPIENT NAME: buyticket.com<br>
				ACCOUNT NUMBER: XX-XXXX-XXXX-XXXX-XXXX-XXXX-XXXX<br>
				TITLE: Order Nr <?php echo($order_id); ?><br>
				FOR PAYMENT: <?php echo($item_total+=6);?>E</h6>

    	</div>
	</body>
</html>






