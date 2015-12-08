// Morris.js Charts sample data for SB Admin template

$(function() {
    // Donut Chart
    $.ajax({
        type : 'post',
        url : 'chartdata.php',  
        data :  {
            chart_type: 'pi'
        },
        success : function(r) {
            //$("#latlong").html(r);
            var obj = JSON.parse(r);
            //console.debug(obj);
            var chartData = [];
            for(var key in obj) {
                chartData.push({label: obj[key]['description'], value: parseInt(obj[key]['crimes'])});
            }
            console.debug(chartData);
            Morris.Donut({
                element: 'morris-donut-chart',
                data: chartData,
                resize: true
            });
        }
    });
    // Line Chart
    $.ajax({
        type : 'post',
        url : 'chartdata.php',  
        data :  {
            chart_type: 'line'
        },
        success : function(r) {
            //$("#latlong").html(r);
            var obj = JSON.parse(r);
            //console.debug(obj);
            var chartData = [];
            for(var key in obj) {
                chartData.push({d: obj[key]['y'] + "-" + obj[key]['m'] + "-" + obj[key]['d'], crimes: parseInt(obj[key]['crimes'])});
            }
            Morris.Line({
                // ID of the element in which to draw the chart.
                element: 'morris-line-chart',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: chartData,
                // The name of the data record attribute that contains x-visitss.
                xkey: 'd',
                // A list of names of data record attributes that contain y-visitss.
                ykeys: ['crimes'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Crimes'],
                // Disables line smoothing
                smooth: true,
                resize: true
            });
        }
    });
});
