$(document).on('ready', main());

var map;
var latitude =  $('#center_latitude').val();
var longitude =  $('#center_longitude').val();
var $polygonObject = $('#polygon');
var $centerObject  = $('#center');

function main(){
    google.maps.event.addDomListener(window, 'load', initMap);
}

function initMap() {
    var mapOptions = {
        center: new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude)),
        zoom: 14,
        streetViewControl: false,
        scrollwheel: false
    };

    var drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polygon']
        },
        polygonOptions: {
            editable: true,
            fillColor: "#ff7f50",
            strokeColor: "#ff7f50"
        },
        drawingControl: false
    });

    map = new google.maps.Map(document.getElementById('map'),mapOptions);
    drawingManager.setMap(map);

    google.maps.event.addListener(drawingManager, "overlaycomplete", function (event) {
        $polygonObject.val(event.overlay.getPath().getArray());
        $centerObject.val(map.getCenter());
    });
}