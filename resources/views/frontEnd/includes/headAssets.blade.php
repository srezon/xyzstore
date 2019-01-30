<link href="{{asset('public/frontEnd/css')}}/bootstrap.css" rel='stylesheet' type='text/css'/>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('public/frontEnd/js')}}/jquery.min.js"></script>
<!-- Custom Theme files -->
<link href="{{asset('public/frontEnd/css')}}/style.css" rel='stylesheet' type='text/css'/>
<!-- Custom Theme files -->
<script type="application/x-javascript"> addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);
    function hideURLbar() {
        window.scrollTo(0, 1);
    } </script>
<!----start - smoth - scrolling---->
<script type="text/javascript" src="{{asset('public/frontEnd/js')}}/easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
        });
    });
</script>
<!---- start-smoth-scrolling---->
<!----- webfonts ------>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic|Open+Sans:300italic,600italic,400,300,600,700'
      rel='stylesheet' type='text/css'>
<!----- webfonts ------>
<!----start-top-nav-script---->
<script>
    $(function () {
        var pull = $('#pull');
        menu = $('nav ul');
        menuHeight = menu.height();
        $(pull).on('click', function (e) {
            e.preventDefault();
            menu.slideToggle();
        });
        $(window).resize(function () {
            var w = $(window).width();
            if (w > 320 && menu.is(':hidden')) {
                menu.removeAttr('style');
            }
        });
    });
</script>
<!----//End-top-nav-script---->
    