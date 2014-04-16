<?php

// PHP/MySQL code
include_once 'config.php';
include_once 'opendb.php';

$sourceLat = '';
$sourceLon = '';
$radiusKm  = 50;

$proximity = mathGeoProximity($sourceLat, $sourceLon, $radiusKm);
$result    = mysql_query("
    SELECT * 
    FROM   intrusions
    WHERE  (lat BETWEEN " . number_format($proximity['latitudeMin'], 12, '.', '') . "
            AND " . number_format($proximity['latitudeMax'], 12, '.', '') . ")
      AND (long BETWEEN " . number_format($proximity['longitudeMin'], 12, '.', '') . "
            AND " . number_format($proximity['longitudeMax'], 12, '.', '') . ")
");

echo $result;

// fetch all record and check wether they are really within the radius
$recordsWithinRadius = array();
while ($record = mysql_fetch_assoc($result)) {
    $distance = mathGeoDistance($sourceLat, $sourceLon, $record['lat'], $record['lon']);

    if ($distance <= $radiusKm) {
        $recordsWithinRadius[] = $record;
    }
}

// and then print your results using a google map
// ...


// calculate geographical proximity
function mathGeoProximity( $latitude, $longitude, $radius, $miles = false )
{
    $radius = $miles ? $radius : ($radius * 0.621371192);

    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);

    return array(
        'latitudeMin'  => $lat_min,
        'latitudeMax'  => $lat_max,
        'longitudeMin' => $lng_min,
        'longitudeMax' => $lng_max
    );
}

// calculate geographical distance between 2 points
function mathGeoDistance( $lat1, $lng1, $lat2, $lng2, $miles = false )
{
    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lng1 *= $pi80;
    $lat2 *= $pi80;
    $lng2 *= $pi80;

    $r = 6372.797; // mean radius of Earth in km
    $dlat = $lat2 - $lat1;
    $dlng = $lng2 - $lng1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $km = $r * $c;

    return ($miles ? ($km * 0.621371192) : $km);
}


?>