<style>
    #search-container {
        max-width: 400px;
        margin: 0 auto;
    }
    #search-input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }
    #search-results {
        margin-top: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        max-height: 300px;
        overflow-y: auto;
        background-color: white;
    }
    .result-item {
        cursor: pointer;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }
    .result-item:last-child {
        border-bottom: none;
    }
    .result-item:hover {
        background-color: #f0f0f0;
    }
</style>

<div class="map">
    {{-- <input type="text" id="search-input" placeholder="Search for a place"> --}}
    <div id="search-container">
        <input id="search-input" type="text" placeholder="Search for a place">
        <div id="search-results"></div>
    </div>
    <div id="map" style="height: 400px;"></div>

    <script>

let timer,
timeoutVal = 1000; // time it takes to wait for user to stop typing in ms

// pointers to our simple DOM elements
// const status = document.getElementById('status');
const typer = document.getElementById('search-input');

// detects when the user is actively typing
typer.addEventListener('keypress', handleKeyPress);
// triggers a check to see if the user is actually done typing
typer.addEventListener('keyup', handleKeyUp);

function handleKeyUp(e) {
window.clearTimeout(timer); // prevent errant multiple timeouts from being generated
timer = window.setTimeout(() => {
    searchPlaces(); // run searchPlaces() function
}, timeoutVal);
}

// when user is pressing down on keys, clear the timeout
// a keyup event always follows a keypress event so the timeout will be re-initiated there
function handleKeyPress(e) {
window.clearTimeout(timer);
// status.innerHTML = 'Typing...';
}
const searchInput = document.getElementById("search-input");
const searchResults = document.getElementById("search-results");

// searchInput.addEventListener("input", debounce(searchPlaces, 300));

function searchPlaces() {
const query = searchInput.value;
if (query.length < 3) {
    searchResults.innerHTML = "";
    return;
}

fetch(`http://tutor1.me/api/place/${encodeURIComponent(query)}`)
    .then(response => response.json())
    .then(data => {
        displayResults(data.data);
    })
    .catch(error => console.error("Error fetching places:", error));
}

function displayResults(results) {
searchResults.innerHTML = "";
results.forEach(place => {
    const div = document.createElement("div");
    div.classList.add("result-item");
    div.innerHTML = `<strong>${place.name}</strong><br>${place.address}`;
    div.addEventListener("click", () => selectPlace(place));
    searchResults.appendChild(div);
});
}

function selectPlace(place) {
searchInput.value = place.name;
searchResults.innerHTML = "";
console.log("Selected place:", place);
// You can add additional functionality here when a place is selected
}

function debounce(func, delay) {
let timeoutId;
return function (...args) {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => func.apply(this, args), delay);
};
}
    </script>

    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        // Update the click event listener
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Remove the previous marker if it exists
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }

            // Add new marker at clicked location and store it in currentMarker
            currentMarker = L.marker([lat, lng]).addTo(map)
                .bindPopup("Latitude: " + lat + "<br>Longitude: " + lng)
                .openPopup();

            // Log latitude and longitude to console
            console.log("Latitude:", lat, "Longitude:", lng);
        });
    </script>

</div>
