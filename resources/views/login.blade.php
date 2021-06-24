<!DOCTYPE html>
<html>
@php 
{{
    //dd(env('FB_APP_ID'));
}}
@endphp
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script>
            $(function(){

                window.fbAsyncInit = function() {
                    FB.init({
                        appId      : '817707895553386',
                        cookie     : true,
                        xfbml      : true,
                        version    : 'v11.0'
                        });         
                    };
                    (function(d, s, id){
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) {return;}
                        js = d.createElement(s); js.id = id;
                        js.src = "https://connect.facebook.net/en_US/all.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
 
                function checkLoginState() {
                    FB.getLoginStatus(function(response) {
                        statusChangeCallback(response);
                    });
                }





                let httpRequest = new XMLHttpRequest();
                let accessToken= null;
                let userID=null;

                $("#fb-logout").click(function(){
                    console.log("logging out")
                    FB.getLoginStatus(function(response) {
                    if (response.status === 'connected') {
                            FB.logout(function(response) {
                                // this part just clears the $_SESSION var
                                // replace with your own code
                                    console.log("logged out")
                                $('#status').text('Logged out');
                            });
                        }
                    });
                });

                $("#fb-page").click(function(){
                    FB.getLoginStatus(function(response) {
                        if (response.status === 'connected') {
                            accessToken=response.authResponse.accessToken;
                            userID= response.authResponse.userID;
                            console.log(accessToken, userID);
                            FB.api(`/${userID}/accounts`, function(response){
                                // console.log(response);
                                let page_array = [];
                                page_array=response.data;
                            })
                        }
                    });
                });

                function is_connected(response){
                    accessToken=response.authResponse.accessToken;
                    userID= response.authResponse.userID;
                    console.log(accessToken, userID);
                    FB.api(`/${userID}/accounts`, function(response){
                        // console.log(response);
                        let page_array = [];
                        page_array=response.data;
                        page_array.forEach(element => {
                            $("#page-id").append(new Option(element.name, element.id));
                        });
                    })

                    // let app_id = "817707895553386"
                    // let app_secret = "8b1de0ecb898c3c35e391f9bf64dcc63"
                    // let api_endpoint = `${userID}/accounts`

                    // //get user app access token 
                    // httpRequest.open( "GET",`"https://graph.facebook.com/oauth/access_token?client_id=${app_id}&client_secret=${app_secret}&grant_type=client_credentials"`)
                    // httpRequest.send();

                    // //fetch page ID list that user manage
                    // console.log( `https://graph.facebook.com/${api_endpoint}&access_token=${accessToken}`);
                    // httpRequest.open( "GET",`https://graph.facebook.com/${api_endpoint}&access_token=${accessToken}`)
                    // httpRequest.send();
                }

                $("#fb-login").click(function(){
                    console.log("feawef");
                    FB.getLoginStatus(function(response) {
                        if (response.status === 'connected') {
                            is_connected(response);
                        }
                        else {
                            FB.login(function(response){
                                if(response.status === 'connected'){
                                    is_connected(response)
                                }
                            });
                        }
                    });
                })

                httpRequest.onreadystatechange = function(response){
                    console.log(response);
                }
            }
            );
         </script>
         <style>

         </style>
    </head>
    <body>

    <div id="fb-root"></div>
        <!-- <script async defer crossorigin="anonymous" 
        src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0&appId=817707895553386&autoLogAppEvents=1" 
        nonce="nIgFaJ4K"></script>

        <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>
        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
        </fb:login-button> -->
        <div class="container" >
            <button id="fb-login">Login Here</button>
            <button id="fb-logout">Logout Here</button>
            <button id="fb-page">Get Page List</button>
            <span id="status"/>
            <span id="message"/>
            <button>Add whitelist domain</button>
        </div>
        <form>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label> Availabe Page</label>
                        <select class="form-control form-control-sm"" id="page-id" >
                            <option>fawefaef</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>

    </body>
</html>