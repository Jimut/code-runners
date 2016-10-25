function controller ($scope, $rootScope) {
    var state = true;

    $scope.toggle = function () {
        state = !state;

        $rootScope.$broadcast('resized');
    };

    $scope.isOpen = function () {        
        return state;
    };
}

controller.$inject = ['$scope', '$rootScope'];

module.exports = controller;
