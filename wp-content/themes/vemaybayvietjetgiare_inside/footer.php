<div class="row footer">
  <div class="col-md-9 footer-2">
    &copy; Copyright <?php echo date("o");?>   &nbsp; <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right arrow"></i>  <span><?php bloginfo('name'); ?></span>
  </div>
  <div class="col-md-3 footer-social">
    <span class="pull-right">
      <a href="https://www.facebook.com/pages/Vemaybaygiareonlinenet/472085502944326?fref=ts" target="_blank">
        <img height="50" src="<?php echo get_stylesheet_directory_uri(); ?>/img/social/64-facebook.png" alt="ve may bay gia re online facebook icon flat">
      </a>
    </span>
    <span class="pull-right">
      <a href="https://plus.google.com/u/0/103441749640621479745" target="_blank">
        <img height="50" src="<?php echo get_stylesheet_directory_uri(); ?>/img/social/64-googleplus.png" alt="ve may bay gia re online google plus icon flat">
      </a>
    </span>
  </div>
</div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/select2.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-ui.js"></script>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/isotope.js"></script>

<script src="https://apis.google.com/js/platform.js" async defer></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63073966-3', 'auto');
  ga('send', 'pageview');

</script>

<script>
(function ($) {
	var $container = $('.grid'),
		colWidth = function () {
			var w = $container.width(),
				columnNum = 1,
				columnWidth = 0;
			if (w > 1200) {
				columnNum  = 4;
			} else if (w > 900) {
				columnNum  = 3;
			} else if (w > 600) {
				columnNum  = 2;
			} else if (w > 300) {
				columnNum  = 1;
			}
			columnWidth = Math.floor(w/columnNum);
			$container.find('.item').each(function() {
				var $item = $(this),
					multiplier_w = $item.attr('class').match(/item-w(\d)/),
					multiplier_h = $item.attr('class').match(/item-h(\d)/),
					width = multiplier_w ? columnWidth*multiplier_w[1]-10 : columnWidth-10,
					height = multiplier_h ? columnWidth*multiplier_h[1]*0.5-40 : columnWidth*0.5-40;
				$item.css({
					width: width,
					//height: height
				});
			});
			return columnWidth;
		},
		isotope = function () {
			$container.imagesLoaded( function(){
				$container.isotope({
					resizable: false,
					itemSelector: '.item',
					masonry: {
						columnWidth: colWidth(),
						gutterWidth: 20
					}
				});
			});
		};

	isotope();

	$(window).smartresize(isotope);

	//image fade
	$('.item img').hide().one("load",function(){
    	$(this).fadeIn(500);
    }).each(function(){
    	if(this.complete) $(this).trigger("load");
    });

    //tab sidebar
    $('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
}(jQuery));

$(document).ready(function(){
    var adult = document.getElementById('adult');
    var child = document.getElementById('child');
    var infant = document.getElementById('infant');
    for (var i = 1; i < 9; i++) {
      var option = document.createElement('option');
      option.value = i;
      option.text = i;
      adult.add(option);
    };
    for (var i = 0; i < 9; i++) {
      var option = document.createElement('option');
      option.value = i;
      option.text = i;
      child.add(option);
    };
    for (var i = 0; i < 9; i++) {
      var option = document.createElement('option');
      option.value = i;
      option.text = i;
      infant.add(option);
    };

    var today = new Date();

    $( ".from_date" ).datepicker({
      numberOfMonths: 2,
      showButtonPanel: false,
      clickInput:true,
      showOn: "both",
      dateFormat: "dd-mm-yy",
      defaultDate: 7,
      minDate: today,
      onClose: function(dateStr){
        if($("input[name='trip_type']:checked").val() == "roundtrip"){

          window.setTimeout(function(){
            $('.to_date').datepicker( "option", "minDate", dateStr );
            $( ".to_date" ).datepicker("setDate", setDay(dateStr, 5));
            $(".to_date").focus();
          }, 50);
        }
      },

    });
    $( ".from_date" ).datepicker("setDate", '7');

    $( ".to_date" ).datepicker({
      numberOfMonths: 2,
      showButtonPanel: false,
      showOn: "both",
      dateFormat: "dd-mm-yy",
      minDate: today,
    });
    $( ".to_date" ).datepicker("setDate", '12');

    $("input[type='radio'][name='trip_type']").change(function(){
      $( ".to_date" ).prop('disabled', false);
      if( $(this).is(":checked") ){
        var triptype = $(this).val();
        if(triptype == 'oneway'){
          $( ".to_date" ).prop('disabled', true);
        }else{
          $( ".to_date" ).datepicker("setDate", setDay($( ".from_date" ).val(), 3));
        }
      }
    });

  // For search box : END

  // Ajax call when search airport code in form search
  $.getJSON( "<?php echo get_stylesheet_directory_uri(); ?>/js/active_airports.json", function( airport_list ) {
    $(".departure-search").select2({data: airport_list});
    $(".destination-search").select2({data: airport_list});

    // begin set value for search form when search submit
    <?php if ( !empty($_GET['departure']) && !empty($_GET['destination']) ) { ?>
    $("#select2-airport-code-1").select2("val", "<?php echo $_GET['departure']; ?>");
    $("#select2-airport-code-2").select2("val", "<?php echo $_GET['destination']; ?>");
    <?php } ?>
    // end set value for search form when search submit

  });
  // End ajax call airport code

  function addDays(date,days) {
    return new Date(date.getTime() + days*24*60*60*1000);
  }
  function parseDate(input) {
    var parts = input.split('-');
    return new Date(parts[2], parts[1]-1, parts[0]); // months are 0-based
  }

  function setDay(date_string ,days){
    return addDays(new Date(Date.parse(parseDate(date_string))), days);
  }

  function closePopup(popup){
    $(popup).hide();
  }

  // jQuery('#container-iframe').height($(window).height());

  // begin set value for search form when search submit
  <?php if ( !empty($_GET['from_date']) && !empty($_GET['to_date']) ) { ?>
  $("#from_date").val("<?php echo $_GET['from_date']; ?>");
  $("#to_date").val("<?php echo $_GET['to_date']; ?>");
  $("#adult > [value='<?php echo $_GET['adult']; ?>']").attr("selected", "true");
  $("#child > [value='<?php echo $_GET['children']; ?>']").attr("selected", "true");
  $("#infant > [value='<?php echo $_GET['infant']; ?>']").attr("selected", "true");
  <?php } ?>
  // end set value for search form when search submit

});

</script>

	<?php wp_footer();?>

  </body>
</html>
