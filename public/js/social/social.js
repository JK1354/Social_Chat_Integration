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


    let accessToken= null;
    let userID=null;
    let page_list=null;
    let currentMerchantDomain= "https://phoneserving.ddns.net/"
    let base_url = "https://phoneserving.ddns.net/"
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

        //parse available page list
        axios({
            method: 'post',
            url: `${base_url}api/social/user`,
            data: {
                "token":response.authResponse.accessToken,
                "id": response.authResponse.userID
            }
          }).then(function(response){
            console.log(response.data)
            page_list = response.data
            page_list.forEach((element,index)=>{
                //add page to list
                $("#page-id").append(new Option(element.name, index));
            })
          });
    }


    $("#fb-login").click(function(){
        $('#mySelect').find('option').remove()
        .end().append('<option selected disabled>text</option>')
    ;
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
        let linkable=true;
        console.log($("#page-id option:selected").val())
        page_list[parseInt($("#page-id option:selected").val())].domain_list.forEach((element,index)=>{
            element.replace(/\/$/,'')===currentMerchantDomain.replace(/\/$/,'')?linkable=false:''
            console.log(element,linkable);
        })
        if(linkable){
            $("#link-page").prop("disabled",false)
            $("#unlink-page").prop("disabled",true)
        }
        else{
            $("#link-page").prop("disabled",true)
            $("#unlink-page").prop("disabled",false)
        }               
    });

    $("#link-page").click(function(){
        axios({
            method: 'post',
            url: `${base_url}api/social/update`,
            data: {
                "token":accessToken,
                "id": userID,
                "domain_name":currentMerchantDomain,
                "remove_action":"false",
                "page_id":page_list[parseInt($("#page-id option:selected").val())].id
            }
          }).then(function(response){
            console.log(response.data.result,response)
            if(response.data.result=="success"){
                 alert("Update Success")
                 $("#link-page").prop("disabled",true)
                 $("#unlink-page").prop("disabled",false)
            }
            else{
                alert(response.data.error.message)
            }
          });
    });
    $("#unlink-page").click(function(){
        axios({
            method: 'post',
            url: `${base_url}api/social/update`,
            data: {
                "token":accessToken,
                "id": userID,
                "domain_name":currentMerchantDomain,
                "remove_action":"true",
                "page_id":page_list[parseInt($("#page-id option:selected").val())].id
            }
          }).then(function(response){
            console.log(response.data.result,response)
            if(response.data.result=="success"){
                alert("Update Success")
                $("#link-page").prop("disabled",false)
                $("#unlink-page").prop("disabled",true)
           }
           else{
               alert(response.data.error.message)
           }
          });
    });
}
);