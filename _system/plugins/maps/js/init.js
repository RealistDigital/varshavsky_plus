$(document).ready(function(){
    
var initCount               = false  
var initCoordinates         = new Array($('#map-coordinates-x').val(), $('#map-coordinates-y').val()); 
var initCoordinatesCenter   = new Array($('#map-coordinates-x-center').val(), $('#map-coordinates-y-center').val()); 
var initZoom                = parseInt($('#map-zoom').val()); 
var iconMarker              = $('.icon-marker-map').val(); 

// Вызов карты Google в модальном окне
$('.google-map').click(function(){
    var mapConteiner    = $('#map-conteiner');
    var widthModalMap   = 700;
    var heightModalMap  = 500;
    
    if (mapConteiner.width() > 0) {
        widthModalMap = mapConteiner.width();
    }
    if (mapConteiner.height() > 0) {
        heightModalMap  = mapConteiner.height();
    }
    // modal active
    $('#window-google-map').modalWindow({
        width   : widthModalMap,
        height  : heightModalMap,
        colorBlock : "#e6e6e6"
    });
    //--
    mapConteiner.css({
        width   : widthModalMap,
        height  : heightModalMap
    });
    
    // run map ..
    if(!initCount) {
        initialize(initCoordinates, initCoordinatesCenter, initZoom, iconMarker);
        initCount = true;
    }
});


//end ready ..
});

// запись координат
function recCurrentCoord (obj) {
    var wpCoordinatesX  = document.getElementById('map-coordinates-x');
    var wpCoordinatesY  = document.getElementById('map-coordinates-y');
    var x = obj.lat();
    var y = obj.lng();
    //-
    wpCoordinatesX.value = x;
    wpCoordinatesY.value = y;
}

// запись сентра карты
function resCenterMap (objMap) {
    var wpCoordinatesX  = document.getElementById('map-coordinates-x-center');
    var wpCoordinatesY  = document.getElementById('map-coordinates-y-center');
    
    var x = objMap.lat();
    var y = objMap.lng();
    //-
    wpCoordinatesX.value = x;
    wpCoordinatesY.value = y;
}

// set Zoom
function setCurrentZoom (zoom) {
    var wpMapZoom       = document.getElementById('map-zoom');
    // set
    wpMapZoom.value = zoom;
}

// Init Map
function initialize(initCoordinates, initCoordinatesCenter, initZoom, iconMarker) {
    
    // vars
    var defaultCoord            = new Array(50.4501, 30.523400000000038);
    var coordinatesInit         = initCoordinates[0] != 0       && initCoordinates[1] != 0          ? initCoordinates : defaultCoord;
    var coordinatesInitCenter   = initCoordinatesCenter[0] != 0 && initCoordinatesCenter[1] != 0    ? initCoordinatesCenter : defaultCoord;
    
    var startZoom       = initZoom ? initZoom : 13;
    var defaultMarkerIc = '/_system/plugins/maps/img/marker.png';
    var iconForMarker   = iconMarker != "" && iconMarker != undefined ? '/'+iconMarker : defaultMarkerIc;
   
    //--
    var geocoder        = new google.maps.Geocoder();
    var latlng          = new google.maps.LatLng(coordinatesInitCenter[0], coordinatesInitCenter[1]);
    // options
    var mapOptions = {
        zoom: startZoom,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    
    // map
    var map = new google.maps.Map(document.getElementById('map-conteiner'), mapOptions);
    // init Marker
    var markerFirst = new google.maps.Marker({
        position: new google.maps.LatLng(coordinatesInit[0], coordinatesInit[1]),
        map: map,
        icon:iconForMarker,
        draggable:true
    });
    
    
    // Get zoom map
    google.maps.event.addListener(map, 'zoom_changed', function() {
        var zoomLevel = map.getZoom();
        setCurrentZoom (zoomLevel);
    });
    
    // Event Drag Point
    google.maps.event.addListener(markerFirst, 'dragend', function () {
        // coords ..
        var arrCoords = markerFirst.getPosition();
        //console.log(arrCoords);
        // rec in input
        recCurrentCoord(arrCoords);
        // search press to Enrer key
        geocoder.geocode( { 'address': arrCoords.lat() + " " + arrCoords.lng()}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                input.value = results[0].formatted_address;
            } else {
                alert('1 Geocode was not successful for the following reason: ' + status);
            }
        });
    });
    
    // search input
    var input = /** @type {HTMLInputElement} */(document.getElementById('target-map-google'));
    var searchBox = new google.maps.places.SearchBox(input);
    var markers = [];
    
    // Event keyPress
    google.maps.event.addListener(searchBox, 'places_changed', function() {
        var places = searchBox.getPlaces();
        var place  = places[0];
        
        // delete first marker
        markerFirst.setMap(null);
        //-
        /*
        for (var i = 0, marker; marker = markers[i]; i++) {
            // delete all markers
            marker.setMap(null);
        }
        */
        //-
        markers = [];
        var bounds = new google.maps.LatLngBounds();
        
       // for (var i = 0, place; place = places[i]; i++) {
            var image = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };
            //-
            var marker = new google.maps.Marker({
                map: map,
                icon: iconForMarker,
                //title: place.name,
                draggable:true,
                position: place.geometry.location
            });
            
            // coordinates Oblect ...
            var objAddr = marker.getPosition();
            // rec in input
            recCurrentCoord(objAddr);
                    
            // Event Drag Point
            google.maps.event.addListener(marker, 'dragend', function () {
                //console.log(marker.getPosition());
                // rec in input
                recCurrentCoord(marker.getPosition());
                // search press to Enrer key
                geocoder.geocode( { 'address': objAddr.lat() + " " + objAddr.lng()}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        input.value = results[0].formatted_address;
                    } else {
                        alert('2 Geocode was not successful for the following reason: ' + status);
                    }
                });
            });
                      
            //--
            markers.push(marker);
            bounds.extend(place.geometry.location);
        //}
        
        map.fitBounds(bounds);
    });

    google.maps.event.addListener(map, 'bounds_changed', function() {
        var bounds = map.getBounds();
        searchBox.setBounds(bounds);
    });
    
    // Event Drag Map
    google.maps.event.addListener(map, 'dragend', function () {
        resCenterMap(map.getCenter());
    });
}
// init for load page 
//google.maps.event.addDomListener(window, 'load', initialize);