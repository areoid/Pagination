# Pagination
Pagination PHP - a PHP Library for create the pagination pages

# How to?
```php
<?php

require_once('Pagination.php'); // loud the Pagination Class

$pagination = new Pagination();

$total    = 100;
$per_page = 5;
$page     = 1;

// setup the pagination
$pagination->paginationSetup([
					'total'         => $total,                              // total of records
					'per_page'      => $per_page,                           // limit per page that shown
					'page'          => $page,                               // init for current page
					'base_page_url' => 'http://www.domain.com/news',        // init URL for first page 
					'page_url'      => 'http://www.domain.com/news?page=',  // init URL for URL Pagination
					'ul_class'      => 'custom-class',                      // optional, for customize the <ul> CSS style
		]);

// generate HTML script pagination
$script_paging = $pagination->createPaginationLink();

echo $script_paging;

?>
```
# EOF
areoid a.k.a areg_noid | areg_noid@yahoo.com
