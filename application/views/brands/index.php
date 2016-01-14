<h2><?php echo $title; ?> 
	<a href="/index.php/brands/create" class="btn btn-primary" >Add a new Brand</a>
</h2>

<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Brand ID</th>
                    <th>Brand NAME</th>
                    <th>Is Valid</th>
                    <th>Update time</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($brands as $brands_item): ?>
                <tr>
                    <td><?php echo $brands_item['brand_id']; ?></td>
                    <td><?php echo $brands_item['brand_name']; ?></td>
                    <td><?php echo $brands_item['is_valid']; ?></td>
                    <td><?php echo $brands_item['update_time']; ?></td>
                    <td>
						<a href="/index.php/brands/edit" class="btn btn-info" >Edit</a>
                    	<a href="/index.php/brands/expired" class="btn btn-inverse" >Expired</a>
                    	<a href="/index.php/brands/delete" class="btn btn-danger" >Delete</a>
                    </td>
                </tr>
			<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>