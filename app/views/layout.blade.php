<!DOCTYPE html>
<html lang=”en”>
    <head>
        <meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/packages/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<!--		<link rel="stylesheet" href="/packages/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />-->
<!--		<link rel="stylesheet" href="/packages/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />-->

		<link type="text/css" rel="stylesheet" href="/packages/bootstrap/css/bootstrap.min.css"/>
<!--		<link type="text/css" rel="stylesheet" href="/packages/bootstrap/css/bootstrap-responsive.min.css"/>-->

		<link type="text/css" rel="stylesheet"  href="/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="/css/redactor.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src="/js/redactor.min.js"></script>
        <script src="/packages/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/packages/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

		<!-- Add fancyBox -->
		<script type="text/javascript" src="/packages/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

		<!-- Optionally add helpers - button, thumbnail and/or media -->

<!--		<script type="text/javascript" src="/packages/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>-->
<!--		<script type="text/javascript" src="/packages/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>-->
<!---->
<!--		<script type="text/javascript" src="/packages/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>-->
        <title>
            Evil Events
        </title>
    </head>
    <body>
        @yield("javascript")
        @yield("css")
        @include("header")
        <div class="main clearfix">
			<div class="container">
				@yield("content")
			</div>
        </div>
        @include("footer")
    </body>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".fancybox").fancybox();

		});

		function submitFancyBox(event, form){
			event.preventDefault();
			var action = form.attr('action');
			$.ajax({
				type: "POST",
				data: form.serialize(),
				url: action,
				success: function(data){
					if(data.success){
						$.fancybox().close();
						$('.fancybox-inner').html(data.v);
					}else{
						$('.fancybox-inner').html(data.view);
					}

				}
			});
		}

	</script>
</html>
