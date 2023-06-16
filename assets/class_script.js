angular.module('App', []).controller('Ctrl', function($scope) {
    $scope.addform = "true";
    $scope.del = "";
    $scope.loadedit = function(data){
        $scope.editdata = data.split("-");
    }
  });
