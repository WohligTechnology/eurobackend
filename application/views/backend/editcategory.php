<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit category</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editcategorysubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="id" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="Order">Order</label>
<input type="text" id="Order" name="order" value='<?php echo set_value('order',$before->order);?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("status",$status,set_value('status',$before->status));?>
<label for="Status">Status</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>

<!--////////////////////////////////////////////////////////////////-->
 <div class="row small">
			<div class="file-field input-field col m6 s12">
				<span class="img-center banner image1">
                   			<?php if ($before->banner == '') {
} else {
    ?><img src="<?php echo base_url('uploads').'/'.$before->banner;
    ?>">
						<?php
} ?></span>
				<div class="btn blue darken-4">
					<span>Banner 1</span>
					<input name="banner" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate banner1" id="banner" type="text" placeholder="Upload one or more files" value="<?php echo set_value('banner', $before->banner);?>">
				</div>
				<div class="md4"><a class="waves-effect waves-light btn red clearimg input-field " onclick="deleteBanner()" >Clear Image</a></div>
			</div>
      <span style=" display: block;
         padding-top: 30px;">1600px X 334px</span>
		</div>

<!--////////////////////////////////////////////////////////////////-->
<div class="row">
			<div class="file-field input-field col m6 s12">
				<span class="img-center images image1">
                   			<?php if ($before->image == '') {
} else {
    ?><img src="<?php echo base_url('uploads').'/'.$before->image;
    ?>">
						<?php
} ?></span>
				<div class="btn blue darken-4">
					<span>Image</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate image1" type="text" id="image" placeholder="Upload one or more files" value="<?php echo set_value('image', $before->image);?>">
				</div>
				<div class="md4"><a onclick="deleteImage()" class="waves-effect waves-light btn red clearimg input-field ">Clear Image</a></div>
			</div>
      <span style=" display: block;
         padding-top: 30px;">1000px X 534px</span>
		</div>

		<!--////////////////////////////////////////////////////////////////-->
<div class="row">
			<div class="file-field input-field col m6 s12">
				<span class="img-center image2 image1">
                   			<?php if ($before->image2 == '') {
} else {
    ?><img src="<?php echo base_url('uploads').'/'.$before->image2;
    ?>">
						<?php
} ?></span>
				<div class="btn blue darken-4">
					<span>Feature Image</span>
					<input name="image2" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate image2" id="image2" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image2', $before->image2);?>">
				</div>
				<div class="md4"><a onclick="deleteImage2()" class="waves-effect waves-light btn red clearimg input-field ">Clear Image</a></div>
			</div>
      <span style=" display: block;
         padding-top: 30px;">2104px X 1054px</span>
		</div>
<!--////////////////////////////////////////////////////////////////-->
        <div class="row">
        			<div class="file-field input-field col m6 s12">
        				<span class="img-center defaultimage image1">
                           			<?php if ($before->defaultimage == '') {
        } else {
            ?><img src="<?php echo base_url('uploads').'/'.$before->defaultimage;
            ?>">
        						<?php
        } ?></span>
        				<div class="btn blue darken-4">
        					<span>Default Image</span>
        					<input name="defaultimage" type="file" multiple>
        				</div>
        				<div class="file-path-wrapper">
        					<input class="file-path validate defaultimage1" type="text" placeholder="Upload one or more files" id="defaultimage" value="<?php echo set_value('defaultimage', $before->defaultimage);?>">
        				</div>
        				<div class="md4"><a  class="waves-effect waves-light btn red clearimg input-field " onclick="deleteDefaultImage()">Clear Image</a></div>
        			</div>
              <span style=" display: block;
                 padding-top: 30px;">1000px X 1381px</span>
        		</div>
<!--////////////////////////////////////////////////////////////////-->

<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewcategory"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
<script>
function deleteImage(){
	var imagename = document.getElementById("image").value;
	var id = document.getElementById("id").value;
	 var new_base_url = "<?php echo site_url(); ?>";
	   $.getJSON(new_base_url + '/site/deleteImage', {
                id:id
            }, function(data) {
				  $('.images').hide();
			});
}
function deleteImage2(){
	var imagename = document.getElementById("image2").value;
	var id = document.getElementById("id").value;
	 var new_base_url = "<?php echo site_url(); ?>";
	   $.getJSON(new_base_url + '/site/deleteImage2', {
                id:id
            }, function(data) {
				  $('.image2').hide();
			});
}
function deleteBanner(){
	console.log("adsufha");
	var imagename = document.getElementById("banner").value;
	var id = document.getElementById("id").value;
	 var new_base_url = "<?php echo site_url(); ?>";
	   $.getJSON(new_base_url + '/site/deleteBanner', {
                id:id
            }, function(data) {
				  $('.banner').hide();
			});
}
function deleteDefaultImage(){
	var imagename = document.getElementById("defaultimage").value;
	var id = document.getElementById("id").value;
	 var new_base_url = "<?php echo site_url(); ?>";
	   $.getJSON(new_base_url + '/site/deleteDefaultImage', {
                id:id
            }, function(data) {
				  $('.defaultimage').hide();
			});
}
</script>