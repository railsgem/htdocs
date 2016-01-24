<script type="text/javascript">
    $('#fetch_li').addClass('active');
</script>
<div class="container-fluid">


	<button type="button" class="btn btn-info" id="get_product_list" >get_product_list</button>
	<input type="text" class="form-control" id="category_address" placeholder="address" name="category_address"  value="<?php echo set_value('category_address'); ?>">



	<span id ='product_list'>get product list</span>


    <div id="span_content">
	</div>
    <div id="show">
	</div>
</div>



<script type="text/javascript">
	$(document).ready(function(){
	  	$("#get_product_list").click(function(){
			var data = {
				category_address : $("#category_address").val()
			}
			console.log("category_address:"+data);
			console.log(data);

			$.ajax({
				type: 'POST',
				url: 'fetch/fetch',
				data: data,
                beforeSend: function(){
                    $("#span_content").text("数据处理中...");
                	$("#show").html("");
                },
                success: function(msg){
                    $("#show").html(msg);
                }
			});

		});
	});
	
</script>
