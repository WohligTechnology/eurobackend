<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create notification</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createnotificationsubmit");?>' enctype= 'multipart/form-data'>
<!-- <div class="row">
<div class="input-field col s6">
<label for="Email">Email</label>
<input type="email" id="Email" name="email" value='<?php echo set_value('email');?>'>
</div>
</div> -->

<div class="row">
<div class="input-field col s6">
<label for="Email">Order</label>
<input type="text" id="Order" name="order" value='<?php echo set_value('order');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
    <label>Text</label>
    <textarea  name="text" placeholder="Enter text ...">
        <?php echo set_value('text');?>
    </textarea>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewnotification"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
