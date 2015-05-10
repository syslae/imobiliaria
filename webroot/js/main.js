/*
 * Tooltip script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 


this.tooltip = function(){	
	/* CONFIG */		
		xOffsett = 10;
		yOffsett = 20;		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result		
	/* END CONFIG */		
	$("a.tooltip").hover(function(e){											  
		this.t = this.title;
		this.title = "";									  
		$("body").append("<p id='tooltip'>"+ this.t +"</p>");
		$("#tooltip")
			.css("top",(e.pageY - xOffsett) + "px")
			.css("left",(e.pageX + yOffsett) + "px")
			.fadeIn("slow");
    },
	function(){
		this.title = this.t;		
		$("#tooltip").remove();
    });	
	$("a.tooltip").mousemove(function(e){
		$("#tooltip")
			.css("top",(e.pageY - xOffsett) + "px")
			.css("left",(e.pageX + yOffsett) + "px");
	});			
};



// starting the script on page load
$(document).ready(function(){
	tooltip();
});

/*
 * Image preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.imagePreview = function(){	
	/* CONFIG */
		
		xOffsetp = 10;
		yOffsetp = 30;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.preview").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='preview'><img src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");								 
		$("#preview")
			.css("top",(e.pageY - xOffsetp) + "px")
			.css("left",(e.pageX + yOffsetp) + "px")
			.fadeIn("slow");		
    },
	function(){
		this.title = this.t;	
		$("#preview").remove();
    });	
	$("a.preview").mousemove(function(e){
		$("#preview")
			.css("top",(e.pageY - xOffsetp) + "px")
			.css("left",(e.pageX + yOffsetp) + "px");
	});			
};


// starting the script on page load
$(document).ready(function(){
	imagePreview();
});

/*
 * Url preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.screenshotPreview = function(){	
	/* CONFIG */
		
		xOffsets = 10;
		yOffsets = 30;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.screenshot").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='screenshot'><img src='"+ this.rel +"' alt='url preview' />"+ c +"</p>");								 
		$("#screenshot")
			.css("top",(e.pageY - xOffsets) + "px")
			.css("left",(e.pageX + yOffsets) + "px")
			.fadeIn("slow");	
    },
	function(){
		this.title = this.t;	
		$("#screenshot").remove();
    });	
	$("a.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffsets) + "px")
			.css("left",(e.pageX + yOffsets) + "px");
	});			
};


// starting the script on page load
$(document).ready(function(){
	screenshotPreview();
});

 $(document).ready(function(){
       
	   //verificaConversa();
	  // atualizaListaProfessoresLogados()
  });

/*function atualizaListaProfessoresLogados()
{
	$.ajax({
			method: "get",url: "ajax/carrega_professores_online.php",
			dataType: "html",
			success: function(html){ 
				$('#professores_logados').html('');					
				$('#professores_logados').html(html);					
		 }
	 }); //close $.ajax(
	 setTimeout('atualizaListaProfessoresLogados()', 30000);
}*/


function verificaConversa()
{
	$.ajax({
			method: "get",url: "ajax/verificaConversa.php",
			dataType: "html",
			success: function(html){ 
				//alert(html);
				$('#pop_up').html(html);	
		 }
	 }); //close $.ajax(
	 setTimeout('verificaConversa()', 30000);
}

/*
 * tooltips script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
  


