<?php

include_once 'config.php';
include_once 'opendb.php';

//ip, date, type, loc
//$userinput = $_POST['datatype1'];

$type = $_POST['datatype2'];
//$type = "other";
$cnt = 0;          
$fetch_markers1 = mysql_query("SELECT lat,lon FROM intrusions");
$result   = $fetch_markers1; 
$jsonCnt = 0;
$fitCnt  = 0;
$noOfFit = 0;
print ("[");
while ($row = mysql_fetch_assoc($result)){     
    
    $lat = $row['lat'];
    $lon = $row['lon'];
//echo $lat;    
    //$myLat = 0;
    //$myLong = 0;
 //<option value='dh' id='dh'>Dunn Hall</option>\n";
//$locreturn .= "<option value='fit' id='fit'>FIT</option>\n";
//$locreturn .= "<option value='holidayinn' id='holidayinn'>UofM Holiday Inn</option>\n";
//$locreturn .= "<option value='library' id='library'>Library</option>\n";
//$locreturn .= "<option value='other' id='other'>Other</option>\n";   
//$uofmHolidayInnTest = calculateDistance(35.123840, -89.938332, $lat, $lon);



$fitTest = calculateDistance(35.121730, -89.940017, $lat, $lon);
$libraryTest = calculateDistance(35.120955, -89.936137, $lat, $lon);
$holidayinnTest = calculateDistance(35.123840, -89.938332, $lat, $lon);
$dunnHallTest = calculateDistance(35.121173, -89.938053, $lat, $lon);
$moreJson = "";
if ($type == "dh"){

if ($dunnHallTest < 0.1)
{
$dhIntruders = generateJson($lat,$lon);
if($jsonCnt <= 11)
    {
    $moreJson .= ",";
    print($moreJson);
    }
} 
$jsonCnt++;        
//echo $jsonCnt."<br>";
}
else if ($type == "holidayinn"){

if ($holidayinnTest < 0.1)
{
$dhIntruders = generateJson($lat,$lon);

  if($jsonCnt <= 4)
    {
    $moreJson .= ",";
    print($moreJson);
    }
} 
$jsonCnt++;        
//echo $jsonCnt."<br>";
}
else if ($type == "fit"){

if ($fitTest < 0.1)
{
$dhIntruders = generateJson($lat,$lon);

} 
$jsonCnt++;        
//echo $jsonCnt."<br>";
}
else if ($type == "library"){

if ($libraryTest < 0.1)
{
$dhIntruders = generateJson($lat,$lon);

  if($jsonCnt <= 14)
    {
    $moreJson .= ",";
    print($moreJson);
    }
} 
$jsonCnt++;        
//echo $jsonCnt."<br>";
}
else if ($type == "other"){

if ($libraryTest > 0.1 && $dunnHallTest > 0.1 && $holidayinnTest > 0.1 && $fitTest > 0.1)
{
$dhIntruders = generateJson($lat,$lon);

  if($jsonCnt <= 8)
    {
    $moreJson .= ",";
    print($moreJson);
    }
} 
$jsonCnt++;        
//echo $jsonCnt."<br>";
}
}
print ("]");
//calculate where coordinates came from
function calculateDistance($lat1, $lon1, $lat2, $lon2)
{ // BEGIN function calculateDistance

    $R = 6371;
    $dlat1 = deg2rad($lat2 - $lat1);
    $dlon1 = deg2rad(($lon2) - ($lon1));
    $lat1 = deg2rad($lat1);
    $lat2 = deg2rad($lat2);
    
    $a = sin($dlat1/2) * sin($dlat1/2) + 
         sin($dlon1/2) * sin($dlon1/2) *
         cos($lat1) * cos ($lat2);
         
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    
    $d = $R * $c;
    
   return $d;     	
}

function generateJson($myLat,$myLong)
{ // BEGIN function generateJson
$cnt = 0;
$fetch_markers = mysql_query("SELECT * FROM intrusions WHERE lat=$myLat AND lon=$myLong");
$result   = $fetch_markers;

while ($row = mysql_fetch_assoc($result)){
    
    $id= $row['intrusionId'];
    $ipaddress =  $row['ipAddress'];
    $intrusiondes = $row['intrusionDescription'];
    $DateTime = $row['dateTimeofIntrusion'];
    $Devicetype = $row['deviceType'];
    $noOfIntrusions = $row['numberOfIntrusions'];
    $lat2 = $row['lat'];
    $lon2 = $row['lon'];
    
$theme = "";
$jsonResponse = "";
$windowstring = "Date: ".$DateTime.""."</br>"."Type of Intrusion: ".$intrusiondes.""."</br>".
                "Device Type: ".$Devicetype.""."</br>"."<font color=red># of Intrusions: <b/>".
                $noOfIntrusions."</font>";        
    
$jsonResponse .= "{";
$jsonResponse .= "\"start\" :" . "\"".$DateTime."\"".",";
//$jsonResponse .= "\"end\" : " . "\"".$DateTime."\"".",";
$jsonResponse .= "\"point\" : ";
$jsonResponse .= "{";
$jsonResponse .= "\"lat\" : " . $lat2. ",";
$jsonResponse .= "\"lon\" : " . $lon2;
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

// if($cnt<mysql_num_rows($result)-1)
// {
//     $jsonResponse .= ",";
// }
// 
//       $cnt++;
 }
// 
//$jsonResponse .= "]";                     
  
print($jsonResponse);
} // END function generateJson
 
             
?>
