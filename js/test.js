//alert("hello");

$(document).ready(function(){
	
	//alert("bye");
	
	
	/*var callback = function(data) { 
      if (data == 0) {
        alert(data);
      }
    }
	
	
	 $('input:text[name=title]').on('blur', function() {
        // on blur, if there is no value, set the defaultText
		$.get('modify/test', 'rid=' + $(this).val(), callback);
     });*/
	 
	 
    $.ajax({
      type: "POST",
      cache: false,
      url: Drupal.settings.statistics.url,
      data: Drupal.settings.statistics.data
    });
  


});