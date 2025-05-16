angular
  .module("meuApp")
  .controller("TransacoesController", function ($scope, $state, $http) {
    $token = localStorage.getItem("token");

    $config = {
      headers: {
        Authorization: "Bearer " + $token,
      },
    };

    zerarCampos = function () {
      $scope.transacao = {
        nome: "",
        valor: "",
        tipo: "debito",
      };
    };
    zerarCampos();

    $scope.registrar = function () {
      $http
        .post("http://localhost:8000/api/transacoes", $scope.transacao, $config)
        .then(function (response) {
          if (response.status == 201) {
            zerarCampos();

            let timerInterval;
            Swal.fire({
              title: "Registrado!",
              html: "",
              icon: "success",
              timer: 500,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                  timer.textContent = `${Swal.getTimerLeft()}`;
                }, 100);
              },
              willClose: () => {
                clearInterval(timerInterval);
              },
            }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {
              }
            });
          }
        })
        .catch(function (error) {});
    };
  });
