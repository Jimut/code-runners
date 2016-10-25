@extends('layouts.app')

@section('body')
<body class="devenv" ng-controller="DevEnvController">

    <header class="main-header main-header--de">
        <a href="/" class="logo">CodeRunner</a>
        <nav class="nav-left">
            <a href="#" class="nav-item">Dashboard</a>
            <a href="#" class="nav-item">League</a>
        </nav>
        <nav class="nav-right">
            <div class="dropdown">
                <div class="profile-nav dropdown-toggle" data-toggle="dropdown">
                    <img src="images/face.jpg" height="16px" width="16px">
                    <span>John Doe</span>
                    <span class="caret"></span>
                </div>
                <ul class="profile-nav-menu dropdown-menu">
                    <li><a href="#">Your profile</a></li>
                    <li><a href="#">Your questions</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Sign out</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="content content--de">
        <section class="workspace">
            <section class="pane-container"
                     ng-controller="EditorController">
                <ul class="nav nav-tabs nav-tabs--de">
                    <li class="active"><a href="#code" data-toggle="tab">Code</a></li>
                    <li><a href="#question" data-toggle="tab">Question</a></li>
                </ul>
                <div class="tab-content tab-content--de">
                    <div id="code" class="tab-pane active editor"></div>
                    <div id="question" class="tab-pane editor"></div>
                </div>
            </section>
            <section class="pane-container pane-container--collapsible"
                     ng-controller="TerminalController">
                <ul class="nav nav-tabs nav-tabs--de">
                    <li class="active"><a href="#" ng-click="toggle()">Terminal</a></li>
                </ul>
                <div class="tab-content tab-content--de">
                    <div id="terminal" class="editor" ng-show="isOpen()" style="height: 200px"></div>
                </div>
            </section>
        </section>
        <section class="panel panel--de" ng-controller="PanelController">
            <div class="panel-header">Test Cases</div>
            <div class="test-case-container">
                <div class="test-case" ng-repeat="testCase in testCases" ng-cloak>
                    <div class="test-case-header">
                        <div class="test-case-header__name">Test Case @{{ $index + 1 }}</div>
                        <div class="test-case-header__options">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                            <span class="glyphicon glyphicon-remove"></span>
                        </div>
                    </div>
                    <div class="test-case-editor-container">
                        <div class="test-case-input-box">
                            <div class="test-case-input-header">Input</div>
                            <div class="test-case-input-editor"></div>
                        </div>
                        <div class="test-case-output-box">
                            <div class="test-case-output-header">Output</div>
                            <div class="test-case-output-editor"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="main-footer main-footer--de">
        <div class="footer-block-left">
            <span>No Issues</span>
            <span>Saved</span>
        </div>
        <div class="footer-block-right">
            <span>Monokai</span>
            <span>14 px</span>
            <span>2 Spaces</span>
            <span>GCC</span>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/ace/ace.js" type="text/javascript"></script>
    <script src="js/app.js"></script>

</body>
@endsection
