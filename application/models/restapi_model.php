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

public function getSubscribers($email){
        $query1=$this->db->query("SELECT * FROM `euro_subscribe` WHERE `email`='$email'");
    $num=$query1->num_rows();
    if($num>0)
    {
    $object = new stdClass();
    $object->value = false;
    $object->comment = 'already exists';
   return $object;
    }
    else{
    $this->db->query("INSERT INTO `euro_subscribe`(`email`) VALUE('$email')");
    $id=$this->db->insert_id();
    $object = new stdClass();
    $object->value = true;
    return $object;
          }
}

public function getAllProducts()
{
$query= $this->db->query("SELECT `id`,`name`,`subcategory`,`image`,`size` FROM `euro_product`")->result();
return $query;
}
public function getHomePageImage()
{
$query= $this->db->query("SELECT `id`, `image1`, `image2`, `image3` FROM `euro_homepageimage`")->result();
return $query;
}

}
?>
