function controller ($scope, $timeout, $http) {
    var code;
    var qs;
    var term;
    var testCaseEditors = [];

    // Register all the editors
    $timeout(function () {
        code = ace.edit('code');
        code.setTheme("ace/theme/monokai");
        code.getSession().setMode("ace/mode/c_cpp");

        qs = ace.edit('question');
        qs.setTheme("ace/theme/monokai");
        qs.getSession().setMode("ace/mode/text");

        term = ace.edit('terminal');
        term.setTheme("ace/theme/monokai");
        term.getSession().setMode("ace/mode/text");

        var testCaseInputs = document.querySelectorAll('.test-case-input-editor');
        var testCaseOutputs = document.querySelectorAll('.test-case-output-editor');
        for (var i = 0; i < testCaseInputs.length; i++) {
            var inputEditor = ace.edit(testCaseInputs[i]);
            inputEditor.setTheme('ace/theme/monokai');
            inputEditor.getSession().setMode('ace/mode/text');

            var outputEditor = ace.edit(testCaseOutputs[i]);
            outputEditor.setTheme('ace/theme/monokai');
            outputEditor.getSession().setMode('ace/mode/text');

            var testCase = {
                input: inputEditor,
                output: outputEditor
            };
            testCaseEditors.push(testCase);
        }
    }, 0, false);

    // Call resize when resized
    $scope.$on('resized', function (event) {
        $timeout(function () {
            code.resize();
            qs.resize();
            term.resize();
        }, 0, false);
    });

    // Send the code and test cases
    $scope.run = function () {
        let writtenCode = code.getValue();
        let testCases = [];

        for (let i = 0; i < testCaseEditors.length; i++) {
            let input = testCaseEditors[i].input.getValue();
            let output = testCaseEditors[i].output.getValue();

            if (input === "" && output === "") continue;

            testCases.push({
                input: input,
                output: output
            });
        }

        $http.post('/compile', {
            code: writtenCode,
            testCases: testCases
        }).then(function (resp) {
            console.log(resp.data);
            term.setValue(resp.data.terminalOut);
        }, function () {
            console.log('Compile Failed');
        });
    };
}

controller.$inject = ['$scope', '$timeout', '$http'];

module.exports = controller;
