// BASE FILE IMPORT
// @codekit-prepend '_base.js'


// PAGE FRAMEWORK COMPONENT IMPORT
// import any framework components that are used in this page only:

// PAGE FUNCTIONS
// define needed page functions here, when document.readyState === "complete":

/* if jQuery IS included in the project, use this: */

$(function() {

	$( ".search-input" ).focus();

	/* page functions go here */
	$('.search-link').on('mouseover',function(){
		$( ".search-input" ).focus();
	});

});

/* if jQuery IS NOT included in the project, use this instead: */
