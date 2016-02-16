<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class gallery_model extends CI_Model
{
public function create($category,$order,$status,$image)
{
$data=array("category" => $category,"order" => $order,"status" => $status,"image" => $image);
$query=$this->db->insert( "euro_gallery", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("euro_gallery")->row();
return $query;
}
function getsinglegallery($id){
$this->db->where("id",$id);
$query=$this->db->get("euro_gallery")->row();
return $query;
}
public function edit($id,$category,$order,$status,$image)
{
if($image=="")
{
$image=$this->gallery_model->getimagebyid($id);
$image=$image->image;
}
$data=array("category" => $category,"order" => $order,"status" => $status,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "euro_gallery", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `euro_gallery` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `euro_gallery` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `euro_gallery` ORDER BY `id` 
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
