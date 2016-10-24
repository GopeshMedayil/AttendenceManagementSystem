angular.module('starter.controllers', [])

  .controller('DashCtrl', function ($scope, loginService) {
    $scope.profileDetails = loginService.getProfileDetails();

  })

  .controller('ChatsCtrl', function ($scope, Chats) {
    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    //
    $scope.$on('$ionicView.enter', function (e) {
      $scope.fun = function () {
        alert("llll")
      }
    });


    $scope.chats = Chats.all();
    $scope.remove = function (chat) {
      Chats.remove(chat);
    };
  })

  .controller('loginCtrl', function ($scope, $state, $location, loginService, $ionicLoading) {
    //$scope.chat = Chats.get($stateParams.chatId);
    var roleTypeId;

    $scope.login = function (data) {
      $ionicLoading.show({
        content: 'Loading',
        animation: 'fade-in',
        showBackdrop: true,
        maxWidth: 200,
        showDelay: 0
      });
      loginService.sendLogin(data).then(function (response) {
        if (response.data) {
          $ionicLoading.hide();
          loginService.setProfileDetails(response.data);
          $scope.roleRoute(response.data.roleTypeId);

        }
      }, function () {
        $ionicLoading.hide();

      })
      // $location.path("tab/dash");
      console.log("Test", data);
    };

    $scope.roleRoute = function (roleTypeId) {
      if (roleTypeId) {
        // if (roleTypeId == 1) {
        $state.go('tab.dash');
        // }
      }
    }


  })

  .controller('ChatDetailCtrl', function ($scope, $stateParams, Chats) {
    $scope.chat = Chats.get($stateParams.chatId);
  })

  .controller('AccountCtrl', function ($scope, $state, $location, $timeout, $ionicPopup, $rootScope, $ionicHistory, loginService) {

    $scope.name = "Gopesh";
    $scope.$on('$stateChangeSuccess', function (ev, to, toParams, from, fromParams) {
      //assign the "from" parameter to something
      console.log("From", from)
    });
    $scope.$on('$ionicView.enter', function (e) {
      var confirmPopup = $ionicPopup.confirm({
        title: 'Logout',
        template: 'Are you sure to logout?'
      });

      confirmPopup.then(function (res) {
        if (res) {
          $location.path("/login");
        } else {
          $location.path("tab/dash");
        }
      });

    });
    // $timeout(function () {
    //   $scope.$apply(function () {
    //     $location.path("/login");

    //   })
    // })

  });
