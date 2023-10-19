function get(data, ID) {
    var option = "<table><tr><th>Activity</th></tr>";
    for(var i = 0; i < data.length; i++){
        option += "<tr><td>" + data[i].activity + " at " + data[i].time + "</td></tr>";
    }
    option += "</table>";
    ID.innerHTML = option;

    var recentactivity = "<table><tr><th>Recent Activity</th></tr>";
    for(var i = data.length - 3; i < data.length; i++){
        recentactivity += "<tr><td>" + data[i].activity + " at " + data[i].time + "</td></tr>";
    }
    recentactivity += "</table>";

    document.getElementById('recentactivity').innerHTML= recentactivity;
}