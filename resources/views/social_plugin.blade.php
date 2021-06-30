<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatHead</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="css/chathead/style.css" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        

    <!-- Chathead style & script -->
    <link href="css/chathead/chathead.css" rel="stylesheet">
    <script src="js/chathead/chathead.js" type="text/javascript"></script>
    {{-- <script>
        let fb_appID = {!! json_encode($data)!!};
    </script> --}}
</head>

<body>    

    <!-- Sample content -->
    <div class='content'>
        <h1> ChatHead.</h1>
        <p> Chat widget is loading, it will took around 3 seconds to load.</p>
        <p>Optimisation: BError,FE envparsing</p>
        <p> To whitelist domain:</p>
        <ul>
            <ol>Visit https://phoneserving.ddns.net/fb</ol>
            <ol>Login in with cloudsite account</ol>
            <ol>Choose available page to link</ol>
            <ol>Click Add to add current domain to whitelist</ol>
            <ol>Visit https://phoneserving.ddns.net</ol>
            <ol>Try to chat</ol>
        </ul>
    </div>

    <!-- Chathead Module -->
    <div id="chatHeadWidget">
        <div id="chatHead">
            <button id="chatToggle">
                <img src="assest/icon/chathead.png">
                <div id="chatHeadTooltips" >
                    <p>Hi there, how can we help you ?</p>
                </div>
            </button>
            <div id="chatOption" class='off'>
                <div class='chathead-item'>
                    <a target="_blank" href="https://wa.me/+60182694802?text=I'm%20interested%20in%20CloudSite%20">
                        <img class="chathead-icon" src="assest/icon/whatsapp.png" />
                    </a>
                </div>
                <div class='chathead-item'>
                    <a target="_blank" href="https://www.instagram.com/cloudsite.solution/">
                        <img class="chathead-icon" src="assest/icon/insta.png" />
                    </a>
                </div>
                <div class='chathead-item'>
                    <div id="fb-root"></div>
                    <div class="fb-customerchat" greeting_dialog_display="hide" page_id=""
                        minimized="false">
                    </div>
                </div>
            </div>
        </div>
    </div>    
     <!-- Chathead Module END -->

</body>

</html>