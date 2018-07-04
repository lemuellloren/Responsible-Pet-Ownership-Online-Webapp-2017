<?php

return function($site, $pages, $page) {

  $query   = get('search-field');
  $results = page('courses')->search($query, 'title|text');
  $results = $results->paginate(100);

  return array(
    'query'   => $query,
    'results' => $results,
    'pagination' => $results->pagination()
  );

};