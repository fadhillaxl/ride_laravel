<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Box with Autocomplete</title>
    <style>
        .search-box {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .suggestions {
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 4px 4px;
            max-height: 150px;
            overflow-y: auto;
        }
        .suggestion {
            padding: 10px;
            cursor: pointer;
        }
        .suggestion:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <input type="text" id="searchBox" class="search-box" placeholder="Search for a place...">
    <div id="suggestions" class="suggestions"></div>

    <script>


        document.getElementById('searchBox').addEventListener('keyup', function() {

            const query = this.value;
            if (query.length > 2) {
                fetch(`/autocomplete?q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(response);

                        const suggestionsBox = document.getElementById('suggestions');
                        suggestionsBox.innerHTML = '';
                        data.forEach(place => {
                            const suggestion = document.createElement('div');
                            suggestion.className = 'suggestion';
                            suggestion.textContent = place.display_name;
                            suggestion.addEventListener('click', () => {
                                document.getElementById('searchBox').value = place.display_name;
                                suggestionsBox.innerHTML = '';
                            });
                            suggestionsBox.appendChild(suggestion);
                        });
                    });
            } else {
                document.getElementById('suggestions').innerHTML = '';
            }
        });
    </script>
</body>
</html>
