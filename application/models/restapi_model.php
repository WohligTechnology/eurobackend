<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{

public function getslider()
{
    $query=$this->db->query("SELECT `id`, `order`, `status`, `image` FROM `euro_homeslider` WHERE 1")->result();
    return $query;
}
public function getExclusivePdt()
{
  $query=$this->db->query("SELECT `id`, `image1`, `image2` FROM `euro_exclusiveproduct` WHERE 1")->result();
  return $query;
}

}
?>
