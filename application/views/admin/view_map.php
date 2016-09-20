<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Get the header
include 'includes/header.php';

?>
            <!-- page content -->
            <div class="right_col" role="main">

                <div class="row">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel tile ">
                            <div class="x_title">
                                <?php
                                if(($this->session->flashdata('location_saved')!=null) & $this->session->flashdata('location_saved') ==true){ ?>

                                    <script type="text/javascript">
                                    
                                        $(document).ready(function(){
                                            new PNotify({
                                                title: 'Location saved',
                                                text: 'The location has been saved!',
                                                type: 'success'
                                            });
                                        });
                                        
                                    </script> 
                                <?php }elseif(($this->session->flashdata('location_saved')!=null) & $this->session->flashdata('location_saved') ==false){ ?>
                                    <script type="text/javascript">
                                    
                                        $(document).ready(function(){
                                            new PNotify({
                                                title: 'Location not saved',
                                                text: 'The location failed to save!',
                                                type: 'error'
                                            });
                                        });
                                        
                                    </script>
                                <?php } ?>
                                <?php
                                if(isset($location->meta_data)){
                                    $meta = json_decode($location->meta_data);
                                }

                                ?>
                                <h2><?=isset($meta->firstname) ? $meta->firstname.' '.$meta->lastname : 'Locations' ?> 
                                <small><?=isset($location->full_address) ? $location->full_address : ''; ?></small></h2>
                                
                                <ul class="nav navbar-right panel_toolbox">
                                        
                                        
                                    </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    
                                    
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <style>
                                        
                                       
                                        #main-map canvas {
                                            margin-top: 2px;
                                        }
                                        
                                        .map.anto {
                                            zoom: 0.9%;
                                            zoom: 0.9;
                                            -ms-zoom: 0.9;
                                            -webkit-zoom: 0.9;
                                            -moz-transform: scale(0.9, 0.9);
                                            -moz-transform-origin: left center;
                                        }
                                        
                                        #map-tooltip {
                                            position: absolute;
                                            background: #f2f2f2;
                                            border: solid 2px ##bababa;
                                            margin-left: 5px;
                                            margin-top: 0px;
                                            padding: 7px;
                                            border-radius: 5px;
                                            -moz-border-radius: 5px;
                                            -webkit-border-radius: 5px;
                                            z-index: 1000;
                                        }
                                    </style>
                                    <style type="text/css">
                                        #map-container {
                                            padding: 6px;
                                            border-width: 1px;
                                            border-style: solid;
                                            border-color: #ccc #ccc #999 #ccc;
                                            -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
                                            -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
                                            box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
                                            width: 100%;
                                            overflow: hidden;
                                        }
                                        
                                        
                                        #map {
                                            width: 100%;
                                            height: 100%;
                                        }
                                    </style>
                                    <script src="http://www.google.com/jsapi"></script>
                                    <script type="text/javascript">
                                        var script = '<script type="text/javascript" src="http://tigo.registersim.com/assets/js/src/markerclusterer';
                                        if (document.location.search.indexOf('packed') !== -1) {
                                            script += '_packed';
                                        }
                                        if (document.location.search.indexOf('compiled') !== -1) {
                                            script += '_compiled';
                                        }
                                        script += '.js"><' + '/script>';
                                        document.write(script);
                                    </script>
                                    <script type="text/javascript">
                                        google.load('maps', '3', {
                                            other_params: 'sensor=true'
                                        });
                                        google.setOnLoadCallback(initialize);

                                        

                                        function initialize() {
                                            var data = {
                                                "count": 10,
                                                "photos": [
                                                    {
                                                        "longitude": "122.5069789",
                                                        "latitude": "10.6894811",
                                                        "address": "Sto. Domingo Arevalo Iloilo City",
                                                        "delivery_date": "",
                                                        "ordercode": "",
                                                        "customer": "Kenmart Marketing"
                                                    },
                                                <?php
                                                if(isset($locations)){
                                                    foreach ($locations as $location) {
                                                        
                                                    ?>
                                                    {
                                                        "longitude": "<?=isset($location->lng)? $location->lng : '122.5557048'; ?>",
                                                        "latitude": "<?=isset($location->lat)? $location->lat : '10.7002759'; ?>",
                                                        "address": "<?=isset($location->full_address)? $location->full_address: ''; ?>",
                                                        "delivery_date": "<?=isset($location->date_ordered)? date('F j, Y',strtotime($location->date_ordered)): ''; ?>",
                                                        "ordercode": "<?=isset($location->code)? $location->code: ''; ?>",
                                                        "customer": "<?=isset($location->firstname)? $location->firstname: ''; ?>",
                                                        "distance": "<?=isset($location->distance)? $location->distance: 'not set'; ?>",
                                                        
                                                    },
                                                <?php   }
                                                    }else{
                                                ?>
                                                {
                                                        "longitude": "<?=isset($location->lng)? $location->lng : '122.5557048'; ?>",
                                                        "latitude": "<?=isset($location->lat)? $location->lat : '10.7002759'; ?>",
                                                        "address": "<?=isset($location->full_address)? $location->full_address: ''; ?>",
                                                        "delivery_date": "<?=isset($location->date_ordered)? date('F j, Y',strtotime($order->date_ordered)): ''; ?>",
                                                        "ordercode": "<?=isset($location->code)? $order->code: ''; ?>",
                                                        "customer": "<?=isset($meta->firstname)? $meta->firstname.' '.$meta->lastname: ''; ?>",
                                                        "distance": "<?=isset($location->distance)? $location->distance: 'not set'; ?>",
                                                    },
                                                <?php   
                                                    }
                                                ?>
                                                ]
                                            };
                                            var center = new google.maps.LatLng(<?=isset($location->lat)? $location->lat : '10.7002759'; ?>, <?=isset($location->lng)? $location->lng : '122.5557048'; ?>); //-7.0849437,35.8401773);
                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                zoom: 9,
                                                scrollwheel: false,
                                                // maxZoom: 15,
                                                // minZoom: 6,
                                                center: center,
                                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                                styles: [{
                                                    "featureType": "landscape",
                                                    "elementType": "labels",
                                                    "stylers": [{
                                                        "visibility": "off"
                                                    }]
                                                }, {
                                                    "featureType": "transit",
                                                    "elementType": "labels",
                                                    "stylers": [{
                                                        "visibility": "off"
                                                    }]
                                                }, {
                                                    "featureType": "poi",
                                                    "elementType": "labels",
                                                    "stylers": [{
                                                        "visibility": "off"
                                                    }]
                                                }, {
                                                    "featureType": "water",
                                                    "elementType": "labels",
                                                    "stylers": [{
                                                        "visibility": "off"
                                                    }]
                                                }, {
                                                    "featureType": "road",
                                                    "elementType": "labels.icon",
                                                    "stylers": [{
                                                        "visibility": "off"
                                                    }]
                                                }, {
                                                    "stylers": [{
                                                        "hue": "#00aaff"
                                                    }, {
                                                        "saturation": -100
                                                    }, {
                                                        "gamma": 2.15
                                                    }, {
                                                        "lightness": 12
                                                    }]
                                                }, {
                                                    "featureType": "road",
                                                    "elementType": "labels.text.fill",
                                                    "stylers": [{
                                                        "visibility": "on"
                                                    }, {
                                                        "lightness": 24
                                                    }]
                                                }, {
                                                    "featureType": "road",
                                                    "elementType": "geometry",
                                                    "stylers": [{
                                                        "lightness": 57
                                                    }]
                                                }]
                                            });
                                            var infoWindow = new google.maps.InfoWindow();
                                            var markers = [];
                                            var html_array = [];
                                            for (var i = 0, dataPhoto; dataPhoto = data.photos[i]; i++) {
                                                //console.log(dataPhoto.latitude + " :" + dataPhoto.registrant );
                                                var latLng = new google.maps.LatLng(dataPhoto.latitude, dataPhoto.longitude);
                                                var marker = new google.maps.Marker({
                                                    position: latLng,
                                                    draggable:false,

                                                });


                                                var html = "<div class='infowin'><strong>" + dataPhoto.customer + "</strong><hr>";

                                                if(i > 0){
                                                    html = html + "<p><strong>ORDER CODE: </strong>" + dataPhoto.ordercode + "</p>";
                                                    html = html + "<p><strong>DELIVERY DATE: </strong>" + dataPhoto.delivery_date + "</p>";
                                                    html = html + "<p><strong>ADDRESS: </strong>" + dataPhoto.address + "</p>";
                                                    html = html + "<p><strong>DISTANCE: </strong>" + dataPhoto.distance + "</p>";
                                                    
                                                }
                                                
                                                html_array.push(html);

                                                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                                    return function () {
                                                        infoWindow.setContent(html_array[i]);
                                                        infoWindow.open(map, this);
                                                    }
                                                })(marker, i));
                                                //google.maps.event.addListener(marker, 'mouseout', function() {
                                                // infoWindow.close();
                                                //});
                                                markers.push(marker);
                  
                                            }

                                            

                                            

                                            // Drag marker and get coordinates
                                            google.maps.event.addListener(
                                            marker,
                                            'dragend',
                                                function() {
                                                    var lat = marker.position.lat();
                                                    var lng = marker.position.lng();
                                                    var latlng = new google.maps.LatLng(lat, lng);
                                                    var geocoder = geocoder = new google.maps.Geocoder();

                                                    // Show the latitude and logintude
                                                    document.getElementById("latlng").value = lat + ',' + lng;
                                                    document.getElementById("lat").value = lat;
                                                    document.getElementById("lng").value = lng;
                                                    geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                                                        if (status == google.maps.GeocoderStatus.OK) {
                                                            if (results[1]) {

                                                                // Show the address in input
                                                                document.getElementById("address").value = results[1].formatted_address;
                                                                //data.photos[0].address = results[1].formatted_address;
                                                                //alert("Location: " + results[1].formatted_address);
                                                            }
                                                        }
                                                    });
                                                  
                                                }
                                            );

                                            if (navigator.geolocation) {
                                                //var markerimage = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                                                //var infoWindow = new google.maps.InfoWindow({map: map});
                                                var options = {
                                                      enableHighAccuracy: true,
                                                      timeout: 5000,
                                                      maximumAge: 0
                                                    };
                                                navigator.geolocation.getCurrentPosition(function(position) {
                                                    var pos = {
                                                        lat: position.coords.latitude,
                                                        lng: position.coords.longitude
                                                    };

                                                    //infoWindow.setPosition(pos);
                                                    
                                                    var myPositionMarker = new google.maps.Marker({
                                                        position: {lat: position.coords.latitude, lng: position.coords.longitude},
                                                        map: map,
                                                        //icon: markerimage
                                                    });

                                                    markers.push(myPositionMarker);

                                                    //infoWindow.setContent("Hey Kent! I'm here... " + position.coords.accuracy);


                                                    // google.maps.event.addListener(myPositionMarker, 'click', function () {
                                                    //     infoWindow.open();
                                                    // });

                                                    //map.setCenter(pos);
                                                }, function() {
                                                    handleLocationError(true, infoWindow, map.getCenter());

                                                },options);

                                            }else {
                                                    // Browser doesn't support Geolocation
                                                    handleLocationError(false, infoWindow, map.getCenter());
                                            }
                                            

                                           var markerCluster = new MarkerClusterer(map, markers);
                                           

                                        }
                                        
                                    </script>
                                    <script type="text/javascript">
                                        // $(document).ready(function(){
                                        //     $('#').
                                        // });
                                    </script>
                                    <div id="map-container" style="height:560px">
                                        <div id="map"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

<?php
include 'includes/footer.php';

?>