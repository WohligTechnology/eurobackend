<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create product</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createproductsubmit");?>' enctype= 'multipart/form-data'>
  <div class="row">
  <div class="input-field col s6">
  <label for="order">Order</label>
  <input type="text" id="order" name="order" value='<?php echo set_value('order');?>'>
  </div>
  </div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("category",$category,set_value('category'));?>
<label>Category</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("subcategory",$subcategory,set_value('subcategory'));?>
<label>Sub category</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Image</span>
<input type="file" name="image" multiple>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload one or more files" value='<?php echo set_value('image');?>'>
</div>
</div>
<span style=" display: block;
padding-top: 30px;">1000px X 801px</span>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Size">Size</label>
<input type="text" id="Size" name="size" value='<?php echo set_value('size');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewproduct"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
