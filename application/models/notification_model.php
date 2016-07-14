<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class notification_model extends CI_Model
{
public function create($email,$timestamp,$text,$order)
{
$data=array("email" => $email,"text" => $text,"order" => $order,"timestamp" => $timestamp);
$query=$this->db->insert( "notification", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("notification")->row();
return $query;
}
function getsinglenotification($id){
$this->db->where("id",$id);
$query=$this->db->get("notification")->row();
return $query;
}
public function edit($id,$email,$timestamp,$text,$order)
{
// if($image=="")
// {
// $image=$this->notification_model->getimagebyid($id);
// $image=$image->image;
// }
$data=array("email" => $email,"text" => $text,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "notification", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `notification` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `notification` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `notification` ORDER BY `id`
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
