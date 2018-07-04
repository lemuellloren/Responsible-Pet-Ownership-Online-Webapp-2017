// BASE FILE IMPORT
// @codekit-prepend '_base.js'


// PAGE FRAMEWORK COMPONENT IMPORT
// import any framework components that are used in this page only:

// PAGE FUNCTIONS
// define needed page functions here, when document.readyState === "complete":

/* if jQuery IS included in the project, use this: */

$(function() {


});

function confirmBox(title, message, callback) {
        // create your modal template    
        var modal = '<div class="reveal small" id="rpo-confirmation" data-animation-out="fade-out" data-animation-in="fade-in">'+
        '<h2>'+title+'</h2>'+
        '<p class="lead">'+message+'</p>'+
        '<div class="buttons"><button class="button btnThree radial yes" data-open="edit-profile">Yes</button>'+
        '<button class="button btnOne radial" data-open="edit-profile" data-close>No</button>'+
        '</div><button class="close-button" data-close aria-label="Close modal" type="button" autofocus>'+
        '<img src="assets/images/modal-close.png" alt="close" >'+
        '</button></div>';
        // appending new reveal modal to the page
        $('body').append(modal);
        // registergin this modal DOM as Foundation reveal    
        var confirmation = new Foundation.Reveal($('#rpo-confirmation'));
        // open
        confirmation.open();
        // listening for yes click
        $('#rpo-confirmation').find('.yes').on('click', function() {
            // close and REMOVE FROM DOM to avoid multiple binding
            confirmation.close();
            $('#rpo-confirmation').remove();
            // calling the function to process
            callback.call();
        });
        $(document).on('closed.zf.reveal', '#rpo-confirmation', function() {
            // remove from dom when closed
            $('#rpo-confirmation').remove();
        });
    }

    /* if jQuery IS NOT included in the project, use this instead: */

