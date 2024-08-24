function initialize() {
    const locationInputs = document.getElementsByClassName("map-input");

    const autocompletes = [];
    const geocoder = new google.maps.Geocoder;

    // Initialize autocomplete for address field
    const addressInput = document.getElementById('address');
    const addressAutocomplete = new google.maps.places.Autocomplete(addressInput);
    addressAutocomplete.setFields(['address_components', 'geometry']);

    const map = new google.maps.Map(document.getElementById('address-map'), {
        center: {lat: -33.8688, lng: 151.2195},
        zoom: 13
    });
    const marker = new google.maps.Marker({
        map: map,
        position: {lat: -33.8688, lng: 151.2195},
    });
    marker.setVisible(false);

    // Event listener for place changed
    google.maps.event.addListener(addressAutocomplete, 'place_changed', function () {
        marker.setVisible(false);
        const place = addressAutocomplete.getPlace();

        if (!place.geometry) {
            window.alert("No details available for input: '" + place.name + "'");
            addressInput.value = "";
            return;
        }

        const lat = place.geometry.location.lat();
        const lng = place.geometry.location.lng();

        setLocationCoordinates('address', lat, lng);

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        // Auto-fill address fields
        const addressComponents = place.address_components;
        addressComponents.forEach(component => {
            const types = component.types;
            if (types.includes('locality')) {
                document.getElementById('city').value = component.long_name;
            }
            if (types.includes('administrative_area_level_1')) {
                document.getElementById('state').value = component.long_name;
            }
            if (types.includes('country')) {
                document.getElementById('country').value = component.long_name;
            }
            if (types.includes('postal_code')) {
                document.getElementById('post_code').value = component.long_name;
            }
        });
    });

    function setLocationCoordinates(key, lat, lng) {
        const latitudeField = document.getElementById(key + "-latitude");
        const longitudeField = document.getElementById(key + "-longitude");
        latitudeField.value = lat;
        longitudeField.value = lng;
    }
}
