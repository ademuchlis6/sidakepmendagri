/**
Custom module for you to write your own javascript functions
**/
var Custom = function () {

    // private functions & variables

    var JSdatepicker = function() {
        if (jQuery().datepicker) {
            $('#date-picker').datepicker({
                rtl: App.isRTL(),
                autoclose: true
            });
            $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }
    }

    // public functions
    return {

        //main function
        init: function () {
            JSdatepicker();
            //initialize here something.            
        },

        //some helper function
        doSomeStuff: function () {

        }

    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();