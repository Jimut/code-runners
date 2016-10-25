function controller ($scope, $timeout) {
    var code;
    var qs;
    var term;
    var testCaseEditors = [];

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

    $scope.$on('resized', function (event) {
        $timeout(function () {
            code.resize();
            qs.resize();
            term.resize();
        }, 0, false);
    });
}

controller.$inject = ['$scope', '$timeout'];

module.exports = controller;
