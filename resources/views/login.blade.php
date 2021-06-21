<!DOCTYPE html>
<html>
    <head>
        <script>
        window.fbAsyncInit = function() {
            FB.init({
            appId      : '819787645577614',
            cookie     : true,
            xfbml      : true,
            version    : '1.0.0'
            });
            
            FB.AppEvents.logPageView();   
            
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // FB.getLoginStatus(function(response) {
        //     statusChangeCallback(response);
        // });

        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }
        </script>
    </head>
    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" 
            src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0" nonce="BgLqn8GT">
        </script>
        <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" 
            data-layout="default" data-auto-logout-link="false" data-use-continue-as="false">
        </div>

        <fb:login-button 
            scope="public_profile,email"
            onlogin="checkLoginState();">
        </fb:login-button>


    </body>
</html>