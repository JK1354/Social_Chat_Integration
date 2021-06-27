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
    let page_array=[];
    let whitelisted_domains=[]
    let currentMerchantDomain="https://abc.com.my"
    let page_access_token=null;
    let linkable=true;
    let link_action =null;

    $("#fb-logout").click(function(){
        console.log("logging out")
        FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
                FB.logout(function(response) {
                        console.log("logged out")
                    $('#status').text('Logged out');
                });
            }
        });
    });

    function is_connected(response){
        accessToken=response.authResponse.accessToken;
        userID= response.authResponse.userID;
        console.log(accessToken, userID);
        //fetch page ID
        FB.api(`/${userID}/accounts`, function(response){
            page_array=response.data;
            page_array.forEach((element,index) => {
                $("#page-id").append(new Option(element.name, index));
            });
        })
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

    $("#page-id").change(function(){
        console.log(accessToken,userID,page_array, $("#page-id option:selected").index()-1,page_array[$("#page-id option:selected").index()-1].access_token);
        page_access_token=page_array[$("#page-id option:selected").index()-1].access_token;

        FB.api('me/messenger_profile',{fields:"whitelisted_domains,greeting",access_token:page_access_token}, function(response){
            if (!response || response.error) {
                  alert("Error Please Refresh this page")
            } 
            else{
                if (response.data.length!=0 ){
                    whitelisted_domains= response.data[0].whitelisted_domains;
                    whitelisted_domains.forEach((element,index)=>{
                        //reg exp, remove the "/" at the very end of a string
                        element.replace(/\/$/,'')===currentMerchantDomain.replace(/\/$/,'')?linkable=false:''
                    })
                }
                else{
                    linkable=true //no domain available
                }
                linkable?$("#link-page").prop("disabled",false):$("#unlink-page").prop("disabled",false)
            }
        })

    });

    $("#link-page").click(function(){
        link_action=true;
        whitelisted_domains= whitelisted_domains.concat(currentMerchantDomain);
        updateWhiteListDomain(whitelisted_domains);
    });
    $("#unlink-page").click(function(){
        link_action=false;
        whitelisted_domains= whitelisted_domains.filter(function(value,index){
            return value.replace(/\/$/,'') !== currentMerchantDomain.replace(/\/$/,'')});
        updateWhiteListDomain(whitelisted_domains);
    });

    function updateWhiteListDomain(domains){
        httpRequest.open( "POST",`https://graph.facebook.com/me/messenger_profile?access_token=${page_access_token}`)
        httpRequest.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        console.log(domains);
        let body={  
            "whitelisted_domains":domains, 
        }
        httpRequest.send(JSON.stringify(body));
    }
    function httpCall(method, url,body){
        return new Promise((resolve,reject)=>{
            let call = new XMLHttpRequest();
            call.open(method, url);
            call.onload=function(){
                if(this.status>=200 && this.status < 300){
                    resolve(call.response)
                } else{
                    reject({
                        status: this.status,
                        statusText:call.statusText
                    });
                }
                call.send(body);
            }

        })
    }

    httpRequest.onreadystatechange = function(response){
        if(httpRequest.readyState === 4){
            if(link_action){
                console.log("calling")
                httpCall("get","/link/efawefawef").then(console.log(response))
            }
            else if(!link_action){
               
            }
            alert("Success")
        }
        else{
            alert("Failed")
        }
       
    }
}
);