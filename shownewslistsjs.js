function get(data, ID) {
    var option = "";
    for(var i = 0; i < data.length; i++){
        option += "<a href = 'shownewsdetails.php?id=" + data[i]['id'] + "'><div class='col-md-4'><div class='card mb-4' style = 'width: 400px; height: 400px;'><div class='card-body' style = 'background-image: url(admin/"+ data[i]['image'] + "); background-position: center center; background-size: contain'>" + data[i]['title'] + "</div></div></div></a>";
        console.log("admin/" + data[i]['image']);
    }
    ID.innerHTML = option;
}
