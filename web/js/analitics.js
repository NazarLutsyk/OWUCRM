function getColors(count) {
    let color = "";
    let colors = [];
    for (let i = 0; i < count; i++) {
        color = "";
        color = "rgb(" + Math.floor((Math.random() * 255)).toString() + "," +
            Math.floor((Math.random() * 255)).toString() + "," +
            Math.floor((Math.random() * 255)).toString() + ")";
        colors.push(color);
    }
    return colors;
}

function getStat(url, method, contentType, params, cb) {
    $.ajax({
        url: url,
        method: method,
        contentType: contentType,
        data: JSON.stringify(params),
        success: function (stats) {
            console.log(stats);
            cb(stats);
        }
    });
}

function printGraphic(stats, label, elId) {
    let labels = [];
    let counts = [];
    for (let stat of stats) {
        labels.push(stat.name);
        counts.push(Number.parseInt(stat.count));
    }
    let barChartData = {
        labels: labels,
        datasets: [{
            label: label,
            backgroundColor: getColors(stats.length),
            borderColor: "rgb(255,255,255)",
            borderWidth: 1,
            data: counts
        }]
    };

    let ctx = document.getElementById(elId).getContext("2d");
    if (window.myBar != undefined)
        window.myBar.destroy();
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Chart'
            }
        }
    });
    window.myBar.update();
}

$("#selectByPeriod").click(function (e) {
    let params = {
        startDate: $("input[name='startDate']").val(),
        endDate: $("input[name='endDate']").val(),
        socials: $("#sources").val()
    };
    getStat('/admin/rest/get-stat-by-socials', 'POST', 'application/json', params, function (stats) {
        printGraphic(stats,'Socials','socialStat');
    });
});

$("#selectAppsStat").click(function () {
    let params = {
        startDate: $("input[name='start']").val(),
        endDate: $("input[name='end']").val(),
        courses: $("#courses").val()
    };
    console.log(params);
    getStat('/admin/rest/get-stat-by-courses','POST','application/json',params,function (stats) {
        printGraphic(stats,'Courses','coursesStat');
    });
});

$("#selectFreeCoursesStat").click(function () {
    let params = {
        // startDate: $("input[name='start2']").val(),
        // endDate: $("input[name='end2']").val(),
        courses: $("#freeCourses").val()
    };
    console.log(params);
    getStat('/admin/rest/get-stat-by-free-courses','POST','application/json',params,function (stats) {
        printGraphic(stats,'Free Courses','freeCoursesStat');
    });
});
