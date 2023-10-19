function get(info, ID) {
    var table = "<table class = 'table table-bordered'><tr><th>Headline</th><th>Category</th><th>Reporter</th><th>Month</th><th>Year</th></tr>";
    for(var i = 0; i < info.length; i++){
        table += "<tr><td><a href= 'shownewsdetails.php?id=" + info[i].id + "' style = 'color: black;'>" + info[i].title + "</a><p><a href = 'editnewsdetails.php?id=" + info[i].id + "'>Edit</a> <span> <a href = 'deletenews.php?id=" + info[i].id + "'>Bin</a></span></p></td><td><a href = 'selectedcategory.php?category=" + info[i].category + "'>" + info[i].category + "</a></td><td><a href = 'selectedreporter.php?reporter="+ info[i].reporter + "'>" + info[i].reporter + "</a></td><td><a href = '#'>" + info[i].month + "</a></td><td><a href = '#'>" + info[i].year + "</a></td></tr>";
    }
    ID.innerHTML = table;
}


function listarticle(info){
    var table = "<table class = 'table table-bordered'><tr><th>Headline</th><th>Category</th><th>Reporter</th><th>Month</th><th>Year</th></tr>";
    for(var i = 0; i < info.length; i++){
        table += "<tr><td><a href= 'shownewsdetails.php?id=" + info[i].id + "' style = 'color: black;'>" + info[i].title + "</a><p><a href = 'editnewsdetails.php?id=" + info[i].id + "'>Edit</a> <span> <a href = 'deletenews.php?id=" + info[i].id + "'>Bin</a></span></p></td><td><a href = '#'>" + info[i].category + "</a></td><td><a href = '#'>" + info[i].reporter + "</a></td><td><a href = '#'>" + info[i].month + "</a></td><td><a href = '#'>" + info[i].year + "</a></td></tr>";
    }

    table += "</table>";
    document.getElementById("articles").innerHTML= table;
}