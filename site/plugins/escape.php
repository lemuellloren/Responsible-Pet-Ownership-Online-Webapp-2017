<?php

// Takes escaped parentheses ( "\(" and "\)") and changes them 
// into "[[" and "]]" - something kirbytext will leave alone.
// After kirbytext processes its tags, it converts them into regular parentheses.

kirbytext::$pre[] = function($kirbytext, $value) {
    return str_replace('\(','[[',str_replace('\)',']]',$value));
};

kirbytext::$post[] = function($kirbytext, $value) {
    return str_replace(']]',')',str_replace('[[','(',$value));
};