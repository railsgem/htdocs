<script type="text/javascript">
    $('#fetch_li').addClass('active');
</script>
<div class="container-fluid">

    <?php if ($update_success !='' ){  ?>
        <div class="alert alert-success">
            <?php echo '<strong>Well Done!</strong> '.$update_success; ?>
            <a href="/index.php/fetch/index" class="btn btn-success btn-xs">Return fetch</a>
            <button type="button" class="btn btn-success btn-xs" id="myButton">Save fetch list</button>
        </div>
    <?php  } ?>

<?php

        error_reporting(E_ALL);
        include_once('simple_html_dom.php');

        $category_url = "http://www.chemistwarehouse.com.au/Shop-Online/957/Baby-Formula";

echo $address;
        //$page = [1,2,3];
        //fetch_by_category($html, 1);

        echo get_max_pages($address);
        $product = fetch_all_product_by_category($address);
echo "-----------------------------------------------------------------";
        print_r($product);

echo "-----------------------------------------------------------------";
//echo count($product[0])+count($product[1])+count($product[2]);

?>
</div>
<script>
  $('#myButton').on('click', function () {
     console.log("test");



  })
</script>