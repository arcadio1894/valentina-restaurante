$(document).on('ready', main());

var map;
var infoWindow;
var latitude =  $('#center_latitude').val();
var longitude =  $('#center_longitude').val();
var $polygonsObject = $('#polygons');
var polygons = JSON.parse($polygonsObject.val());
var polygon;
var content = '';
var color = '';
var colors = [];
var zoneName = ''

function main(){
    google.maps.event.addDomListener(window, 'load', initMap);
}

function initMap() {
    var polygonGoogleMaps;
    var mapOptions = {
        center: new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude)),
        zoom: 12,
    };

    map = new google.maps.Map(document.getElementById('map'),mapOptions);

    for (var polygon of polygons) {
    	zoneName = polygon.name;
    	polygon  = JSON.parse(polygon.polygon);
	    color    = generateColor();
    	polygonGoogleMaps = [];

	    for (var j = 0; j < polygon.length; j++) {
	        polygonGoogleMaps.push(new google.maps.LatLng(parseFloat(polygon[j][0]), parseFloat(polygon[j][1])));
	    }

	    while(colors.includes(color)){
	    	color = generateColor();
	    }

	    content = '<b style="color:'+color+'">'+zoneName.toUpperCase()+'</b>'

  		infoWindow = new google.maps.InfoWindow();
	    polygon = new google.maps.Polygon({
	        paths: polygonGoogleMaps,
	        fillColor: color,
        	strokeColor: color,
        	strokeWeight: 1,
        	content: content
	    });

	    polygon.setMap(map);
	    polygon.addListener('click', showInfoWindow);
	}
}

function generateColor(){
	return '#'+Math.floor(Math.random()*16777215).toString(16);
}

function showInfoWindow(event){
  	infoWindow.setContent(this.content);
  	infoWindow.setPosition(event.latLng);
  	infoWindow.open(map);
}