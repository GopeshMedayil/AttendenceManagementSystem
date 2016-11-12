var app = angular.module('starter.services', []);

app.factory('Chats', function () {
  // Might use a resource here that returns a JSON array

  // Some fake testing data
  var chats = [{
    id: 0,
    name: 'Ben Sparrow',
    lastText: 'You on your way?',
    face: 'img/ben.png'
  }, {
    id: 1,
    name: 'Max Lynx',
    lastText: 'Hey, it\'s me',
    face: 'img/max.png'
  }, {
    id: 2,
    name: 'Adam Bradleyson',
    lastText: 'I should buy a boat',
    face: 'img/adam.jpg'
  }, {
    id: 3,
    name: 'Perry Governor',
    lastText: 'Look at my mukluks!',
    face: 'img/perry.png'
  }, {
    id: 4,
    name: 'Mike Harrington',
    lastText: 'This is wicked good ice cream.',
    face: 'img/mike.png'
  }];

  return {
    all: function () {
      return chats;
    },
    remove: function (chat) {
      chats.splice(chats.indexOf(chat), 1);
    },
    get: function (chatId) {
      for (var i = 0; i < chats.length; i++) {
        if (chats[i].id === parseInt(chatId)) {
          return chats[i];
        }
      }
      return null;
    }
  };
});


app.factory('loginService', function ($http, $q) {
  var profileDetails;
  return {
    sendLogin: function (loginDetails) {
      var deferred = $q.defer();
      $http({
        method: 'GET',
        url: 'http://app.elixirerp.com/api/login.php?username='+loginDetails.username+'&password='+loginDetails.password,
        data: loginDetails,
        dataType: 'json',
      }).then(function successCallback(response) {
        deferred.resolve(response);
      }, function errorCallback(response) {
        deferred.reject(response);
      });
      return deferred.promise;
    },
    setProfileDetails: function (userDetails) {
      profileDetails = userDetails;
    },
    getProfileDetails: function () {
      return profileDetails;
    }
  }

});


app.factory('notificationService', function ($http, $q) {

  return {
    getNotification: function (branchCode) {
      var deferred = $q.defer();
      $http({
        method: 'GET',
        url: 'http://app.elixirerp.com/api/notification.php?branchCode='+branchCode,
        dataType: 'json',
      }).then(function successCallback(response) {
        deferred.resolve(response);
      }, function errorCallback(response) {
        deferred.reject(response);
      });
      return deferred.promise;
    },
    get: function (chatId) {
      for (var i = 0; i < chats.length; i++) {
        if (chats[i].id === parseInt(chatId)) {
          return chats[i];
        }
      }
      return null;
    }    
  }

});

// app.factory('httpResponseErrorInterceptor', function ($q, $injector) {
//   return {
//     'responseError': function (response) {
//       if (response.status === 0) {
//         // should retry
//         var $http = $injector.get('$http');
//         return $http(response.config);
//       }
//       // give up
//       return $q.reject(response);
//     }
//   };
// });
