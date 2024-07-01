/* global prefName */
/* global addressDetail */
/* global google */
function initMap() {
    var mapElement = document.getElementById('map');
    var fullAddress = prefName + ' ' + addressDetail; // 都道府県＋住所組み合わせ
    
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': fullAddress }, function(results, status) {
        if (status === 'OK') {
            var map = new google.maps.Map(mapElement, {
                zoom: 15,
                center: results[0].geometry.location
            });

            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });

            var infoWindow = new google.maps.InfoWindow({
                content: '<div><strong>' + fullAddress + '</strong></div>'
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });

            infoWindow.open(map, marker); // マーカー,情報ウィンドウ表示
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

