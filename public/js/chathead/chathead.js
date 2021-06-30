
let toggle_callbell =false;

let fb_appID = null;
let base_url = "https://phoneserving.ddns.net/";

$(document).ready(function(){
    console.log(fb_appID)
    axios({
            method: 'get',
            url: `${base_url}api/merchant?id=1`
          }).then(function(response){
            console.log(response.data);
            fb_appID=response.data.app_id;
            $(".fb-customerchat").attr("page_id",response.data.page_id)
          })
    
    // Update tooltips width 
    $("#chatHeadTooltips p").css('width',$("#chatHeadTooltips p").width());
    $("#chatHeadTooltips").addClass('off');
    setTimeout(function(){$("#chatHeadTooltips").removeClass('off')},1000);
 
    // Adjust chathead item position 
    var position = 65;
    $('.chathead-item').each(function(i, obj) {
        $(obj).css('top',"-"+position+"px");
        position+=65;
    })    


    // On click chatHead button 
    $(document).on('click','#chatToggle',function(){
        $("#chatHeadTooltips").addClass('off');
        $("#chatOption").toggleClass('off');
    })


    // Fb chat box optimization 
    $(".fb-customerchat span iframe").addClass("hide-fb-dialog");
    $(document).on('mouseleave','#chatHeadWidget', function(){
        $(".fb-customerchat span iframe").addClass("hide-fb-dialog");
    });
    $(document).on( 'mouseenter','.fb_customer_chat_icon', function(){
        $(".fb-customerchat  span  iframe").removeClass("hide-fb-dialog");
    });

    
    // Initial Facebook chat widget
    window.fbAsyncInit = function() {
        FB.init({
          appId            : fb_appID,
          autoLogAppEvents : true,
          xfbml            : true,
          version          : 'v2.11'
        });
        $("#chatHeadWidget").addClass("loaded")
      };
    (function(d, s, id){
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) {return;}
          js = d.createElement(s); js.id = id;
          js.src = "https://connect.facebook.net/en_US/sdk.js";
          fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
     
});
