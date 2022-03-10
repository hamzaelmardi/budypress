 (function($) {
  $(document).ready(function () {
   
    $('#Theme').change( function() { 
       $('#STheme').empty()
       var term_id = $(this).val();  

        $.ajax({
          url: ajaxurl,
          type: "POST",
          data: {'action': 'theme_intra' ,'term_id':term_id},
           beforeSend: function() {
             $('#SousTheme').css('display', 'none');
       $('.loading-form').css('display', 'block');
       jQuery('.buddypress_test').css('pointer-events','none')

    },
          success:function(result){
              var obj = JSON.parse(result);
              obj.forEach(function(val,i){
                $('#STheme').append('<option value='+val.term_id+'>'+val.name+'</option>')
                 
              })
               $('#SousTheme').css('display', 'block');
              $('.loading-form').css('display', 'none');
       jQuery('.buddypress_test').css('pointer-events','auto')
            
          },
          error: function(result){
            console.log('error');
             $('.loading-form').css('display', 'none');
             jQuery('.buddypress_test').css('pointer-events','auto')
  }
        })});
  });
})(jQuery);
