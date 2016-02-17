<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class product_model extends CI_Model
{
public function create($category,$subcategory,$name,$image,$size)
{
$data=array("category" => $category,"subcategory" => $subcategory,"name" => $name,"image" => $image,"size" => $size);
$query=$this->db->insert( "euro_product", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("euro_product")->row();
return $query;
}
function getsingleproduct($id){
$this->db->where("id",$id);
$query=$this->db->get("euro_product")->row();
return $query;
}
public function edit($id,$category,$subcategory,$name,$image,$size)
{
if($image=="")
{
$image=$this->product_model->getimagebyid($id);
$image=$image->image;
}
$data=array("category" => $category,"subcategory" => $subcategory,"name" => $name,"image" => $image,"size" => $size);
$this->db->where( "id", $id );
$query=$this->db->update( "euro_product", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `euro_product` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `euro_product` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `euro_product` ORDER BY `id`
                    ASC")->row();
$return=array(
"" => "Select Option"
);
foreach($query as $row)
{
$return[$row->id]=$row->name;
}
return $return;
}



public function getproductdropdown()
{
$query=$this->db->query("SELECT * FROM `euro_product`  ORDER BY `id` ASC")->result();
$return=array(
"" => "Choose an option"
);
foreach($query as $row)
{
$return[$row->id]=$row->name;
}

return $return;
}
}
?>
