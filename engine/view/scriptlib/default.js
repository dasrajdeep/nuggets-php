function post(cmd,params,loader_id,callback) {
    $('#'+loader_id).show();
    var paramset="";
    for(var i=0;i<params.length;i++) paramset+="/"+Base64.encode(params[i]);
    var query=domain+cmd+paramset;
    $.post(query,{},function(data){
        $('#'+loader_id).hide();
        callback(data);
    });
}

var poll_time;
var poll_command;
var poll_callback;
function startPolling(time,command,callback) {
    poll_time=time;
    poll_command=command;
    poll_callback=callback;
    poll();
}

function poll() {
    $.get(domain+poll_command,{},function(data){
        poll_callback(data);
    });
    setTimeout("poll()",poll_time);
}