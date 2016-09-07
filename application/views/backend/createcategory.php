<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create category</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createcategorysubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="Order">Order</label>
<input type="text" id="Order" name="order" value='<?php echo set_value('order');?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("status",$status,set_value('status'));?>
<label>Status</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row big">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Banner 1</span>
<input type="file" name="banner" multiple>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload big image" value='<?php echo set_value('banner');?>'>
</div>
</div>
 <span style=" display: block;
    padding-top: 30px;">1600px X 334px</span>
</div>
<!-- <div class="row big">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Banner 2</span>
<input type="file" name="banner2" multiple>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload big image" value='<?php echo set_value('banner2');?>'>
</div>
</div>
 <span style=" display: block;
    padding-top: 30px;">1600px X 500px</span>
</div> -->
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
   padding-top: 30px;">1000px X 534px</span>
</div>
<div class="row">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Feature Image</span>
<input type="file" name="image2" multiple>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload one or more files" value='<?php echo set_value('image2');?>'>
</div>
</div>
<span style=" display: block;
   padding-top: 30px;">2104px X 1054px</span>
</div>

<div class="row">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Default Image</span>
<input type="file" name="defaultimage" multiple>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload one or more files" value='<?php echo set_value('defaultimage');?>'>
</div>
</div>
<span style=" display: block;
   padding-top: 30px;">1000px X 1381px</span>
</div>
<!-- <div class="row">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Pdf download</span>
<input type="file" name="pdfdownload">
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload one or more files" value='<?php echo set_value('pdfdownload');?>'>
</div>
</div>
</div> -->
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewcategory"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
