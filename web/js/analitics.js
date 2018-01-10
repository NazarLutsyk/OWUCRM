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
};

$("#selectByPeriod").click(function () {
    let params = {
        startDate: $("input[name='startDate']").val(),
        endDate: $("input[name='endDate']").val(),
        socials: $("#sources").val()
    };
    $.ajax({
        url: "/admin/rest/get-stat-by-socials",
        method: "post",
        contentType: "application/json",
        data: JSON.stringify(params),
        success: function (stats) {
            console.log(stats);
            let labels = [];
            let counts = [];
            for (let stat of stats) {
                labels.push(stat.name);
                counts.push(Number.parseInt(stat.count));
            }
            var barChartData = {
                labels: labels,
                datasets: [{
                    label: 'Social',
                    backgroundColor: getColors(stats.length),
                    borderColor: "rgb(255,255,255)",
                    borderWidth: 1,
                    data: counts
                }]
            };

            var ctx = document.getElementById("canvas").getContext("2d");
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
    });
});

$("#selectAppsStat").click(function () {
    let params = {
        startDate:$("input[name='start']").val(),
        endDate:$("input[name='end']").val(),
        courses:$("#courses").val()
    };
    $.ajax({
        url: "/admin/rest/get-stat-by-courses",
        method: "post",
        contentType: "application/json",
        data: JSON.stringify(params),
        success: function (res) {
            let sum = 0;
            for (let number of res) {
                sum += parseInt(number.count);
            }
            let text = $("#appStatContainer").children().text(sum);
        }
    });
});