<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class exclusiveproduct_model extends CI_Model
{
public function create($image1,$image2,$link)
{
$data=array("image1" => $image1,"image2" => $image2,"link" => $link);
$query=$this->db->insert( "euro_exclusiveproduct", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("euro_exclusiveproduct")->row();
return $query;
}
function getsingleexclusiveproduct($id){
$this->db->where("id",$id);
$query=$this->db->get("euro_exclusiveproduct")->row();
return $query;
}
public function edit($id,$image1,$image2,$link)
{
$data=array("link" => $link);
if($image1 != "")
  $data['image1']=$image1;
if($image2 != "")
  $data['image2']=$image2;
$this->db->where( "id", $id );
$query=$this->db->update( "euro_exclusiveproduct", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `euro_exclusiveproduct` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image1` FROM `euro_exclusiveproduct` WHERE `id`='$id'")->row();
return $query;
}
    public function getimage2byid($id)
{
$query=$this->db->query("SELECT `image2` FROM `euro_exclusiveproduct` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `euro_exclusiveproduct` ORDER BY `id`
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
