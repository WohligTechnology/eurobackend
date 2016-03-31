<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class subcategory_model extends CI_Model
{
public function create($order,$status,$category,$name)
{
$data=array("order" => $order,"status" => $status,"category" => $category,"name" => $name);
$query=$this->db->insert( "euro_subcategory", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("euro_subcategory")->row();
return $query;
}
function getsinglesubcategory($id){
$this->db->where("id",$id);
$query=$this->db->get("euro_subcategory")->row();
return $query;
}
public function edit($id,$order,$status,$category,$name)
{
$data=array("order" => $order,"status" => $status,"category" => $category,"name" => $name);
$this->db->where( "id", $id );
$query=$this->db->update( "euro_subcategory", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `euro_subcategory` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `euro_subcategory` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `euro_subcategory` ORDER BY `id` 
                    ASC")->result();
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
