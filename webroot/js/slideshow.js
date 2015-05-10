function SlideShow() {

	this.instance = "";

	this.showOptions = function(options) {
	
		if ($(options.container) && $("fotocount").value>1) {
		
			$(options.container).style.display = (options.visible)	 ? "block":"none";
		
		} 
	
	
	}
	
	this.seek = function(type) {
	
		clearTimeout(this.instance.timeout);
		$(this.instance.iterator+this.instance.indice).style.display = "none";
		if (type==">") {
			this.instance.indice = (this.instance.indice<this.instance.length) ? ++this.instance.indice:1;
		} else if (type=="<") {		
			this.instance.indice = (this.instance.indice>1) ? --this.instance.indice:this.instance.length;
		}
		$(this.instance.iterator+this.instance.indice).style.display = "block";
				
		this.instance.timeout = setTimeout("slideshow.seek('>')",this.instance.motion);
		
	
	}
	
	this.pause = function() {
	
		clearTimeout(this.instance.timeout);
	
	}
	
	this.play = function() {
	
		this.seek(">");
	
	}
	
	this.stop = function() {
	
		clearTimeout(this.instance.timeout);
	
	}
	
	this.init = function() {
	
		this.instance = {
		
			"length":parseInt($("fotocount").value),
			"motion":"8000",
			"timeout":"",
			"indice":1,
			"iterator":"fotoplayer"
			
		};
			
		if ($("fotocount").value>1) {
			this.instance.timeout = setTimeout("slideshow.play()",this.instance.motion);
		}
		
		initDragDrop();
		
	}
	
	this.expand = function() {
		
		imgexp = ""+tags(this.instance.iterator+this.instance.indice,"img").item(0).src;
		var description = ""+tags(this.instance.iterator+this.instance.indice,"img").item(0).getAttribute("alt");
		var largura = ""+tags(this.instance.iterator+this.instance.indice,"input").item(0).value;
		var altura = ""+tags(this.instance.iterator+this.instance.indice,"input").item(1).value;
		//
		imgexp = imgexp.replace(/site_/,"");
		imgexp = imgexp.replace(/dest_/,"");		
		var image = BPCtrl.createEl("img");
		image.src = imgexp;
		BPCtrl.overlay(true);
		BPCtrl.createViewFotoExpand({width:largura,height:altura,descricao:description});
		$("viewfotoexpand").appendChild(image); 
		
	}
	
	this.close = function(obj) {
		
		document.body.removeChild(obj.parentNode);
	
	}


}

/* DRAG */

function initDragDrop() {
__dragX = 0; 
__dragY = 0; 
__dragId = ''; 
__dragging = false;
document.body.onmousedown = __dragDown;
document.body.onmousemove = __dragMove;
document.body.onmouseup = function() { __dragging = false; };
}

function __dragDown(e) {
e = e ? e : window.event;
__dragEl = document.getElementById(__dragId) || null;
var _target = document.all ? e.srcElement : e.target;
  if(!__dragEl || !(/drag/.test(_target.className))) return;
__dragX = e.clientX - __dragEl.offsetLeft;
__dragY = e.clientY - __dragEl.offsetTop;
__dragging = true;
};

function __dragMove(e) {
	if(typeof __dragging == 'undefined' || !__dragging) return;
e = e ? e : window.event;
__dragEl.style.left = (e.clientX - __dragX)+'px';
__dragEl.style.top = (e.clientY - __dragY)+'px';
};

