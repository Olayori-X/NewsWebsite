function listcategory(info){
    var div = "<table class = 'table table-bordered'><tr><th>S/N</th><th>Category</th><tr>";
    var sn = 0;
    for(var j = 0; j < info.length; j++){
        sn += 1;
        div += "<td>" + sn + "</td><td><a href = 'selectedcategory.php?category=" + info[j] + "'>" + info[j] + "</a></td></tr>";
    }
    div += "</table>";

    document.getElementById("categories").innerHTML = div;
}

function listreporter(info){
    var div = "<table class = 'table table-bordered'><tr><th>S/N</th><th>Category</th><tr>";
    var sn = 0;
    for(var j = 0; j < info.length; j++){
        sn += 1;
        div += "<td>" + sn + "</td><td><a href = 'selectedreporter.php?reporter=" + info[j] + "'>" + info[j] + "</a></td></tr>";
    }
    div += "</table>";

    document.getElementById("reporters").innerHTML = div;
}