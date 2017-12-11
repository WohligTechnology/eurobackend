<div class="container-fluid">
    <div class="file-field input-field col m6 s12">
        <h4 class="pad-left-15 capitalize">Upload Home Banner </h4>
        	<span class="img-center big image1">
                   			<?php if ($before->image == '') {
								} else {
									?><img src="<?php echo base_url('uploads').'/'.$before->image;
									?>">
														<?php
								} ?></span>
        <?php echo form_open_multipart('site/uploadSiteBannerImage');?>
        <input type="file" name="image" value="<?php echo set_value('image', $before->image);?>"/>
        <button class="btn btn-primary waves-effect waves-light  blue darken-4" type="submit" />Upload</button>
        <p style=" display: block;
		padding-top: 30px;">Size (900x1277)</p>
        </form>
    </div>
</div>