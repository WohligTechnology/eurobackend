<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class download_model extends CI_Model
{
public function create($image,$pdf,$order)
{
$data=array("image" => $image,"pdf" => $pdf,"order" => $order);
$query=$this->db->insert( "download", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("download")->row();
return $query;
}
function getsingleexclusiveproduct($id){
$this->db->where("id",$id);
$query=$this->db->get("download")->row();
return $query;
}
public function edit($id,$image,$pdf,$order)
{
$data=array("order" => $order);
if($image != "")
  $data['image']=$image;
if($pdf != "")
  $data['pdf']=$pdf;
$this->db->where( "id", $id );
$query=$this->db->update( "download", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `download` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `download` WHERE `id`='$id'")->row();
return $query;
}
    public function getpdfbyid($id)
{
$query=$this->db->query("SELECT `pdf` FROM `download` WHERE `id`='$id'")->row();
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
