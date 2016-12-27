<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("homepageimage");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">ID</th>
<th data-field="image1">Image1</th>
<th data-field="image2">Image2</th>
<th data-field="image3">Image3</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createhomepageimage"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
function drawtable(resultrow) {
       var image1="<a href='<?php echo base_url('uploads').'/'; ?>"+resultrow.image1+"' target='_blank'><img src='<?php echo base_url('uploads').'/'; ?>"+resultrow.image1+"' width='80px' height='80px'></a>";

      if(resultrow.image1=="" || resultrow.image1==null)
                {
                image1="No Receipt Available";
                }


       var image2="<a href='<?php echo base_url('uploads').'/'; ?>"+resultrow.image2+"' target='_blank'><img src='<?php echo base_url('uploads').'/'; ?>"+resultrow.image2+"' width='80px' height='80px'></a>";

      if(resultrow.image2=="" || resultrow.image2==null)
                {
                image2="No Receipt Available";
                }


       var image3="<a href='<?php echo base_url('uploads').'/'; ?>"+resultrow.image3+"' target='_blank'><img src='<?php echo base_url('uploads').'/'; ?>"+resultrow.image3+"' width='80px' height='80px'></a>";

      if(resultrow.image3=="" || resultrow.image3==null)
                {
                image3="No Receipt Available";
                }
return "<tr><td>" + resultrow.id + "</td><td>" + image1 + "</td><td>" + image2 + "</td><td>" + image3 + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/edithomepageimage?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deletehomepageimage?id='); ?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='material-icons propericon'>delete</i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
