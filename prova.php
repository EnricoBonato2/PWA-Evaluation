<!doctype html>
<html ng-app>
<head>
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
   <meta http-equiv="Content-Type" content="text/html">
   <meta charset="utf-8">
   <title>Bonato Enrico PWA Evaluation </title>
   <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
</head>

<body ng-controller="Controller">

   <div id="search" >
      <input type="text" id="username" ng-model="username" placeholder="Github username..."  >
      <a href="#" id="submit" ng-click="getInfo()">Visualizza Profilo</a>

      <div id="data" class="clearfix"></div>
   </div>
<div id="profilo">
   <div ng-show="userNotFound">
      <h1>Utente non trovato</h1>
   </div>
   <div ng-hide="noUser">
      <p>Inserire l'username per visualizzare il profilo corrispondente</p>
   </div>
   <div ng-show="userFound">
      <h1 class="info"> {{user.name}}
         <span class="smallname">(@<a href="{{user.html_url}}" target="_blank"> {{user.login}} </a>)</span>
      </h1>

         <div class="avi">
            <a href="{{ user.html_url }}" target="_blank">
               <img src="{{ user.avatar_url }}"  alt="{{ user.login }}"></a>
         </div>
         <div class="info">
         <p  nh-show="bio" class="ng-binding"> {{user.bio}}</p>
         <p  nh-show="blog"><a href="{{ user.blog }}" target="_blank">{{ user.blog }} </a></p>
         <p nh-show="compOrLoc" id="location">{{ user.company }}   {{user.location}} </p>
           </div>
   </div>
</div>
<script>
   function Controller($scope, $http) {
      $scope.getInfo = function () {
         $scope.compAndLoc = false;
         $scope.compOrLoc = false;
         $scope.bio = false;
         $scope.webSite = false;
         $scope.userNotFound = false;
         $scope.noUser= true;
         $scope.userFound = false;
         $http.get("https://api.github.com/users/" + $scope.username)
               .success(function (data) {
                  if (data.name == "") data.name = data.login;
                  if (data.company != null && data.location!=null) $scope.compAndLoc = true;
                  if (data.company != null || data.location!=null) $scope.compOrLoc = true;
                  if (data.bio == "") $scope.bio = true;
                  if (data.blog == "") $scope.webSite = true;
                  $scope.user = data;
                  $scope.userFound = true;
               })
               .error(function () {
                  $scope.userNotFound = true;
               });
      }
   }
</script>

</body>
</html>
