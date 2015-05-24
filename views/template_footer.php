</section>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/js/bootstrap.min.js"></script>
<script>
   (function($){
      var recapQuestion = $('.question-recap');
      $('#see-more').on('click', function(e){
         e.preventDefault();
         console.log(recapQuestion.hasClass('seen'));
         if(!recapQuestion.hasClass('h-auto')){
            recapQuestion.addClass('h-auto');
            $(this).text('See Less');
         }

         else if(recapQuestion.hasClass('h-auto')){
            recapQuestion.removeClass('h-auto');
            $(this).text('See More ...');
         }
      });
   })(jQuery);

</script>
</body>
</html>