function searchSermons() {
    let q = document.getElementById('search').value;

    fetch("search.php?q=" + q)
        .then(res => res.text())
        .then(data => {
            document.getElementById('results').innerHTML = data;
        });
}
