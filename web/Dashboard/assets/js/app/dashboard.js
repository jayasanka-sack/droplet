var server = "http://localhost/droplet";
var api = server+"/api/v1";
function getCurrentStatus(id) {
    $.ajax({
        type: 'get',
        url: api+'/devices/'+id+'/summary',
        dataType: 'json',
        success: function (data) {
            $('#val-usage-today').text(data["usage"]["day"]+" L");
            $('#val-usage-month').text(data["usage"]["month"]+" L");
        }

    });
}