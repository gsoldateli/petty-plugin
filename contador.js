(function($) {
  $(document).ready(
    function(){

    $('[data-inicio]').each(function(){
      var $el = $(this);
      $el.countdown($el.data('inicio'), function(event){
          $(this).text(
            event.strftime('%D dias %H:%M:%S')
          );
      }).on('finish.countdown', function(){ 
        window.location = window.location;
      } );
    });

    $('[data-fim]').each(function(){
      var $el = $(this);
      $el.countdown($el.data('fim'), function(event){
          $(this).text(
            event.strftime('%H:%M:%S')
          );
      }).on('finish.countdown', function(){ 
        $('#video-holder').fadeOut(); 
        $('#msg-sessao-terminada').fadeIn(); 
      } );
    });    

    $(".camera__video").fitVids();
});
})(jQuery);