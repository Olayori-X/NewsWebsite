var articleinfo;

function getarticle(){
    fetch("getarticles.php")
    .then(response => response.json())
    .then(data => {
        articleinfo = data;
        // console.log(articleinfo[1]);
        listarticle(articleinfo);
    })
}

function listarticle(info){
    var table = "<table class = 'table table-bordered'><tr><td>Headline</td><td>Category</td></tr>";
    for(var i = 0; i < info.length; i++){
        table += "<tr><td><a href= 'shownewsdetails.php?id=" + info[i].id + "' style = 'color: black;'>" + info[i].title + "</a><p><a href = 'editnewsdetails.php?id=" + info[i].id + "'>Edit</a> <span> <a href = 'deletenews.php?id=" + info[i].id + "'>Bin</a></span></p></td><td><a href = '#'>" + info[i].category + "</a></td></tr>";
    }

    table += "</table>";
    document.getElementById("articles").innerHTML= table;
}