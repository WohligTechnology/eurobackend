<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch(" Contacts");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">ID</th>

<!--
<th data-field="noofdesigns">No of Designs</th>
<th data-field="designerid">Designer Id</th>
-->
<th data-field="name">Name</th>
<th data-field="email">Email Id</th>
<th data-field="telephone">Contact</th>
<!--<th data-field="comment">Comment</th>-->
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>

</div>
</div>
<script>
function drawtable(resultrow) {
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.email + "</td><td>" + resultrow.telephone + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editcontact?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
