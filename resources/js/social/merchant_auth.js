// $(function(){
//     console.log("ready");
//     window.fbAsyncInit = function() {
//         FB.init({
//             appId      : '817707895553386',
//             cookie     : true,
//             xfbml      : true,
//             version    : 'v11.0'
//             });         
//         };
//         (function(d, s, id){
//             var js, fjs = d.getElementsByTagName(s)[0];
//             if (d.getElementById(id)) {return;}
//             js = d.createElement(s); js.id = id;
//             js.src = "https://connect.facebook.net/en_US/all.js";
//             fjs.parentNode.insertBefore(js, fjs);
//         }(document, 'script', 'facebook-jssdk'));

//     function checkLoginState() {
//         FB.getLoginStatus(function(response) {
//             statusChangeCallback(response);
//         });
//     }





//     let httpRequest = new XMLHttpRequest();
//     let accessToken= null;
//     let userID=null;

//     $("#fb-logout").click(function(){
//         console.log("logging out")
//         FB.getLoginStatus(function(response) {
//         if (response.status === 'connected') {
//                 FB.logout(function(response) {
//                     // this part just clears the $_SESSION var
//                     // replace with your own code
//                         console.log("logged out")
//                     $('#status').text('Logged out');
//                 });
//             }
//         });
//     });

//     $("#fb-page").click(function(){
       
//     });

//     function is_connected(response){
//         accessToken=response.authResponse.accessToken;
//         userID= response.authResponse.userID;
//         console.log(accessToken, userID);
//         FB.api(`/${userID}/accounts`, function(response){
//             // console.log(response);
//             let page_array = [];
//             page_array=response.data;
//         })

//         // let app_id = "817707895553386"
//         // let app_secret = "8b1de0ecb898c3c35e391f9bf64dcc63"
//         // let api_endpoint = `${userID}/accounts`

//         // //get user app access token 
//         // httpRequest.open( "GET",`"https://graph.facebook.com/oauth/access_token?client_id=${app_id}&client_secret=${app_secret}&grant_type=client_credentials"`)
//         // httpRequest.send();

//         // //fetch page ID list that user manage
//         // console.log( `https://graph.facebook.com/${api_endpoint}&access_token=${accessToken}`);
//         // httpRequest.open( "GET",`https://graph.facebook.com/${api_endpoint}&access_token=${accessToken}`)
//         // httpRequest.send();
//     }

//     $("#fb-login").click(function(){
//         console.log("feawef");
//         FB.getLoginStatus(function(response) {
//             if (response.status === 'connected') {
//                 is_connected(response);
//             }
//             else {
//                 FB.login(function(response){
//                     if(response.status === 'connected'){
//                         is_connected(response)
//                     }
//                 });
//             }
//         });
//     })

//     httpRequest.onreadystatechange = function(response){
//         console.log(response);
//     }
// }
// );