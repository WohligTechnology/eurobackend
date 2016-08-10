<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create exclusiveproduct</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createexclusiveproductsubmit");?>' enctype= 'multipart/form-data'>

  <div class="row">
  <div class="input-field col s6">
  <label for="Order">Link</label>
  <input type="text" id="link" name="link" value='<?php echo set_value('link');?>'>
  </div>
  </div>
<div class="row big">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Image1</span>
<input type="file" name="image1" multiple>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload big image" value='<?php echo set_value('image1');?>'>
</div>
</div>
 <span style=" display: block;
    padding-top: 30px;">1000px X 373px</span>
</div>
<div class="row small" style="display:none">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Image2</span>
<input type="file" name="image2" multiple>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload small image" value='<?php echo set_value('image2');?>'>
</div>
</div>
 <span style=" display: block;
    padding-top: 30px;">700px X 500px</span>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewexclusiveproduct"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
