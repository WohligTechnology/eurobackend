<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class newsletter_model extends CI_Model
{
public function create($user,$email,$status)
{
$data=array("user" => $user,"email" => $email,"status" => $status);
$query=$this->db->insert( "fynx_newsletter", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("fynx_newsletter")->row();
return $query;
}
function getsinglenewsletter($id){
$this->db->where("id",$id);
$query=$this->db->get("fynx_newsletter")->row();
return $query;
}
public function edit($id,$user,$email,$status)
{
$data=array("user" => $user,"email" => $email,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "fynx_newsletter", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `fynx_newsletter` WHERE `id`='$id'");
return $query;
}
    public function beforeeditcontact($id)
{
$this->db->where("id",$id);
$query=$this->db->get("contact")->row();
return $query;
}   
}
?>
