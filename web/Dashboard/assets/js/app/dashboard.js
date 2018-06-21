var server = "http://localhost/droplet";
var api = server+"/api/v1";
function updateCurrentStatus(id) {
    $.ajax({
        type: 'get',
        url: api+'/devices/'+id+'/summary',
        dataType: 'json',
        success: function (data) {
            $('#val-usage-today').text(data["usage"]["day"]+" L");
            $('#val-usage-month').text(data["usage"]["month"]+" L");
            $('#val-remaining-level').text(data["level"]["volume"]+" L");
            let percentage = data["level"]["percentage"];
            let dataPreferences = {
                labels: [percentage+'%', (100-percentage)+'%'],
                series: [percentage, (100-percentage)]
            };
            let optionsPreferences = {
                donut: true,
                donutWidth: 40,
                startAngle: 0,
                total: 100,
                showLabel: false,
                axisX: {
                    showGrid: false
                }
            };
            Chartist.Pie('#chartWaterLevel', dataPreferences);
        }

    });
}