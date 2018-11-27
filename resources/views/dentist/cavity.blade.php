
<!doctype html>
<html>

<head>
    
    <title>Cavity Chart</title>
    <meta name="author" content="Jade Allen Cook">
    <link href="{{ asset('/cavity/style.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/cavity/html2canvas.js')}}"></script>
    <script src="{{ asset('/cavity/jquery.min.js')}}"></script>
    <script src="{{ asset('/cavity/jquery-ui.js')}}"></script>
</head>

<body>


        <div id="app">
            <!-- tops -->
            <div class="gum-num-container gum-l-container" id="top-gum-l-container">
                <div class="gum-label">L</div>
            </div>
            <div class="gum-num-container gum-f-container" id="top-gum-f-container">
                <div class="gum-label">F</div>
            </div>
            <div class="container" id="top-teeth"></div>
            <div class="container" id="bottom-teeth"></div>
            <div class="gum-num-container gum-f-container" id="bottom-gum-f-container">
                <div class="gum-label">F</div>
            </div>
            <div class="gum-num-container gum-l-container" id="bottom-gum-l-container">
                <div class="gum-label">L</div>
            </div>
            <!-- etc -->
            <div class="container" id="btn-container">
                <div class="btn" id="remove">Remove</div>
                <div class="btn" id="mand">MAND</div>
                <div class="btn" id="max">MAX</div>
                <div class="btn" id="reset">Tooth</div>
                <div class="btn" id="screw">Screw</div>
                <div class="btn" id="extraction">Extraction</div>
                <div class="btn" id="crown">Crown</div>
                <div class="btn" id="bridge">Bridge</div>
                <!-- cavity btns -->
                <div class="btn" id="clear">Clear</div>
                <div class="btn cav-btn" id="b">B/F</div>
                <div class="btn cav-btn" id="m">M</div>
                <div class="btn cav-btn" id="o">O/I</div>
                <div class="btn cav-btn" id="d">D</div>
                <div class="btn cav-btn" id="l">L</div>
                <div class="btn cav-btn" id="v">V</div>
                <!-- system btns -->
                <div class="btn" id="deselect">Deselect</div>
                <!-- beta 
                    <div class="btn" id="undo">Undo</div>
                -->
                <div class="btn" id="select-all">Select All</div>
                <div class="btn" id="red-blue"></div>
            </div>
        </div>
    
    <div id="#img-out"></div>

    <br />
    <!-- auto pushes to these ids on update -->
    <span class="input-tag">Teeth</span>
    <input type="text" id="teeth" placeholder="Teeth Data" />
    <span class="input-tag">Cavity</span>
    <input type="text" id="cavity" placeholder="Cavity Data" />
    <span class="input-tag">Gum D</span>
    <input type="text" id="gumf" placeholder="Gum F Data" />
    <span class="input-tag">Gum M</span>
    <input type="text" id="guml" placeholder="Gum L Data" />
    <button id="load-set">Load Set</button>
    <!-- outside controller btns -->
    <a id="download" download="chart.png" href="#" class="outside-ctrls">Generate Image</div>
</body>

<footer>
    <script src="{{ asset('/cavity/app.js')}}"></script>
</footer>

</html>