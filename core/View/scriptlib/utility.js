var nf=nf || {};

nf.prototype.get=function(cmd,params,callback,loader_id) {
    if(loader_id) $('#'+loader_id).show();
    var paramset='';
    for(var i in params) paramset+='/'+i+'='+params[i];
    var query=hosturl+cmd+paramset;
    $.get(query,{},function(data){
        if(loader_id) $('#'+loader_id).hide();
        callback(data);
    });
}

nf.prototype.post=function(cmd,params,callback,loader_id) {
	if(loader_id) $('#'+loader_id).show();
	$.post(hosturl+cmd,params,function(data) {
		if(loader_id) $('#'+loader_id).hide();
		callback(data);
	});
}

nf.prototype.load=function(selector,cmd,params,loader_id) {
	this.get(cmd,params,function(data) {
		$(selector).html(data);
	},loader_id);
}

nf.prototype.base64Encode=function(data) {
	return Base64.encode(data);
}

nf.prototype.base64Decode=function(data) {
	return Base64.decode(data);
}