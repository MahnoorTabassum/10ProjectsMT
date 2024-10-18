window.onload = function () {
    const detectLocationBtn = document.getElementById('detect-location');
    const locationMessage = document.getElementById('location-message');
    const manualLocationForm = document.getElementById('manual-location-form');

    // Auto-detect location
    detectLocationBtn.addEventListener('click', () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error);
        } else {
            locationMessage.innerText = 'Geolocation is not supported by this browser.';
        }
    });

    // Manual location input if user doesn't allow geolocation
    function error() {
        locationMessage.innerText = 'Unable to retrieve your location. Please enter it manually.';
        manualLocationForm.style.display = 'block';
    }

    function success(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        locationMessage.innerText = `Latitude: ${latitude}, Longitude: ${longitude}`;
        fetchPrayerTimes(latitude, longitude);
    }

    function fetchPrayerTimes(lat, long) {
        fetch(`getPrayerTimes.php?lat=${lat}&long=${long}`)
            .then(response => response.json())
            .then(data => {
                const prayerTimes = data.data.timings;
                const prayerTimesDiv = document.getElementById('prayer-times');
                prayerTimesDiv.innerHTML = '';

                for (let prayer in prayerTimes) {
                    prayerTimesDiv.innerHTML += `<div class="time-box">
                        <span class="prayer-name">${prayer}</span>
                        <span class="prayer-time">${prayerTimes[prayer]}</span>
                    </div>`;
                }
            });
    }
};
