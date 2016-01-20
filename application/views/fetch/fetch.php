<?php

        error_reporting(E_ALL);
        include_once('simple_html_dom.php');

        $category_url = "http://www.chemistwarehouse.com.au/Shop-Online/957/Baby-Formula";

        //$page = [1,2,3];
        //fetch_by_category($html, 1);

        echo get_max_pages($category_url);
        //fetch_all_product_by_category($category_url);

?>