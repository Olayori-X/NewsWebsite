var articleinfo;

function getarticle(){
    fetch("getarticlesview.php")
    .then(response => response.json())
    .then(data => {
        articleinfo = data;
        console.log(articleinfo);
        listarticle(articleinfo);

    })
}

// function listarticle(info){
//     var table = "<table class = 'table table-bordered'><tr><th>Headline</th><th>Category</th><th>Reporter</th><th>Month</th><th>Year</th></tr>";
//     for(var i = 0; i < info.length; i++){
//         table += "<tr><td><a href= 'shownewsdetails.php?id=" + info[i].id + "' style = 'color: black;'>" + info[i].title + "</a><p><a href = 'editnewsdetails.php?id=" + info[i].id + "'>Edit</a> <span> <a href = 'deletenews.php?id=" + info[i].id + "'>Bin</a></span></p></td><td><a href = '#'>" + info[i].category + "</a></td><td><a href = '#'>" + info[i].reporter + "</a></td><td><a href = '#'>" + info[i].month + "</a></td><td><a href = '#'>" + info[i].year + "</a></td></tr>";
//     }

//     table += "</table>";
//     // document.getElementById("articles").innerHTML= table;
// }

function listarticle(info){
    var lists = '';
    var recentnews = '';
    for(var i = 0; i < 7; i++){
        lists += "<a href = 'shownewsdetails.php?id=" + info[i].id + "'><p>" + info[i].title + "</p></a>";
    }
    document.getElementById('headlinelists').innerHTML = lists;

    for(var i = info.length - 3; i < info.length; i++){
        recentnews += "<a href = 'shownewsdetails.php?id=" + info[i].id + "'><p>" + info[i].title + "</p></a>";
    }
    document.getElementById('recentnews').innerHTML= recentnews;
}

function get(data, ID) {
    var option = "";
    for(var i = 0; i < data.length; i++){
        option +=  "<a href = 'shownewslists.php?category=" + data[i] + "'><li class='list-group-item'>" + data[i] + "</li></a>";
    }
    ID.innerHTML = option;
}