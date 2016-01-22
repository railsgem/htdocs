

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
    $product = fetch_all_product_by_category($category_address);
echo "-----------------------------------------------------------------</br>";
echo json_encode($product);

//echo "-----------------------------------------------------------------";
////echo count($product[0])+count($product[1])+count($product[2]);

?>
    <div id="product">
        <?php   echo json_encode($product); ?>
    </div>
<script>
$(document).ready(function(){
    $("#myButton").click(function(){
        var product = JSON.parse($("#product").html());
        console.log("product:"+product);
        console.log(product);
        var form_data = {
              "product_id":"69966",
              "product_name":"A2 Infant Formula Stage 1 900g",
              "small_img_src":"https:\/\/static.chemistwarehouse.com.au\/ams\/media\/productimages\/69966\/150.jpg",
              "big_img_src":"https:\/\/static.chemistwarehouse.com.au\/ams\/media\/productimages\/69966\/original.jpg",
              "chemist_price":"29.99"
        };
        $.ajax({
            type: 'POST',
            url: 'fetch/save_fetch',
            data: form_data,
            beforeSend: function(){
                $("#span_content").text("product数据处理中...");
            },
            success: function(msg){
                $("#show").html(msg);
            }
        });

    });
});

</script>