<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class homeslider_model extends CI_Model
{
public function create($order,$status,$image)
{
$data=array("order" => $order,"status" => $status,"image" => $image);
$query=$this->db->insert( "euro_homeslider", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("euro_homeslider")->row();
return $query;
}
function getsinglehomeslider($id){
$this->db->where("id",$id);
$query=$this->db->get("euro_homeslider")->row();
return $query;
}
public function edit($id,$order,$status,$image)
{
if($image=="")
{
$image=$this->homeslider_model->getimagebyid($id);
$image=$image->image;
}
$data=array("order" => $order,"status" => $status,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "euro_homeslider", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `euro_homeslider` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `euro_homeslider` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `euro_homeslider` ORDER BY `id` 
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
