function getCurrentStatus(id) {

    $.ajax({
        type: 'get',
        url: 'http://139.59.81.23/apis/droplet/api/v1/devices/'+id+'/summary',
        dataType: 'json',
        success: function (data) {
            console.log(data);
        }

    });
}