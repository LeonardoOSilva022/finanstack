angular
  .module("meuApp")
  .controller("HomeController", function ($scope, $state, $http) {
    // Aqui você pode adicionar qualquer lógica necessária para a página inicial.
    $scope.message = "Página inicial carregada com sucesso!";

    $token = localStorage.getItem("token");

    $config = {
      headers: {
        Authorization: "Bearer " + $token,
      },
    };

    $scope.transacoes = {
      ia: "",
    };

    $scope.transacoes.ia = "Gastei 50.00 comendo";

    $scope.simularIa = function () {
      palavras = $scope.transacoes.ia.split(" ");
      console.log(palavras);

      if (palavras.length != 3) {
        alert("erro");
        return;
      }

      tipoPalavras = "debito";

      if (palavras[0] == "recebi") {
        tipoPalavras = "credito";
      }

      transacao = {
        nome: palavras[2],
        valor: palavras[1],
        tipo: tipoPalavras,
      };


      // $http.post(URL,dados,config).then(function(response){},function(error){});


      $http
        .post("http://localhost:8000/api/transacoes", transacao, $config)
        .then(function (response) {
          // Se o login for bem-sucedido, você pode redirecionar para outra página
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
