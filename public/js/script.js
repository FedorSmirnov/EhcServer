// joba 20112013
// jquery main function after page is loaded
$(document).ready(function() {
        var isiPad = navigator.userAgent.match(/iPad/i) != null;
        if (isiPad){
                // move all lights more to the right;
                jQuery('#light_kitchen_one').css('right','600px');
                jQuery('#light_kitchen_two').css('right','580px');
                jQuery('#light_bathroom_one').css('right','630px');
                jQuery('#light_bathroom_two').css('right','610px');
                jQuery('#light_living_one').css('right','320px');
                jQuery('#light_living_two').css('right','300px');
        } else {
                // do nothing
        }

        // show-hide divs
        $('.show_hide').showHide({
    		speed: 1000,  // speed you want the toggle to happen
    		easing: '',  // the animation effect you want. Remove this line if you dont want an effect and if you haven't included jQuery UI
    		changeText: 1, // if you dont want the button text to change, set this to 0
    		showText: 'Aufklappen',// the button text to show when a div is closed
    		hideText: 'Zuklappen' // the button text to show when a div is open
        });
           
});

