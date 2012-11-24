var nf=nf || {};

nf.get=function(cmd,params,callback,loader_id) {
    if(loader_id) $('#'+loader_id).show();
    var paramset='';
    for(var i in params) paramset+='/'+i+'='+params[i];
    var query=hosturl+cmd+paramset;
    $.get(query,{},function(data){
        if(loader_id) $('#'+loader_id).hide();
        callback(data);
    });
}

nf.post=function(cmd,params,callback,loader_id) {
	if(loader_id) $('#'+loader_id).show();
	$.post(hosturl+cmd,params,function(data) {
		if(loader_id) $('#'+loader_id).hide();
		callback(data);
	});
}

nf.load=function(selector,cmd,params,loader_id) {
	this.get(cmd,params,function(data) {
		$(selector).html(data);
	},loader_id);
}

nf.base64Encode=function(data) {
	return Base64.encode(data);
}

nf.base64Decode=function(data) {
	return Base64.decode(data);
}
