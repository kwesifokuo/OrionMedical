<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <style>
    body {
      margin-top:0.5in;
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      font-size: 13px;
      line-height:1.4em;
      font-weight:bold;
    }
    #ticket {
      background-image:url('/images/eticket-bg.png');
      background-size:contain;
      width:8.0in;
      height:5.0in;
      background-repeat:no-repeat;
      position:relative;
    }
    #logo {
      height:auto;
      max-width:4.3in;
      position:relative;
      left:0.3in;
      top:0.3in;
    }
    #event-info {
      display:inline-block;
      position:absolute;
      left:0.3in;
      top:1.65in;
      width:4.3in;
    }
    .label {
      color:#768690;
      display:block;
      text-transform:uppercase;
    }
    .value {
      display:block;
      color:#121212;
      text-transform:uppercase;
      overflow:hidden;
      font-size:16px;
    }
    #title {
      height:1.0in;
    }
    #patient {
      height:0.8in;
      margin-top:0.25in;
    }
    #event-date {
        margin-top:0.225in;
        height:0.7in;
    }
    #start_at {
        position:relative;
        left:0.4in;
        font-size:12px;
    }
    #end_at {
        position:relative;
        left:0.3in;
        top:0.033in;
        font-size:12px;
    }
    #stub-info {
      display:inline-block;
      position:absolute;
      top:0.06in;
      left:4.9in;
      width:2.8in;
      text-align:center;
    }
    #purchased-on {
      display:inline-block;
      text-transform:uppercase;
      font-size:8px;
      text-align:center;
      width:100%;
      position:relative;
      top:0.02in;
    }
    #qrcode {
      display:inline-block;
      position:relative;
      top:0.3in;
      height:2in;
    }
    #ticket-num {
      display:inline-block;
      text-transform:uppercase;
      text-align:center;
      width:100%;
      position:relative;
      top:0.36in;
      font-weight:normal;
    }
    #attendee-info {
      text-align:left;
      font-size:10px;
      position:relative;
      top:1in;
      left:0.1in;
    }
    #attendee-info .value {
        font-size:12px;
        height:0.4in;
    }
    #notes {
      margin-top:0.3in;
      width:8in;
    }
    #notes span.value {
        font-size:20px;
    }
    #notes hr {
      margin-bottom:0.2in;
    }
    #notes pre {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      color:#121212;
      font-weight:normal;
      font-size:16px;
      word-wrap: break-word;
    }
  </style>
</head>
<body>
  <div id="ticket">
    <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($patient->id, 'QRCODE')}}" alt="barcode" /> 
    <div id="event-info">
      <span id="title" class="value">{{ $patient->title }}</span>

       <span id="patient" class="value">{{ $patient->name }}</span>

      <div id="event-date">
        <span id="start_at" class="value">{{ $patient->start_time->format('jS \o\f F, Y g:i:s a') }}</span>
        <span id="end_at" class="value">{{ $patient->start_time->format('jS \o\f F, Y g:i:s a') }}</span>
      </div>
    </div>
    <div id="stub-info">
      <span id="purchased-on">{{ $patient->doctor }}</span>
       <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($patient->id, 'QRCODE')}}" alt="barcode" /> 
      <span id="ticket-num" class="value">#{{ $patient->id }}</span>
      <div id="attendee-info">
        <span id="email" class="value">{{ $patient->name }}</span>
        <span id="name" class="value">{{ $patient->title }}</span>
        <span id="" class="value">{{ $patient->start_time->format('jS \o\f F, Y g:i:s a') }}</span>
      </div>
    </div>
  </div>


  <div id="notes">
    <hr/>
   <!--  <span class="value">NOTES / INSTRUCTIONS</span>
    <pre>{{ $patient->care_provider }}</pre> -->
  </div>

</body>
</html>