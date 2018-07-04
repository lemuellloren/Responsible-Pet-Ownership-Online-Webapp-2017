// BASE FRAMEWORK IMPORT
// import all global framework scripts and dependencies here:
// @codekit-prepend '../bower_components/jquery/dist/jquery.js'
//@codekit-prepend '../bower_components/foundation-sites/dist/js/foundation.js'
// @codekit-prepend 'a11ycarousel.js'


// GLOBAL FUNCTIONS
// define global functions here:

$(function() {
    // $(document).on('closed.zf.reveal', '.js-focus-back', function(){
    //     var btn = $(this).data('focus')
    //     $(btn).focus();
    // });

    /*  create account button
    *******************************/
    $(document).on('closed.zf.reveal', '#create-acct', function(){
        $('.create-acct[data-open="create-acct"]').focus();
    });
    /*  create account button
    *******************************/



    /*  change password button
    *******************************/
    $(document).on('closed.zf.reveal', '#change-pass', function(){
        $('.changepass').focus();
    });
    /*  change password button
    *******************************/


    /*  edit profile button
    *******************************/
    $(document).on('closed.zf.reveal', '#edit-profile', function(){
        $('.editprofile').focus();
    });
    /*  edit profile button
    *******************************/


    /*  test button
    *******************************/
    $(document).on('closed.zf.reveal', '#test-yourself', function(){
        $('.taketest').focus();
    });
    /*  test button
    *******************************/

     /*  message icon button
     *******************************/
     $(document).on('closed.zf.reveal', '#contact-modal', function(){
        $('.contact').focus();
    });
    /*  message icon button
    *******************************/


    /*  contact-us
    *******************************/
    $(document).on('closed.zf.reveal', '#contact-modal', function(){
        $('.btnOne[data-open="contact-modal"]').focus();
    });
    /*  contact-us
    *******************************/



    $("body, html").animate({ scrollTop: 0 }, 100);

    var currentImg = '';

    $(document).foundation();

    $('#petname').on('focusout', function(){
        if($(this).val() != ''){
            $(this).addClass('custom-control');
        }else{
            $(this).removeClass('custom-control');
        }
    });

    // search slide toggle function
    $('.search')
    .bind('click', function(event) {
        searchToggle($(this).hasClass('clicked'), $(this));
    });

    function searchToggle(thereIs, element){
       $(".search-field").toggleClass("expand-search");
       $(".input-group-button").toggleClass("expand-button");
       $(".search-field").focus();
       if(thereIs == true){
           element.removeClass('clicked');
           $('.input-group-button .search span').css('color','#FFF');
       }else{
           element.addClass('clicked');
           $('.clicked span').css('color','#F2AF00');
           $('#searchField').focus();
           setTimeout(function() {
            $('#searchField').focus();
        }, 500);
       }
   }

   $('#submenu-share').mouseover(function(){
    $('.share-link').css('color','#F2AF00');
}).mouseout(function(){
    $('.share-link').css('color','#FFF');
});

$('#submenu-search').mouseover(function(){
    $('.search-link').css('color','#F2AF00');
}).mouseout(function(){
    $('.search-link').css('color','#FFF');
});

    // end menu icon hover change
    
    // // transition modal click
    $('.sign-in, .create-acct, .contact, .taketest, .showanswer, .changepass, .editprofile, .privacy, .terms').click(function(){
        var modal = '';

        $(document).on('open.zf.reveal', '[data-reveal]', function () {
            modal = $(this);
        }); 

        setTimeout(    
            function()  
            {
                modal.find('[autofocus]').focus();   
            }, 1000);

    });

    var liParent = 'is-dropdown-submenu-parent';
    var liItem = 'is-dropdown-submenu-item';
    var searchIcon = 'ion-android-search';

    $('body').keyup(function(e) {
        $('.is-dropdown-submenu-parent').mouseover();
        var code = e.keyCode || e.which;
        if (code == '9') {
            var focused = $(':focus');
            var str = focused.attr('class');
            var liClass = [];
            console.log(focused.attr('class'));
            if(focused.attr('class') != undefined){
                liClass = str.split(" ");
            }

            if((liClass.indexOf(liParent) >= 0) || (liClass.indexOf(liItem) >= 0)){
                $('.'+liParent).find('ul.is-dropdown-submenu').css({
                    'visibility':'visible',
                    'opacity':'1'
                });
            }else{
                $('.'+liParent).find('ul.is-dropdown-submenu').removeAttr('style');
            }

            if(liClass.indexOf(searchIcon) >= 0){
                searchToggle($('.search').hasClass('clicked'), $('.search'));
                console.log('test');
            }else{
                if($('.search').hasClass('clicked')){
                 $(".search-field").toggleClass("expand-search");
                 $(".input-group-button").toggleClass("expand-button");
                 $('.search').removeClass('clicked');
                 $('.input-group-button .search span').css('color','#FFF');
             }
         }
     }

 });

    $('body').click(function(){
        $('.'+liParent).find('ul.is-dropdown-submenu').removeAttr('style');
    })

    $('body').click(function(){
        $('.'+liParent).find('ul.is-dropdown-submenu').removeAttr('style');
    });

});

function alertBox(message, type){

    var alert = '';

    if (type == 'success') {
        alert = '<div class="alert-box alert-box success callout" data-closable><div class="text">'+message+'</div><button class="close-button-alert" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';
    }
    else if (type == 'error') {
        alert = '<div class="alert-box alert-box alert callout" data-closable><div class="text">'+message+'</div><button class="close-button-alert" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';

    }

    return alert;
}

function autoHide(reload, url){
    setTimeout(    
        function()  
        {
            $('.alert-box').addClass('visible').fadeOut(function(){
                if(reload == 'reload' && typeof url !== 'undefined'){ 
                    window.location.href = url;
                }
                else if(reload == 'reload'){
                    window.location.reload();
                }
            });

        }, 
        2000);

}
// set focus to input search field if search icon is clicked
// $('span.ion-android-search').click(function(){
//     $('#searchField').focus();
// });