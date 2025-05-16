angular
  .module("meuApp")
  .controller("RelatoriosController", function ($scope, $state, $http) {
    $token = localStorage.getItem("token");

    $config = {
      headers: {
        Authorization: "Bearer " + $token,
      },
    };

    $scope.resposta = [];
    $scope.balanco = [];

    lerTodas = function () {
      $http
        .get("http://localhost:8000/api/transacoes", $config)
        .then(function (response) {
          if (response.status == 200) {
            $scope.resposta = response.data;
          }
        })
        .catch(function (error) {});
    };

    lerBalanco = function () {
      $http
        .get("http://localhost:8000/api/transacoes/balanco", $config)
        .then(function (response) {
          if (response.status == 200) {
            $scope.balanco = response.data;
          }
        })
        .catch(function (error) {});
    };

    lerTodas();
    lerBalanco();
  });
