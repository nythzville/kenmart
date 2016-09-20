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

                                if(isset($user_info->meta_data)){
                                    $meta = json_decode($user_info->meta_data);
                                }

                                ?>
                                <h2><?=isset($meta->firstname) ? $meta->firstname.' '.$meta->lastname : 'Locations' ?> 
                                <small><?=isset($location->full_address) ? $location->full_address : ''; ?></small></h2>
                                
                                <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <button id="save-location" onclick="$('#location-form').submit();" class="btn btn-success">Save Changes</button>
                                        </li>
                                        
                                    </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <form id="location-form" class="form-horizontal form-label-left" method="post" action="<?=base_url('location/store') ?>">
                                        <div class="form-group">
                                            <label class="control-label col-md-1 col-sm-3 col-xs-12">Address</label>
                                            <div class="col-md-5 col-sm-9 col-xs-12">
                                                <input type="text" id="address" name="full_address" class="form-control" value="<?=isset($location->full_address)? $location->full_address : ''; ?>" placeholder="Your Address">
                                            </div>

                                            <label class="control-label col-md-1 col-sm-3 col-xs-12"></label>
                                            
                                            <div class="col-md-5 col-sm-9 col-xs-12" style="">
                                                <input type="hidden" id="latlng" name="latlng" class="form-control" value="<?php if(isset($location->lat) & isset($location->lng)) { echo $location->lat.','.$location->lng ; } ?>" placeholder="">
                                                <input type="hidden" id="lat" name="lat" value="<?=isset($location->lat)? $location->lat : ''; ?>">
                                                <input type="hidden" id="lng" name="lng" value="<?=isset($location->lng)? $location->lng : ''; ?>">
                                                <input type="hidden" id="distance" name="distance" value="<?=isset($location->distance)? $location->distance : ''; ?>">
                                                <input type="hidden" id="lng" name="save_location">
                                            </div>

                                            
                                        </div>
                                        
                                    </form
                                    
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
                                            other_params: 'sensor=false'
                                        });
                                        google.setOnLoadCallback(initialize);
                                        function initialize() {
                                            var data = {
                                                "count": 2,
                                                "photos": [
                                                {
                                                    "longitude": "122.5069789",
                                                    "latitude": "10.6894811",
                                                    "address": "Sto. Domingo, Arevalo, Iloilo City",
                                                    "customer": "Kenmart Marketing"
                                                },
                                                {
                                                    "longitude": "<?=isset($location->lng)? $location->lng : '122.5557048'; ?>",
                                                        "latitude": "<?=isset($location->lat)? $location->lat : '10.7002759'; ?>",
                                                        "address": "<?=isset($location->full_address)? $location->full_address: ''; ?>",
                                                        "contact": "<?=isset($meta->contact)? $meta->contact: ''; ?>",
                                                        "customer": "<?=isset($meta->firstname)? $meta->firstname.' '.$meta->lastname: ''; ?>"
                                                }]
                                            };
                                            var center = new google.maps.LatLng(<?=isset($location->lat)? $location->lat : '10.7002759'; ?>, <?=isset($location->lng)? $location->lng : '122.5557048'; ?>); //-7.0849437,35.8401773);
                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                zoom: 10,
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
                                                    draggable:true
                                                });
                                                var html = "<div class='infowin'><strong>" + dataPhoto.customer + "</strong><hr>";

                                                
                                                    html = html + "<p><strong>ADDRESS: </strong>" + dataPhoto.address + "</p>";
                                                if(i > 0){
                                                    html = html + "<p><strong>CONTACT: </strong>" + dataPhoto.contact + "</p>";
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
                                            var markerCluster = new MarkerClusterer(map, markers);

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

                                                    // Get distance
                                                    var origin = new google.maps.LatLng(10.6894811,122.5069789);
                                                
                                                    var destinationB = new google.maps.LatLng(lat,lng);
                                                    var thedistance = null;
                                                    var service = new google.maps.DistanceMatrixService();

                                                    service.getDistanceMatrix(
                                                      {
                                                        origins: [origin], 
                                                        destinations: [latlng], 
                                                        travelMode: google.maps.TravelMode.DRIVING,
                                                      
                                                      }, function(response, status){

                                                        if (status == google.maps.DistanceMatrixStatus.OK) {
                                                            var origins = response.originAddresses;
                                                            var destinations = response.destinationAddresses;

                                                            for (var i = 0; i < origins.length; i++) {
                                                                var results = response.rows[i].elements;
                                                                for (var j = 0; j < results.length; j++) {
                                                                    var element = results[j];
                                                                    var distance = element.distance.text;
                                                                    thedistance = element.distance.text;
                                                                    var duration = element.duration.text;
                                                                    var from_point = origins[i];
                                                                    var to_point = destinations[j];
                                                                }
                                                                document.getElementById("distance").value = thedistance;
                                                                console.log(thedistance);
                                                               
                                                            }
                                                            
                                                                
                                                        }
                                                    });
                                                  
                                                }
                                            );

                                           

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