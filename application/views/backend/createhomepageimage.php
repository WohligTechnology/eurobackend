<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create homepageimage</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createhomepageimagesubmit");?>' enctype= 'multipart/form-data'>
  <div class="row">
  <div class="input-field col s6">
  <label for="Order">Image1 Link</label>
  <input type="text" id="link1" name="link1" value='<?php echo set_value('link1');?>'>
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
    padding-top: 30px;">1600px X 500px</span>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Order">Image2 Link</label>
<input type="text" id="link2" name="link2" value='<?php echo set_value('link2');?>'>
</div>
</div>
<div class="row small">
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
<div class="input-field col s6">
<label for="Order">Image3 Link</label>
<input type="text" id="link3" name="link3" value='<?php echo set_value('link3');?>'>
</div>
</div>
<div class="row small">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Image3</span>
<input type="file" name="image3" multiple>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload small image" value='<?php echo set_value('image3');?>'>
</div>
</div>
 <span style=" display: block;
    padding-top: 30px;">700px X 500px</span>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewhomepageimage"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
