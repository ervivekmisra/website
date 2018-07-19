$(document).ready(function(){

  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
	  
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
	//alert(stars);
   
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
     var idi=$(this).parent().find('input');
		var id=idi.val();
		
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
	alert("imageid "+id+"rating"+ratingValue);
    responseMessage(msg);
    ajaxrating(id,ratingValue);
  });
  
  
});


function responseMessage(msg) {
  $('success-box').fadeIn(200);  
  //alert(msg);
    $('success-box div.text-message').html("<span>" + msg + "</span>");
}
function ajaxrating(id,ratingValue){
var data={'user_images_id':id,
'rating':ratingValue
};
console.log(data);
var url='http://surfcloud.com.br/ratings/profile/rate';
    $.ajax({
           type: "POST",
           url: url,
           data: data , // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           },
		   error:function(data)
           {
               alert(data); // show response from the php script.
           }
         });

};
$(document).ready(function() {
    var $lightbox = $('#lightbox');
    
    $('[data-target="#lightbox"]').on('click', function(event) {
		
		
        var $img = $(this).find('img'), 
            src = $img.attr('src'),
            alt = $img.attr('alt'),
            css = {
                'maxWidth': $(window).width() - 100,
                'maxHeight': $(window).height() - 200
            };
    
        $lightbox.find('.close').addClass('hidden');
        $lightbox.find('img').attr('src', src);
        $lightbox.find('img').attr('alt', alt);
        $lightbox.find('img').css(css);
    });
    
    $lightbox.on('shown.bs.modal', function (e) {
        var $img = $lightbox.find('img');
          
        $lightbox.find('.modal-dialog').css({'width': $img.width()});
        $lightbox.find('.close').removeClass('hidden');
    });
});
/* $(document).ready(function() {
	alert('here') ;
$('.app').on('click', function(){
	  var staring = $(this).val();
	  alert(staring) ; 

});
}); */