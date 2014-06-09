<!DOCTYPE html>
<html lang=”en”>
    <head>
        <meta charset="UTF-8" />
        <link
            type="text/css"
            rel="stylesheet"
            href="/css/layout.css" />
        <link type="text/css"
              rel="stylesheet"
              href="/css/redactor.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src="/js/redactor.min.js"></script>
        <title>
            Opstart project
        </title>
    </head>
    <body>
        @yield("javascript")
        @yield("css")
        @include("header")
        <div class="content">
            <div class="container">
                @yield("content")
            </div>
        </div>
        @include("footer")
    </body>
</html>