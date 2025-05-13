angular
  .module("meuApp")
  .controller("LoginController", function ($scope, $state, $http) {
    console.log("abriu");

    $scope.login = function () {
      const credentials = {
        email: $scope.email,
        password: $scope.password,
      };

      // Realizando a requisição de login diretamente no controlador
      $http
        .post("http://localhost:8000/api/auth/login", credentials)
        .then(function (response) {
          // Se o login for bem-sucedido, você pode redirecionar para outra página
          localStorage.setItem("token", response.data.access_token);
          console.log(response);
          $state.go("home"); // Ou qualquer outra página após o login bem-sucedido
        })
        .catch(function (error) {
          // Se o login falhar, exibe uma mensagem de erro
          console.log(error);
          $scope.error = "Email ou senha incorretos";
        });
    };
  });
