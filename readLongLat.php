<?php

if(isset($_POST['action'])){
$data[0]['longitude'] = "100";
$data[0]['latitude'] = "200";
$data[1]['longitude'] = "150";
$data[1]['latitude'] = "250";
$data[2]['longitude'] = "10";
$data[2]['latitude'] = "20";
$data[3]['longitude'] = "105";
$data[3]['latitude'] = "210";
$data[4]['longitude'] = "190";
$data[4]['latitude'] = "280";
//converting to JSON
$json = json_encode($data);
//Echo JSON for client
echo $json;
}
?>
