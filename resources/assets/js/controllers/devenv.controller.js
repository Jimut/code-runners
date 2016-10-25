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

        var testCases = document.querySelectorAll('.test-case-text');
        for (var i = 0; i < testCases.length; i++) {
            var editor = ace.edit(testCases[i]);
            editor.setTheme('ace/theme/monokai');
            editor.getSession().setMode('ace/mode/text');
            testCaseEditors.push(editor);
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
