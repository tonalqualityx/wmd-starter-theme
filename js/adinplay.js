window.aiptag = window.aiptag || {cmd: []};
aiptag.cmd.display = aiptag.cmd.display || [];
aiptag.cmd.player = aiptag.cmd.player || [];

//CMP tool settings
aiptag.cmp = {
    show: true,
    position: "centered",  //centered, bottom
    button: true,
    buttonText: "Privacy settings",
    buttonPosition: "bottom-left" //bottom-left, bottom-right, bottom-center, top-left, top-right
}
aiptag.cmd.player.push(function() {
    aiptag.adplayer = new aipPlayer({
        AIP_REWARDEDNOTGRANTED: function (state)  {
            //This event is fired when a rewarded ad is:
            //timed out, empty, unsupported or closed by the user.
            //don't grand the reward here
            console.log("Rewarded ad state: " + state); //state can be: timeout, empty, unsupported or closed.
        },
        AIP_REWARDEDGRANTED: function ()  {
            // This event is called whenever a reward is granted for a rewarded ad
            if (event && "isTrusted" in event && event.isTrusted) {
                console.log("Reward Granted");
            } else {
                console.log("Something went wrong don't grant the reward");
            }
        },
        AD_WIDTH: 970,
        AD_HEIGHT: 604,
        AD_DISPLAY: 'fill', //default, fullscreen, fill, center, modal-center
        LOADING_TEXT: 'Getting Ready...',
        PREROLL_ELEM: function(){return document.getElementById('adinplay-container')},
        AIP_COMPLETE: function (state)  {
            /*******************
             ***** WARNING *****
                *******************
                Please do not remove the PREROLL_ELEM
                from the page, it will be hidden automaticly.
            */
        
            
        }
    });    
    
});

function show_videoad() {
    //check if the adslib is loaded correctly or blocked by adblockers etc.
    if (typeof aiptag.adplayer !== 'undefined') {
        aiptag.cmd.player.push(function() { aiptag.adplayer.startVideoAd(); });
      } else {
        //Adlib didnt load this could be due to an adblocker, timeout etc.
        //Please add your script here that starts the content, this usually is the same script as added in AIP_COMPLETE.
        console.log("Ad Could not be loaded, load your content here");
        aiptag.adplayer.aipConfig.AIP_COMPLETE();
    }
}
