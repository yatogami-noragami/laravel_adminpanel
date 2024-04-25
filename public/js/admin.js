$(document).ready(function () {


    // Image Preview
    const input = $('.imageInput');
    const previewImage = $('#photoPreview');

    input.on('change', function () {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.attr('src', e.target.result);
            previewImage.css('display', 'block');
        };

        reader.readAsDataURL(input[0].files[0]);
    });

    // Back To Top Button
    function handleScrollDown() {
        $('#backToTopBtn').css('animation', 'bttShow 2s ease-out forwards');
    }

    $(window).scroll(function () {

        if ($(this).scrollTop() > 500) {
            handleScrollDown();
        }

    });

    $('#backToTopBtn').click(function (e) {
        $('html, body').animate({ scrollTop: 0 }, 400);
        setTimeout(() => {
            $(this).css('animation', 'bttHide 2s ease-out forwards')
        }, 3000);
        return false;
    });

    $('#backToTopBtn').hover(function () {
        $('#backToTopBtn i').css('animation-duration', '300ms');

    }, function () {
        $('#backToTopBtn i').css('animation-duration', '1s');
    }
    );

    // CKE Editor
    ClassicEditor
        .create(document.querySelector('#editor'), {
            removePlugins: ['paragraph'],
        })
        .catch(error => {
            console.log(error);
        });


    // Leaflet Map
    var map = L.map('map').setView([16.7781, 96.1408], 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {
        foo: 'bar', attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map)

    var marker = L.marker([16.7781, 96.1408], {
        draggable: true
    }).addTo(map);

    marker.on('dragend', function (event) {
        var marker = event.target;
        var position = marker.getLatLng();

        marker.bindPopup(position.toString()).openPopup();

        const latitude = position.lat;
        const longitude = position.lng;
        const apiKey = 'dccf96fbedbf49f3b7a56d8f7cc5d56a';

        reverseGeocode(latitude, longitude, apiKey)
            .then((result) => {
                if (result) {
                    $('#itemOwnerAddress').prop('value', result);
                } else {
                    console.log('Reverse Geocoding failed.');
                }
            })
            .catch((error) => {
                console.error('An error occurred:', error.message);
            });
    });

    async function reverseGeocode(lat, lng, apiKey) {

        const apiUrl = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lng}&key=${apiKey}`;

        try {

            const response = await fetch(apiUrl);
            const data = await response.json();

            if (response.ok) {

                const formattedAddress = data.results[0].formatted;


                return formattedAddress;
            } else {
                console.error(`Error: ${data.status.message}`);
                return null;
            }
        } catch (error) {
            console.error('An error occurred while fetching data from OpenCage API:', error.message);
            return null;
        }
    }





});
