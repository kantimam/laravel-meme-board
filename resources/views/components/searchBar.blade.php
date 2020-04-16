<form id="searchForm">
    <input placeholder="SEARCH FOR POST" type="text" name="" id="autoComplete" tabindex="1">
</form>

<script>
    new autoComplete({
        data: {                              // Data src [Array, Function, Async] | (REQUIRED)
        src: async () => {
            // API key token
            const token = "this_is_the_API_token_number";
            // User search query
            const query = document.querySelector("#autoComplete").value;
            // Fetch External Data Source
            const source = await fetch(`https://www.food2fork.com/api/search?key=${token}&q=${query}`);
            // Format data into JSON
            const data = await source.json();
            // Return Fetched data
            return data.recipes;
        },
        key: ["title"],
        cache: false
        },
        query: {                               // Query Interceptor               | (Optional)
            manipulate: (query) => {
                return query.replace("pizza", "burger");
            }
        },
        sort: (a, b) => {                    // Sort rendered results ascendingly | (Optional)
            if (a.match < b.match) return -1;
            if (a.match > b.match) return 1;
            return 0;
        },
        placeHolder: "names or tags...",     // Place Holder text                 | (Optional)
        selector: "#autoComplete",           // Input field selector              | (Optional)
        threshold: 3,                        // Min. Chars length to start Engine | (Optional)
        debounce: 300,                       // Post duration for engine to start | (Optional)
        searchEngine: "strict",              // Search Engine type/mode           | (Optional)
        resultsList: {                       // Rendered results list object      | (Optional)
            render: true,
            container: source => {
                source.setAttribute("id", "suggestion_list");
            },
            destination: document.querySelector("#autoComplete"),
            position: "afterend",
            element: "ul"
        },
        maxResults: 5,                         // Max. number of rendered results | (Optional)
        highlight: true,                       // Highlight matching results      | (Optional)
        resultItem: {                          // Rendered result item            | (Optional)
            content: (data, source) => {
                source.innerHTML = data.match;
            },
            element: "li"
        },
        noResults: () => {                     // Action script on noResults      | (Optional)
            const result = document.createElement("li");
            result.setAttribute("class", "no_result");
            result.setAttribute("tabindex", "1");
            result.innerHTML = "No Results";
            document.querySelector("#autoComplete_list").appendChild(result);
        },
        onSelection: feedback => {             // Action script onSelection event | (Optional)
            console.log(feedback.selection.value.image_url);
        }
    });
</script>