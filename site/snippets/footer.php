<!-- FOOTER -->
<footer id="footer-section">
    <!--greyfooter  -->
    <?php snippet('footer/greyfooter') ?>
    <!--end greyfooter-->
    <!-- orangefooter -->
    <?php snippet('footer/orangefooter') ?>
    <!--end orangefooter-->
    <!-- privacy policy modal -->
    <!-- ACCOUNT MODAL -->
    <?php snippet('modal/account-modal') ?>
    <!-- END OF ACCOUNT MODAL -->
    <?php if($site->privacy_text()->isNotEmpty()){ snippet('modal/privacy-modal'); } ?>
    <!-- end of privacy policy modal -->
    <!-- terms & condition modal -->
    <?php if($site->terms_text()->isNotEmpty()){ snippet('modal/terms-modal'); } ?>
    <!-- end of terms & condition modal -->
</footer>
<!-- END FOOTER -->
<script type="text/javascript">

      // getting value from the php scripts
      <?php
      if(Session::hasOnlineAccess()){
        echo "var userId = '" . Session::getSession() . "';";
        echo 'var alreadyLoggedIn = true;';
    } else{
        echo 'var alreadyLoggedIn = false;';
    }
    ?>

    $(document).ready(function() {
        $('ul.list li').find('a').css('visibility','hidden');
        $('ul.list li.active').find('a').css('visibility','visible');
        $('body').keyup(function(e) {
            $('.is-dropdown-submenu-parent').mouseover();
            var code = e.keyCode || e.which;
            if (code == '9') {
             var focused = $(':focus');
             if(focused.attr('class') == 'course-one' && focused.parent().parent().hasClass('active')){
                focused.addClass('course-hovered');
                    //$('.btnOne').is('focus').removeClass('course-hovered');
                    let element;
                    if(focused.find('.enrol')[0]){
                        element = '.enrol';
                    }else{
                        element = 'a';
                    }

                    focused.find(element).on('focusout', function(){
                        focused.removeClass('course-hovered');
                    });                                    
                } 
            }
        });

        $("#searchButton").on('keyup', function(e) {
            if (e.which == 13) {
                $(".search-field").toggleClass("expand-search");
                $(".input-group-button").toggleClass("expand-button");
                $(".search-field").focus();
                if($('.search').hasClass('clicked') == true){
                   $('.search').removeClass('clicked');
                   $('.input-group-button .search span').css('color','#FFF');
               }else{
                   $('.search').addClass('clicked');
                   $('.clicked span').css('color','#F2AF00');
                   $('#searchField').focus();
                   setTimeout(function() {
                    $('#searchField').focus();
                }, 500);
               }
           }
       });

        $('#signin .sign-in').attr('tabindex','-1');
        $('.searchbar .search-field').attr('tabindex','-1');
        $('.heroArticle .sign-in').attr('tabindex');
        $('.carousel-container input').attr('tabindex');
        $('.carousel-container button').attr('tabindex');
        $('#contact-section button').attr('tabindex');
        $('#search-section a.sign-in').attr('tabindex');
        $('.orange-footer button').attr('tabindex');
        $('.footer-buttons button.editprofile').attr('tabindex');
        $('.footer-buttons button.changepass').attr('tabindex');
        $('#hero-banner-course button').attr('tabindex');
    });

    $('#nextLink').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $(this).click();
            $(this).blur();
            $('.first').focus();
        }
    });

    $('#prevLink').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $(this).click();
            $('.first').focus();
        }
    });

    $('#submitQuiz').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $(this).click();
        }
    });

    $('#signin').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $('#sign-in').foundation('open');
            setTimeout(function() { $('#sign-in').find('.close-button').focus(); }, 1000);
        }
    });

    $('.showanswer').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $('#test-answers').foundation('open');
            setTimeout(function() { $('#test-answers').find('.taketest').focus(); }, 1000);
        }
    });

    $('.back-to-course').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            location.reload();
        }
    });

    $('#li-myaccount').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var myaccountHref = $('.myaccount').attr('href');
            window.location = myaccountHref;
        }
    });

    $('#li-signout').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            // fire signout
            $.get($('#homeurl').val()+'/api/users/logout', function(data){
                // redirect to home page after logout/signout
                window.location = data.data.url;
            })
        }
    });

    $('.ion-home').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('#homeurl').val();
            window.location = href;
        }
    });

    $('.ion-university').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.courseslist').attr('href');
            window.location = href;
        }
    });

    $('.sfb').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.facebook').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.stwit').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.twitter').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.spint').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.pinterest').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.slinke').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.linkedin').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.stumb').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.tumblr').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.sred').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.reddit').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.sgp').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.googleplus').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.semail').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.email').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.fb').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vfacebook').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.twit').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vtwitter').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.you').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vyoutube').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.insta').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vinstagram').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.linke').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vlinkedin').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.pint').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vpinterest').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.mfb').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vfacebook').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.mtwit').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vtwitter').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.myou').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vyoutube').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.minsta').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vinstagram').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.mlinke').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vlinkedin').attr('href');
            window.open(href, '_blank');
        }
    });

    $('.mpint').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            var href = $('.vpinterest').attr('href');
            window.open(href, '_blank');
        }
    });

    // $('#searchButton').on('click', function(e){
    //     setTimeout(function(){ $('#searchField').focus() }, 500);
    // });

    // this will retrieved the logged user information and
    // has a connect function that will pass a data on a view.
    var loggedUser = (function(){
        // caching the DOM, this our private members.
        var $window = $(window);
        var $updateUserForm = $('#editUserForm');
        var _id;
        // get a user based on the id.
        function setId(id){
            _id = id;
        }
        /* this will aware/listen the loggedUser to a specific event that may be triggered.
        * the event is based on the string pass on this function - depending on the event type,
        * theres a particular handler
        * @params {String} eventType
        * @return {Object}
        */
        function listen(eventType){
            // we will connect the data that we will receive in a promise to a view component.
            var connectDataToView = function(view){
                promise.then(function(data){
                    if(view && typeof(view) === 'function'){
                        view(data);
                    }
                });
            }

            // check if the eventType is exist and the type is string
            if(eventType && typeof(eventType) === 'string'){
                switch (eventType) {
                    case 'GET_LOGGED_USER': {
                        // creating a promise object.
                        var promise = new Promise(function(resolve, reject){
                            // fire this action to trigger the get logged user event.
                            // the pass data on cb will be the resolve data.
                            getLoggedUserEvent(function(data){
                                resolve(data);
                            });
                        });
                        return {
                            connect: connectDataToView
                        }
                    }
                    case 'UPDATE_LOGGED_USER': {
                        // creating a promise object.
                        var promise = new Promise(function(resolve, reject){
                            // fire this action to trigger the get logged user event.
                            // the pass data on cb will be the resolve data.
                            updateLoggedUserEvent(function(data){
                                resolve(data);
                            });
                        });

                        return {
                            connect: connectDataToView
                        }
                    }
                    default: {
                        return alert('No such event exist!');
                    }
                }
            }
        }
        // DECLARE HERE THE EVENT HANDLER
        // thiw will update the user information
        function updateLoggedUserEvent(cb){
            $updateUserForm.on('submit', function(e){
                e.preventDefault();
                // fire a request
                $.ajax({
                    url: '<?php echo url() ?>/api/users/id:' + _id,
                    type: 'PUT',
                    data: $updateUserForm.serialize()
                })
                .done(function(data){
                    cb(data);
                })
                .fail(function(error){
                    cb(error.responseJSON.message);
                });
            });
        }
        // requesting on the server for the data of the logged user.
        // this will return a response data
        function getLoggedUserEvent(cb){
            $window.on('load', function(){
                return $.ajax({
                    url: '<?php echo url() ?>/api/users/id:' + _id,
                    type: 'GET',
                })
                .done(function(data){
                    cb(data);
                })
                .fail(function(error){
                    cb(error.responseJSON.message);
                });
            });
        }
        // return this object
        return {
            setId: setId,
            listen: listen
        };
    })();

    // pass the user id to retrieved the logged user.
    var sess = '<?php echo s::get('hasOnlineAccess') ?>';
    if (sess > 0) {
        loggedUser.setId(userId);
    } else {
        loggedUser.setId(0);
    } 

    /*---------------------------LISTENING TO AN EVENT-------------------------------*/
    // instructing the loggedUser to listen to an event 'GET_LOGGED_USER'  and 'UPDATE_LOGGED_USER'
    var fetchingLoggedUser = loggedUser.listen('GET_LOGGED_USER');
    var updatingLoggedUser = loggedUser.listen('UPDATE_LOGGED_USER');

    /*---------------------------CONNECTING TO THE VIEW-------------------------------*/
    // we will connect the data that resolves on event handler on the passed view.
    fetchingLoggedUser.connect(UserInfoView);
    fetchingLoggedUser.connect(UpdateUserFormView);
    updatingLoggedUser.connect(UserInfoView);
    updatingLoggedUser.connect(UpdateUserFormView);

    /*---------------------------VIEW COMPONENT-------------------------------*/
    function UpdateUserFormView(data){
        // caching the DOM
        var $editProfileBox = $('#edit-profile');
        var $flashMessageBox = $editProfileBox.find("#flashMessagebox");
        var $editFname = $editProfileBox.find('#pfirstname');
        var $editLname = $editProfileBox.find('#lfirstname');
        var $editEmail = $editProfileBox.find('#pemail');
        var $editUserForm = $editProfileBox.find('#editUserForm');

        function render(){
            var user = data.data;
            if(data.message == 'Successfully update the data.'){
                alert(data.message);
            }
        }

        // render the view.
        render();
    }

    function UserInfoView(user){
        var user = user.data;
        // caching the DOM
        var $profileBox = $('.profile-name');
        var $name = $profileBox.find('h1');
        var $email = $profileBox.find('p');
        var $firstname = $('.user-name');

        if (user.firstname.length > 7 ) {
            $(".user-name").css({"margin-top": "-7px", "margin-bottom": "7px"});
        }

        function render(){
            $name.html(user.firstname + ' ' + user.lastname);
            $email.html(user.email);
            $firstname.html('Hi ' + user.firstname);
        }

        render();
    }

    //changepass validate 
    $("#cnewpassword").keyup(valPassMatch);

    function valPassMatch() {
        var newpass = $('#newpassword').val();
        var confirmpass = $(this).val();

        if (newpass == confirmpass) {
            $("#checkmatchpass").addClass("checkhide");
        } else {
            $("#checkmatchpass").removeClass("checkhide");
        }     
    }

    $("#newpassword").keyup(valPassLength);

    function valPassLength() {
        var textval = $(this).val();
        var maxlength = $(this).data('maxlength');
        
        if(textval.length >= maxlength) {
            $('#checklengthpass').addClass("checkhide");
        } else {
            $('#checklengthpass').removeClass("checkhide");
        }
    }

    // changepass
    $("#form-changepass").on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        //validation
        //check if 'password' and 'confirm password' doesn't match, return error message.
        if($("#newpassword").val() !== $("#cnewpassword").val()) {
            var alerterrpassnotmatched = alertBox("Passwords don't match", 'error');
            $('#changepass_success').append(alerterrpassnotmatched);
            autoHide();
        } else if($("#newpassword").val().length < $('#newpassword').data('maxlength') ) {
            var alerterrpass = alertBox('Password should be at least 8 characters long.', 'error');
            $('#changepass_success').append(alerterrpass);
            autoHide();
        } else {
            $.ajax({
                type: 'PUT',
                url: "<?php echo url() ?>/api/changepass/id:" + userId,
                data: form.serialize(),
                success: function(result) {
                    if (result.data.success == true){
                        var alert = alertBox('Password changed!', 'success');
                        $('#changepass_success').append(alert);
                        $('#oldpassword').val("");
                        $('#newpassword').val("");
                        $('#cnewpassword').val("");
                        autoHide();
                        setTimeout(function(){ $('#change-pass').foundation('close'); }, 2000);
                    } else {
                      var alerterror = alertBox('Error', 'error');
                      $('#changepass_success').append(alerterror);
                      autoHide();  
                  }
              },
              error: function(result) {
                var alerterr = alertBox('Invalid password', 'error');
                $('#changepass_success').append(alerterr);
                autoHide();
            }    
        })  
        }   
    });
     // fire signout
     $('#signOut').click(function(){
        $.get('<?php echo url() ?>/api/users/logout', function(data){
            // redirect to home page after logout/signout
            window.location = data.data.url;
        })
    });

     $(function () {
        // Check the initial Poistion of the Sticky Header
        var stickyHeaderTop = $('#navbarsecondTop').offset().top;

        $(window).scroll(function () {
            if ($(window).scrollTop() > stickyHeaderTop) {
                $('#navbarsecondTop').css({
                    position: 'fixed',
                    top: '0px',
                    width: '100%',
                    background: '#F26522'
                });
                $('#othercontent').css('margin-top', $('#navbarsecondTop').outerHeight(true) + parseInt($('#navbarTop').css('marginBottom')));
            } else {
                $('#navbarsecondTop').css({
                    position: 'static',
                    top: '0px'
                });
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-migrate-3.0.1.min.js" integrity="sha256-F0O1TmEa4I8N24nY0bya59eP6svWcshqX1uzwaWC4F4=" crossorigin="anonymous"></script>

<script type="text/javascript">
    document.getElementById("searchField")
    .addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode == 13) {
            document.getElementById("ccc").click();
        }
    });
</script>
<?php if($site->analytics()->isNotEmpty()) : ?>
    <!-- Google analytics -->
    <?php echo $site->analytics()->html() ?>
    <!-- end Google analytics -->
<?php endif ?>
</body>
</html>