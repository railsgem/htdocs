<script type="text/javascript">
    $('#fetch_li').addClass('active');
</script>
<div class="container-fluid">


	<button type="button" class="btn btn-info" id="get_product_list" >get_product_list</button>
	<form>
	  <div class="form-group">
	    <label for="exampleInputEmail1">category address</label>
	    <input type="text" class="form-control" id="category_address" placeholder="address">
	  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>



	<span id ='product_list'>get product list</span>

</div>
<script type="text/javascript">
	$(document).ready(function(){
	  	$("#get_product_list").click(function(){
			var category_address = $("#category_address").val();
			console.log("category_address:"+category_address);
		});
	});
	
</script>
