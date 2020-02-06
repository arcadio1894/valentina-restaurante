var map;
var latitude =  $('#center_latitude').val();
var longitude =  $('#center_longitude').val();
var $polygonObject = $('#polygon');
var $centerObject  = $('#center');
var polygon = JSON.parse($polygonObject.val());

function initMap() {
    var polygonGoogleMaps = [];
    var mapOptions = {
        center: new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude)),
        zoom: 14,
    };

    map = new google.maps.Map(document.getElementById('map'),mapOptions);

    for (var i = 0; i < polygon.length; i++) {
        polygonGoogleMaps.push(new google.maps.LatLng(parseFloat(polygon[i][0]), parseFloat(polygon[i][1])));
    }

    polygon = new google.maps.Polygon({
        paths: polygonGoogleMaps,
        editable: true,
        fillColor: "#ff7f50",
        strokeColor: "#ff7f50"
    });

    polygon.setMap(map);
    google.maps.event.addListener(polygon, 'mousemove', storePolygon);
}

function storePolygon(e) {
    var contentString = this.getPath().getArray();
    $polygonObject.val(contentString);
    $centerObject.val(map.getCenter());
}