(($)=>{

$(document).ready(function() {

  // Sample AJAX function
  $('.clickMe').on('click', function(el){
      let someData = "Some data"
      jQuery.ajax({
          url : atelier_ajax_object.ajax_url,
          type : 'post',
          data : {
              action : 'FUNCTION_NAME',
              someData : someData,
          },
          success : function(response) {
              let returnInfo = JSON.parse(response)
              console.log(returnInfo);
          }
      });
  })
     
});


})(jQuery);