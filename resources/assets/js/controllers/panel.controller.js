function controller ($scope) {
    $scope.testCases = ['tc1', 'tc2', 'tc3', 'tc4'];
}

controller.$inject = ['$scope'];

module.exports = controller;
