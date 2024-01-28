<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        .text-center {
            text-align: center;
        }
        #map {
            width: '100%';
            height: 500px;
        }
    </style>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
</head>

<body>
    <h1 class='text-center'>Report View Map</h1>
    <div id='map'></div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>    
    <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
    <script>
        let map, markers = [];
        /* ----------------------------- Initialize Map ----------------------------- */
        function initMap() {
            map = L.map('map', {
                center: {
                    lat: 106.626137,
                    lng: -6.1596,
                },
                zoom: 17
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);
            map.on('click', mapClicked);
            initMarkers();
        }
        initMap();

        /* --------------------------- Initialize Markers --------------------------- */
        function initMarkers() {
           
            var initialMarkers = '<?php echo json_encode($initialMarkers); ?>';
                $.each(JSON.parse(initialMarkers),function(key,val){
                    const marker = generateMarker(val,key);
                    marker.addTo(map).bindPopup(`<b>${val.name} in locate(${val.position.lat},  ${val.position.lng})</b>`);
                    map.panTo([val.position.lng,val.position.lat]);
                    markers.push(marker)
                    console.log(val.position);
                })
        }
        
        function generateMarker(data, index) {
            return L.marker([data.position.lng,data.position.lat], {
                    draggable: data.draggable
                })
                .on('click', (event) => markerClicked(event, index))
                .on('dragend', (event) => markerDragEnd(event, index));
        }
       
        /* ------------------------- Handle Map Click Event ------------------------- */
        function mapClicked($event) {
            console.log(map);
            console.log($event.latlng.lat, $event.latlng.lng);
        }

        /* ------------------------ Handle Marker Click Event ----------------------- */
        function markerClicked($event, index) {
            console.log(map);
            console.log($event.latlng.lat, $event.latlng.lng);
        }

        /* ----------------------- Handle Marker DragEnd Event ---------------------- */
        function markerDragEnd($event, index) {
            console.log(map);
            console.log($event.target.getLatLng());
        }

        // const geocoder = L.Control.Geocoder.nominatim();
        //     geocoder.reverse(
        //         { lat: -6.147147786842642, lng: 106.59101307392122 },
        //         map.getZoom(),
        //         (results) => {
        //             if(results.length) {
        //                 console.log("formatted_address", results[0].name)
        //                 // console.log("formatted_address", results)
        //             }
        //         }
        //     );
        // L.Control.geocoder().addTo(map);
        // console.log(geocoder)
           
    </script>
</body>

</html>
