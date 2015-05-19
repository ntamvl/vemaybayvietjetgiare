<div class="col-md-12 cont-grid featured-2" id="search-box-container">
  <div class="panel panel-default panel-search-box">
    <div class="panel-body">
      <?php get_template_part( 'search-box' ); ?>
    </div>
  </div>
  <br/>
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){
    $(window).resize(function() {
      // jQuery('#search-box-container').height($(window).height() - $('.navbar').outerHeight() - $('.footer').outerHeight() - 80);
      jQuery('.featured-2').height($(window).height() - 110);
    });

    $(window).trigger('resize');

    if ( $(window).height() > $('#search-box-container').outerHeight() + 60 ) {
      jQuery('.footer').addClass('enclose');
    }

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
      jQuery('.featured-2').height($(window).height() - 50);
    }

    // $('body').css('overflow', 'hidden');

  });
</script>