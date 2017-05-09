$(document).ready(function(){
	var canvas_pdf_JQ = $('#canvas');
	var canvas = document.getElementById('canvas'),
    ctx = canvas.getContext('2d'),
    rect = {},
    drag = false;


	var imageObj = new Image();
	imageObj.src = canvas_pdf_JQ.attr("cv_url");

	height = imageObj.height;
	width = imageObj.width;

	ctx.canvas.width = width;
	ctx.canvas.height = height;

	/**
	  *	Fonction pour redimensionner l'image de façon proportionnelle
	  */
	canvas_pdf_JQ.each(function() {
        var maxWidth = 1000; // Max width for the image
        var maxHeight = 1000;    // Max height for the image
        var ratio = 0;  // Used for aspect ratio
        var width = $(this).width();    // Current image width
        var height = $(this).height();  // Current image height

        // Check if the current width is larger than the max
        if(width > maxWidth){
            ratio = maxWidth / width;   // get ratio for scaling image
            $(this).css("width", maxWidth); // Set new width
            $(this).css("height", height * ratio);  // Scale height based on ratio
            height = height * ratio;    // Reset height to match scaled image
            width = width * ratio;    // Reset width to match scaled image
        }

        // Check if current height is larger than max
        if(height > maxHeight){
            ratio = maxHeight / height; // get ratio for scaling image
            $(this).css("height", maxHeight);   // Set new height
            $(this).css("width", width * ratio);    // Scale width based on ratio
            width = width * ratio;    // Reset width to match scaled image
            height = height * ratio;    // Reset height to match scaled image
        }
    });

	/**
	  *	On upload l'image dans le canvas
	  */
	imageObj.onload = function() {
		ctx.drawImage(imageObj, 0, 0, imageObj.width,    imageObj.height,     // source rectangle
                   				0, 0, canvas.width, canvas.height); // destination rectangle
	};


	/*********************************************************************************************************************
		Début création de rectangles sur le canvas
	*********************************************************************************************************************/
	/*function init() {
		  canvas.addEventListener('mousedown', mouseDown, false);
		  canvas.addEventListener('mouseup', mouseUp, false);
		  canvas.addEventListener('mousemove', mouseMove, false);
		}

		function mouseDown(e) {
		  rect.startX = e.pageX - this.offsetLeft;
		  rect.startY = e.pageY - this.offsetTop;
		  drag = true;
		}

		function mouseUp() {
		  drag = false;
		}

	function mouseMove(e) {
	  if (drag) {
	    rect.w = (e.pageX - this.offsetLeft) - rect.startX;
	    rect.h = (e.pageY - this.offsetTop) - rect.startY ;
	    //ctx.clearRect(0,0,canvas.width,canvas.height);
	    draw();
	  }
	}

	function draw() {
	  ctx.fillRect(rect.startX, rect.startY, rect.w, rect.h);
	}

	init();*/
});

