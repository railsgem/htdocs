
<?php

        error_reporting(E_ALL);
        include_once('simple_html_dom.php');

        $url = "http://www.chemistwarehouse.com.au/Shop-Online/587/Swisse";

        //$page = [1,2,3];
        //fetch_by_category($html, 1);

        echo get_max_pages($url);
        fetch_all_product_by_category($url);

?>