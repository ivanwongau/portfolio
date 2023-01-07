/*
 Template Name: Zoter - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File:Dashboard init js
 */

!function($) {
    "use strict";

    var Dashboard = function() {};

    Dashboard.prototype.init = function () {
        
        

        /* Calender */
        window.addEventListener('load', function () {
			vanillaCalendar.init({
            disablePastDays: true
            });
        })
    },
    $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard

}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.Dashboard.init()
}(window.jQuery);

