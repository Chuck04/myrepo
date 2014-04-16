<?php

include_once 'config.php';
include_once 'opendb.php';

//ip, date, type, loc
//$userinput = $_POST['datatype1'];

$type = $_POST['datatype2'];
//echo $ip;

$fetch_markers = mysql_query("SELECT * FROM intrusions WHERE intrusionDescription='$type'");
$result   = $fetch_markers;
$cnt=0;


//echo "Number of markers: " . mysql_num_rows($result);
$theme = "";
$jsonResponse = "[";



while ($row = mysql_fetch_assoc($result))
{     
    $id= $row['intrusionId'];
    $ipaddress =  $row['ipAddress'];
    $intrusiondes = $row['intrusionDescription'];
    $DateTime = $row['dateTimeofIntrusion'];
    $Devicetype = $row['deviceType'];
    $noOfIntrusions = $row['numberOfIntrusions'];
    $lat = $row['lat'];
    $lon = $row['lon'];
    
$windowstring = "Date: ".$DateTime.""."</br>"."Type of Intrusion: ".$intrusiondes.""."</br>".
                "Device Type: ".$Devicetype.""."</br>"."<font color=red># of Intrusions: <b/>".
                $noOfIntrusions."</font>";        
    
$jsonResponse .= "{";
$jsonResponse .= "\"start\" :" . "\"".$DateTime."\"".",";
//$jsonResponse .= "\"end\" : " . "\"".$DateTime."\"".",";
$jsonResponse .= "\"point\" : ";
$jsonResponse .= "{";
$jsonResponse .= "\"lat\" : " . $lat. ",";
$jsonResponse .= "\"lon\" : " . $lon;
$jsonResponse .= "}".",";
$jsonResponse .= "\"title\" : " . "\"".$ipaddress."\"".",";
$jsonResponse .= "\"options\" : ";
$jsonResponse .= "{";
$jsonResponse .= "\"infoURL\" : " . "\"ajax_content.html\"". ",";
$jsonResponse .= "\"description\" : " . "\"".$windowstring."\"". ",";
//$jsonResponse .= "\"IP Address: 141.12.100.18\"" ",";
//set the marker color
if ($intrusiondes == "Ping of Death")
{
     $theme = "red";
}

elseif ($intrusiondes == "ICMP Msg") 
{
     $theme = "blue";	
}
elseif ($intrusiondes == "SYN ATTACK") 
{
     $theme = "purple";	
}

else {
	$theme = "green";
}

$jsonResponse .= "\"theme\" : " . "\"".$theme."\"";
$jsonResponse .= "}";
$jsonResponse .= "}";

if($cnt<mysql_num_rows($result)-1)
{
    $jsonResponse .= ",";
}

      $cnt++;
      
//print($jsonResponse);
}
  
$jsonResponse .= "]";

//$data = json_encode($jsonResponse);
//echo($data);
print($jsonResponse);

//echo($data[$i]['ipaddress']);
              
?>
