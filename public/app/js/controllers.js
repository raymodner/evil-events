var controllerModule = angular.module('app.controllers',[]);


controllerModule.controller("LoginController", function($scope, $location, AuthenticationService) {
  $scope.credentials = { email: "", password: "" };

  $scope.login = function() {
    AuthenticationService.login($scope.credentials).success(function() {
      $location.path('/home');
    });
  };
});

controllerModule.controller("BooksController", function($scope, books) {
  $scope.books = books.data;
});

controllerModule.controller("HomeController", function($scope, $location, AuthenticationService) {
  $scope.title = "Awesome Home";
  $scope.message = "Mouse Over these images to see a directive at work!";

  $scope.logout = function() {
    AuthenticationService.logout().success(function() {
      $location.path('/login');
    });
  };
});