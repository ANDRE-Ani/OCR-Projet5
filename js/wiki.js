$.ajax({
    type: "GET",
    url: "https://simple.wikipedia.org/w/api.php?action=query&generator=random&grnnamespace=0&prop=extracts&exsentences=10&format=json&callback=?",
    contentType: "application/json; charset=utf-8",
    async: false,
    dataType: "json",
    success: function(data) {
        var pages = data.query.pages;
        var text = pages[Object.keys(pages)[0]].extract;
        document.getElementById('wiki').innerHTML = text;
    },
    error: function(errorMessage) {}
});