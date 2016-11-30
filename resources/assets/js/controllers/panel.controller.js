function controller ($scope, $rootScope) {
    $scope.testCases = [{name: 'Test Case 1'}, {name: 'Test Case 2'}, {name: 'Test Case 3'}, {name: 'Test Case 4'}];

    $rootScope.setTestCases = function (data) {
        data.testCaseOut.forEach(function (elm, index) {
            $scope.testCases[index].status = elm;
        });
    };
}

controller.$inject = ['$scope', '$rootScope'];

module.exports = controller;
