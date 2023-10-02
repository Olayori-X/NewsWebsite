var articleinfo;

function getcategory(){
    fetch('getarticles.php')
    .then(response => response.json())
    .then(data => {
        articleinfo = data;
        listcategory(articleinfo);
    })
}

function listcategory(info){
    var categoryarray = [];
    for(var i = 0; i < info.length; i++){
        if(!(categoryarray.includes(info[i].category))){
            categoryarray.push(info[i].category);
        }
    }
    var div = "<table class = 'table table-bordered'><tr><th>S/N</th><th>Category</th><tr>";
    var sn = 0;
    for(var j = 0; j < categoryarray.length; j++){
        sn += 1;
        div += "<td>" + sn + "</td><td><a href = '#'>" + categoryarray[j] + "</a></td></tr>";
    }
    div += "</table>";

    document.getElementById("categories").innerHTML = div;
}