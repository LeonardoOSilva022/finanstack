angular
  .module("meuApp", ["ui.router"])

  .config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise("/login");

    $stateProvider
      .state("login", {
        url: "/login",
        templateUrl: "js/views/login.html",
        controller: "LoginController",
      })

      .state("home", {
        url: "/home",
        templateUrl: "js/views/home.html",
        controller: "HomeController",
      })

      .state("transacoes", {
        url: "/transacoes",
        templateUrl: "js/views/transacoes.html",
        controller: "TransacoesController",
      });
  });
