<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class homepageimage_model extends CI_Model
{
public function create($image1,$image2,$image3)
{
$data=array("image1" => $image1,"image2" => $image2,"image3" => $image3);
$query=$this->db->insert( "euro_homepageimage", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("euro_homepageimage")->row();
return $query;
}
function getsinglehomepageimage($id){
$this->db->where("id",$id);
$query=$this->db->get("euro_homepageimage")->row();
return $query;
}
public function edit($id,$image1,$image2,$image3)
{
if($image1=="")
{
$image1=$this->homepageimage_model->getimage1byid($id);
$image1=$image1->image1;
}
    
    if($image2=="")
{
$image2=$this->homepageimage_model->getimage2byid($id);
$image2=$image2->image2;
}
    if($image3=="")
{
$image3=$this->homepageimage_model->getimage3byid($id);
$image3=$image3->image3;
}
$data=array("image1" => $image1,"image2" => $image2,"image3" => $image3);
$this->db->where( "id", $id );
$query=$this->db->update( "euro_homepageimage", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `euro_homepageimage` WHERE `id`='$id'");
return $query;
}
public function getimage1byid($id)
{
$query=$this->db->query("SELECT `image1` FROM `euro_homepageimage` WHERE `id`='$id'")->row();
return $query;
}
    public function getimage2byid($id)
{
$query=$this->db->query("SELECT `image2` FROM `euro_homepageimage` WHERE `id`='$id'")->row();
return $query;
}
    public function getimage3byid($id)
{
$query=$this->db->query("SELECT `image3` FROM `euro_homepageimage` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `euro_homepageimage` ORDER BY `id` 
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
