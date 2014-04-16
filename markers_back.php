<?php

include_once 'config.php';
include_once 'opendb.php';

$query = 'SELECT intrusionId FROM intrusions';
$res = mysql_query($query);

//$jmarkers = array();


$fetch_markers = mysql_query("SELECT * FROM intrusions");
$result   = $fetch_markers;
$cnt=0; 

while ($row = mysql_fetch_assoc($result)) 
{
  
    $id= $row['intrusionId'];
    $ipaddress =  $row['ipAddress'];
    $intrusiondes = $row['intrusionDescription'];
    $DateTime = $row['dateTimeofIntrusion'];
    $Devicetype = $row['deviceType'];
    $lat = $row['lat'];
    $lon = $row['long'];

    $data[$cnt]['int']=$id;
    $data[$cnt]['ipAddress']=$ipaddress;
    $data[$cnt]['intrusionDescription']=$intrusiondes;
    $data[$cnt]['dateTimeofIntrusion']=$DateTime;
    $data[$cnt]['deviceType']=$Devicetype;
    $data[$cnt]['lat']=$lat;
    $data[$cnt]['long']=$lon;
    
    $cnt++;
}

$data = json_encode($data);
echo($data);


?>