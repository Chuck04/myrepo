<?php
include_once 'config.php';
include_once 'opendb.php';

$query = 'SELECT intrusionId FROM intrusions';
$res = mysql_query($query);

if ($res)
{
  echo "Connected! Wow!";
}

$fetch_markers = mysql_query("SELECT * FROM intrusions");
$result   = $fetch_markers;
$cnt=0;

if ($result)
{
    echo ("You got the data?");
}

while ($row = mysql_fetch_assoc($result)) 
{
    
    $jsonResponse = "[";
    $id= $row['intrusionId'];
    $ipaddress =  $row['ipAddress'];
    $intrusiondes = $row['intrusionDescription'];
    $DateTime = $row['dateTimeofIntrusion'];
    $Devicetype = $row['deviceType'];
    $lat = $row['lat'];
    $lon = $row['long'];
    
$jsonResponse .= "{";
$jsonResponse .= "\"start\" : \"2013-12-12\"".",";
$jsonResponse .= "\"end\" : \"2014-12-14\"".",";
$jsonResponse .= "\"point\" : ";
$jsonResponse .= "{";
$jsonResponse .= "\"lat\" : " . $lat. ",";
$jsonResponse .= "\"lon\" : " . $lon;
$jsonResponse .= "}".",";
$jsonResponse .= "\"title\" : " . "\"".$Devicetype."\"" .",";
$jsonResponse .= "\"options\" : ";
$jsonResponse .= "{";
$jsonResponse .= "\"infoURL\" : " . "\"ajax_content.html\"". ",";
$jsonResponse .= "\"theme\" : " . "\"red\"";
$jsonResponse .= "}";
$jsonResponse .= "}";

if($cnt<sizeof($result)-1)
{
    $jsonResponse .= ",";
}

      $cnt++;
      
print($jsonResponse);
}
$jsonResponse .= "]";

//print($jsonResponse);

//echo($data[$i]['ipaddress']);

?>
