<?php

include_once 'config.php';
include_once 'opendb.php';
//datatype1
//ip, date, type, loc
$userinput = $_POST['datatype1'];
//$userinput = "loc";
//echo $userinput;
$ipcnt = 0;
$datecnt = 0;
$loccnt = 0;
if($userinput=="ip") {
$ipreturn = "";
$fetch_markers = mysql_query("SELECT DISTINCT(ipAddress) as ipAddress FROM intrusions");
$result   = $fetch_markers;
while ($row = mysql_fetch_assoc($result)){
$ipaddress =  $row['ipAddress'];
$ipcnt++;
$ipreturn .= "<option value='$ipaddress' id='$ipaddress'>$ipaddress</option>\n";
print $ipaddress;
print $userinput;
}
print $ipreturn;
}
elseif($userinput=="date"){
$datereturn = "";
$fetch_markers = mysql_query("SELECT DISTINCT(dateTimeofIntrusion) as dateTimeofIntrusion FROM intrusions  ORDER BY dateTimeofIntrusion");
$result   = $fetch_markers;
while ($row = mysql_fetch_assoc($result)){
$mydate =  $row['dateTimeofIntrusion'];
$datecnt++;
$datereturn .= "<option value='$mydate' id='$mydate'>$mydate</option>\n";
print $mydate;
print $userinput;
}
print $datereturn;
}
elseif($userinput=="type"){
$fetch_markers = mysql_query("SELECT DISTINCT(intrusionDescription) as intrusionDescription FROM intrusions");
$result   = $fetch_markers;
while ($row = mysql_fetch_assoc($result)){
$myDeviceType =  $row['intrusionDescription'];
$typecnt++;
$typereturn .= "<option value='$myDeviceType' id='$myDeviceType'>$myDeviceType</option>\n";
print $myDeviceType;
print $userinput;
}
print $typereturn;
}
elseif($userinput=="loc")
{
$locreturn .= "<option  value='dh' id='dh'>Dunn Hall</option>\n";
$locreturn .= "<option value='fit' id='fit'>FIT</option>\n";
$locreturn .= "<option value='holidayinn' id='holidayinn'>UofM Holiday Inn</option>\n";
$locreturn .= "<option value='library' id='library'>Library</option>\n";
$locreturn .= "<option value='other' id='other'>Other</option>\n";
print $locreturn;
}


else 
{
	  echo "<option>select a filter</option>\n";
}

?>
