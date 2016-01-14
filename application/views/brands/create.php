<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('brands/create'); ?>

    <label for="title">brand name</label>
    <input type="input" name="brand_name" /><br />


    <input type="submit" name="submit" value="Create news item" />

</form>