<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit homepageimage</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/edithomepageimagesubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="Order">Image1 Link</label>
<input type="text" id="link1" name="link1" value='<?php echo set_value('link1',$before->link1);?>'>
</div>
</div>

<div class="row big">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big image1">
                   			<?php if ($before->image1 == '') {
} else {
    ?><img src="<?php echo base_url('uploads').'/'.$before->image1;
    ?>">
						<?php
} ?></span>
				<div class="btn blue darken-4">
					<span>Image1</span>
					<input name="image1" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate image11" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image1', $before->image1);?>">
				</div>
<!--				<div class="md4"><a class="waves-effect waves-light btn red clearimg input-field ">Clear Image</a></div>-->
			</div>
		</div>

		<div class="row">
		<div class="input-field col s6">
		<label for="Order">Image2 Link</label>
		<input type="text" id="link2" name="link2" value='<?php echo set_value('link2',$before->link2);?>'>
		</div>
		</div>
    <div class="row small">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big image1">
                   			<?php if ($before->image2 == '') {
} else {
    ?><img src="<?php echo base_url('uploads').'/'.$before->image2;
    ?>">
						<?php
} ?></span>
				<div class="btn blue darken-4">
					<span>Image2</span>
					<input name="image2" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate image21" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image2', $before->image2);?>">
				</div>
<!--				<div class="md4"><a class="waves-effect waves-light btn red clearimg input-field ">Clear Image</a></div>-->
			</div>
		</div>
		<div class="row">
		<div class="input-field col s6">
		<label for="Order">Image3 Link</label>
		<input type="text" id="link3" name="link3" value='<?php echo set_value('link3',$before->link3);?>'>
		</div>
		</div>
   <div class="row small">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big image1">
                   			<?php if ($before->image3 == '') {
} else {
    ?><img src="<?php echo base_url('uploads').'/'.$before->image3;
    ?>">
						<?php
} ?></span>
				<div class="btn blue darken-4">
					<span>Image3</span>
					<input name="image3" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate image31" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image3', $before->image3);?>">
				</div>
<!--				<div class="md4"><a class="waves-effect waves-light btn red clearimg input-field ">Clear Image</a></div>-->
			</div>
		</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewhomepageimage"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
