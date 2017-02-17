
<h4 class="pad-left-15 capitalize">Upload Home Banner</h4>
<div class="btn blue darken-4">
<span>Image</span>
<input type="file" name="image"/>
</div>
<div class="file-path-wrapper">
    <input class="file-path validate image1" type="text" placeholder="Upload one or more files" value="<?php echo form_open_multipart('site/uploadSiteBannerImage');?>">
</div>
<input class="btn btn-primary waves-effect waves-light  blue darken-4" type="submit" value="upload" />
</form>
