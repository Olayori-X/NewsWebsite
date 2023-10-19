var articleinfo;

function getarticle(){
    fetch("getarticles.php")
    .then(response => response.json())
    .then(data => {
        articleinfo = data;
        console.log(articleinfo[1]);
        listarticle(articleinfo);

    })
}

function listarticle(info){
    var table = "<table class = 'table table-bordered'><tr><th>Headline</th><th>Category</th><th>Reporter</th><th>Month</th><th>Year</th></tr>";
    for(var i = 0; i < info.length; i++){
        table += "<tr><td><a href= 'shownewsdetails.php?id=" + info[i].id + "' style = 'color: black;'>" + info[i].title + "</a><p><a href = 'editnewsdetails.php?id=" + info[i].id + "'>Edit</a> <span> <a href = 'deletenews.php?id=" + info[i].id + "'>Bin</a></span></p></td><td><a href = 'selectedcategory.php?category=" + info[i].category + "'>" + info[i].category + "</a></td><td><a href = 'selectedreporter.php?reporter="+ info[i].reporter + "'>" + info[i].reporter + "</a></td><td><a href = '#'>" + info[i].month + "</a></td><td><a href = '#'>" + info[i].year + "</a></td></tr>";
    }

    table += "</table>";
    document.getElementById("articles").innerHTML= table;
}

function get(data, ID) {
    var option = "<option>Select</option>";
    for(var i = 0; i < data.length; i++){
        option += "<option>" + data[i] + "</option>";
    }
    ID.innerHTML = option;
}

function getselectedarticles(){
    let newsinfo = {
        'category' : document.getElementById('category').value,
        'reporter' : document.getElementById('reporter').value,
        'month' : document.getElementById('month').value,
        'year' : document.getElementById('year').value
    }

    fetch('getarticles.php', {
		"method" : "POST",
		"headers" : {
			"Content-Type" : "application/json; charset=utf-8"
		},
		"body" : JSON.stringify(newsinfo)
	}).then(response => response.json())
    .then(data => {
        articleinfo = data;
        console.log(articleinfo);
        listarticle(articleinfo);
	})
}