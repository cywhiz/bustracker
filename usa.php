<link rel="stylesheet" href="main.css" type="text/css">
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>

<?php
include 'simple_html_dom.php';

$startDate = strtotime($_POST["startDate"]);
$endDate = strtotime($_POST["endDate"]);
$fromCity = $_POST["fromCity"];
$toCity = $_POST["toCity"];
$fromCityName = $_POST["fromCityName"];
$toCityName = $_POST["toCityName"];
$promoCode = $_POST["promoCode"];

echo '<h3>Megabus schedule for:</h3>';
echo $fromCityName.' to '.$toCityName.'<br>';
echo date('m/d/y', $startDate).' - '.date('m/d/y', $endDate).'<br><br>';

echo '<table>';
echo '<tr>';
echo '<th>Date</th>';
echo '<th>Departure Time</th>';
echo '<th>Arrival Time</th>';
echo '<th>Duration</th>';
echo '<th>Price</th>';
echo '<th>Schedule</th>';
echo '</tr>';

$oddRow = true;
$colour = '';

do {
   $url = 'http://us.megabus.com/JourneyResults.aspx?originCode='.$fromCity.'&destinationCode='.$toCity.'&outboundDepartureDate='.date('m/d/y',  $startDate).'&inboundDepartureDate=&passengerCount=1&transportType=0&concessionCount=0&nusCount=0&outboundWheelchairSeated=0&outboundOtherDisabilityCount=0&inboundWheelchairSeated=0&inboundOtherDisabilityCount=0&outboundPcaCount=0&inboundPcaCount=0&promotionCode='.$promoCode.'&withReturn=0';
   
	$userAgent = 'Mozilla/5.0 (Windows NT 6.1; rv:17.0) Gecko/20100101 Firefox/17.0';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$page = curl_exec($ch);
	$html = str_get_html($page);  
	curl_close($ch);

	include 'table.php';

	$colour = ($oddRow ? '#FFFFFF' : '#FFFFCC');

	for ($x=0; $x<$i; $x++) {
		echo '<tr bgcolor='.$colour.'>';
		echo '<td><font color="red"><b>'.date('m/d/y', $startDate).'<b></font></td>';
		echo '<td>'.$depart[$x].'</td>';
		echo '<td>'.$arrive[$x].'</td>';
		echo '<td>'.$duration[$x].'</td>';
		echo '<td>'.$price[$x].'</td>';
		echo '<td><a href="http://us.megabus.com/'.$link[$x].'">View</a><div class="view"><iframe src="http://us.megabus.com/'.$link[$x].'"></iframe></div></td>';
		echo '</tr>';
	}
	
	$startDate = strtotime('+1 day', $startDate);
	$oddRow = !$oddRow;
} while ($startDate <= $endDate);

echo '</table>';
?>
