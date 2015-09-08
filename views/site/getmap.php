<?php
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

$coord = new LatLng(['lat' => 50.45466, 'lng' => 30.5238]);
$map = new Map([
    'center' => $coord,
    'zoom' => 11,
]);
$map->height = '800';
$map->width = '100%';


$polylineOptions = new PolylineOptions([
    'strokeColor' => 'black',
    'draggable' => true
]);

// Now the renderer
$directionsRenderer = new DirectionsRenderer([
    'map' => $map->getName(),
    'polylineOptions' => $polylineOptions
]);
//echo 'count='.count($markers);
// Lets configure the markers that renders the direction
foreach ($markers as $marker) {

//    $icon = new EGMapMarkerImage($img);
//    $icon->setSize(36, 52);
//    $icon->setAnchor(16, 16.5);
//    $icon->setOrigin(0, 0);


    $newPoint = new Marker([
        'position' => new LatLng(['lat' => $marker['latitude'], 'lng' => $marker['longitude']]),
        'title' => $marker['name'],
        'icon' => 'http://greenapi.loc/img/icon2.png',
    ]);
    $html = "
<h3>{$marker['name']}</h3>
<img src='/img/gree-point.gif'> <span style='color:green'>{$marker['address']}</span> <img src='/img/turn-right.png'>
<br/>";
    if (!empty($marker['phone'])) {
        $html .= "<img src='/img/call.png'>{$marker['phone']}";
    }
    if ($marker['type'] == 'battery') {
        $html .= "<img src='/img/batt.png'>";
    }
    if (!empty($marker['comment'])) {
        $html .= "({$marker['comment']})";
    }
    $newPoint->attachInfoWindow(
        new InfoWindow([
            'content' => $html //$marker->name
        ]));
    $map->addOverlay($newPoint);
}

echo $map->display();
?>
<script>

    window.onload = function () {
        $(".skin-black").addClass("sidebar-collapse");
        //alert("window load occurred!");
        //alert(jQuery("#gmap0-map-canvas").css("height"));
        //jQuery("#gmap0-map-canvas").css("height", 1024);
    }


    //console.log(document.getElementById("gmap0-map-canvas").style.height);


</script>