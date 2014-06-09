<!doctype html>
<html lang="en" ng-app="app">
<head>
  <meta charset="UTF-8">
  <title>AngularJS AuthenticationService Example</title>
  <link rel="stylesheet" href="/app/css/normalize.css">
  <link rel="stylesheet" href="/app/css/foundation.min.css">
  <link rel="stylesheet" href="/app/css/style.css">
  <script src="/app/js/angular.js"></script>
  <script src="/app/lib/angular/angular-sanitize.min.js"></script>
  <script src="/app/js/underscore.js"></script>
  <script src="/app/js/app.js"></script>
  <script src="/app/js/controllers.js"></script>
  <script src="/app/js/directives.js"></script>
  <script src="/app/js/services.js"></script>

  <script>
    angular.module("app").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
  </script>
</head>
<body>

  <div class="row">
    <div class="large-12">
      <h1>End to End with Angular JS</h1>
      <div class="row">
        <div class="large-6 large-offset-3">
          <div id="flash" class="alert-box alert" ng-show="flash">
            {{ flash }}
          </div>
        </div>
      </div>
      <div id="view" ng-view></div>
    </div>
  </div>

</body>
</html>
