<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class popularproduct_model extends CI_Model
{
public function create($order,$status,$category,$product,$image)
{
$data=array("order" => $order,"status" => $status,"category" => $category,"product" => $product,"image" => $image);
$query=$this->db->insert( "euro_popularproduct", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("euro_popularproduct")->row();
return $query;
}
function getsinglepopularproduct($id){
$this->db->where("id",$id);
$query=$this->db->get("euro_popularproduct")->row();
return $query;
}
public function edit($id,$order,$category,$status,$image)
{
if($image=="")
{
$image=$this->popularproduct_model->getimagebyid($id);
$image=$image->image;
}
$data=array("order" => $order,"category" => $category,"status" => $status,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "euro_popularproduct", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `euro_popularproduct` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `euro_popularproduct` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `euro_popularproduct` ORDER BY `id`
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
}
?>
