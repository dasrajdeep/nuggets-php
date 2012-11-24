function nfLoader(element) {
	this.element=element;
	this.count=0;
	this.colors=['#c7c7c7','#d7d7d7','#e7e7e7','#f7f7f7'];
	this.size='30px';
	this.stopped=false;
	
	this.render=function() {
		var elem=$(this.element);
		var html='<table class="nfLoader" align="center"><tr><td name="0"></td><td name="1"></td></tr><tr><td name="3"></td><td name="2"></td></tr></table>';
		elem.html(html);
		$(this.element+' td').css({width:this.size,height:this.size,padding:'0px',margin:'0px',border:'none','border-radius':'0px'});
	}
	
	this.destroy=function() {
		if(!this.stopped) this.stopped=true;
		else $(element+' table').remove();
		return true;
	}
	
	this.animate=function() {
		if(this.stopped) return this.destroy();
		this.count=(this.count+1)%4;
		for(var i=0;i<4;i++) {
			var pos=(this.count+i)%4;
			$(this.element+' td[name='+pos+']').css({'background-color':this.colors[i]});
		}
		var _this=this;
		setTimeout(function() {_this.animate();},100);
	}
	
	this.show=function() {
		this.stopped=false;
		this.render();
		this.animate();
	}
	
	this.hide=function() {
		this.destroy();
	}
}
