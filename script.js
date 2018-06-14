function Controller($scope, $http) {
  $scope.getInfo = function() {
    $scope.compAndLoc = false;
    $scope.compOrLoc = false;
    $scope.bio = false;
    $scope.webSite = false;
    $scope.userNotFound = false;
    $scope.noUser = true;
    $scope.userFound = false;
    $http
      .get("https://api.github.com/users/" + $scope.username)
      .success(function(data) {
        if (data.name == "") data.name = data.login;
        if (data.company != null || data.location != null)
          $scope.compOrLoc = true;
        if (data.bio == "") $scope.bio = true;
        if (data.blog == "") $scope.webSite = true;
        $scope.user = data;
        $scope.userFound = true;
      })
      .error(function() {
        $scope.userNotFound = true;
      });
  };
}
