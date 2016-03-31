<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">View Contact</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editgetintouchsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">

<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id=" Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Email">Email</label>
<input type="email" id="Email" name="email" value='<?php echo set_value('email',$before->email);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="telephone">Telephone</label>
<input type="text" id="telephone" name="telephone" value='<?php echo set_value('telephone',$before->telephone);?>'>
</div>
</div>

<div class="row">
<div class="input-field col s6">
<label for="city">city</label>
<input type="text" id="city" name="city" value='<?php echo set_value('city',$before->city);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="state">state</label>
<input type="text" id="state" name="state" value='<?php echo set_value('state',$before->state);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Timestamp">Timestamp</label>
<input type="text" id="Timestamp" name="timestamp" value='<?php echo set_value('timestamp',$before->timestamp);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>Comment</label>
<textarea name="comment" placeholder="Enter text ..."><?php echo set_value( 'comment',$before->comment);?></textarea>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewcontact"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
