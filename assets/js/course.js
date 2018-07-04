// BASE FILE IMPORT
// @codekit-prepend '_base.js'


// PAGE FRAMEWORK COMPONENT IMPORT
// import any framework components that are used in this page only:

// PAGE FUNCTIONS
// define needed page functions here, when document.readyState === "complete":

/* if jQuery IS included in the project, use this: */

$(function() {

    checkifsix(); //this calls it on load

    function checkifsix () {
        $('.savePetToDb').on('change', function(e){
            var checks = $('.savePetToDb:checked');
            console.log(checks.length);
            if(checks.length == 6){ 
                e.preventDefault();
                $('.savePetToDb:not(:checked)').prop('disabled', true).siblings().css({'background':'#e9e9e9', 'border':'1px solid #747677'});
                // $('.savePetToDb:not(:checked)').css('opacity', '0.5');
        }
        else {
            $('.savePetToDb:not(:checked)').prop('disabled', false).siblings().css({'background':'#fff', 'border':'1px solid #e98300'});
        }
    });
    };
    // submit certificate
    $('#submitCertMobile').on('click', function() {
    	$('#submitDomPdfDesktop').submit();
    });
    $('#submitCertDesktop').on('click', function() {
    	$('#submitDomPdfDesktop').submit();
    });

    $(document).on('closed.zf.reveal', '[data-reveal]', '#test-yourself', function () {
        $('.success').hide();
        $('.failed').hide();
        $('#modal-footer').hide();
        $("#formQuestion").show();
        $('.questions').hide();
        $('#question-0').show();
        $('#progressTest').width('10%');
        document.getElementById('pCount').innerHTML = 'Progress: 10%';
        $('#prevLink').css('display', 'none');
        $('#submitQuiz').css('display', 'none');
        $('#nextLink').css('display', 'inline-block');
        $('#qestionNo').val(0);
        $('#questionCount').val(10);
        $('#progress').val(10);
        $('.questions input[type="radio"]').prop('checked', false);
    }); 

    //Course Progress Bar
    $('input#id').on('click', function() {
    	var emptyValue = 0;
    	$('input.checkbox_mod:checked').each(function() {
    		emptyValue += parseInt($(this).val()) || 0;
    		if (emptyValue > 90) {
    			emptyValue = 100;
    		}
    	});
    	$("p.progress_count").html("Progress: " + emptyValue + '%');
    	$('.progress-bar').css('width', emptyValue + '%').attr('aria-valuenow', emptyValue);
    });
    $( document ).ready(function() {
    	var emptyValue = 0;
    	$('input.checkbox_mod:checked').each(function() {
    		emptyValue += parseInt($(this).val()) || 0;
    		if (emptyValue > 90) {
    			emptyValue = 100;
    		}
    	});

    	$("p.progress_count").html("Progress: " + emptyValue + '%');
    	$('.progress-bar').css('width', emptyValue + '%').attr('aria-valuenow', emptyValue);
    });

});

/* if jQuery IS NOT included in the project, use this instead: */
