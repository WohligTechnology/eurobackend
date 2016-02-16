<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class category_model extends CI_Model
{
public function create($order,$status,$name,$banner,$image,$pdfdownload)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"banner" => $banner,"image" => $image,"pdfdownload" => $pdfdownload);
$query=$this->db->insert( "euro_category", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("euro_category")->row();
return $query;
}
function getsinglecategory($id){
$this->db->where("id",$id);
$query=$this->db->get("euro_category")->row();
return $query;
}
public function edit($id,$order,$status,$name,$banner,$image,$pdfdownload)
{
if($image=="")
{
$image=$this->category_model->getimagebyid($id);
$image=$image->image;
}
    if($banner=="")
{
$banner=$this->category_model->getbannerbyid($id);
$banner=$banner->banner;
}
$data=array("order" => $order,"status" => $status,"name" => $name,"banner" => $banner,"image" => $image,"pdfdownload" => $pdfdownload);
$this->db->where( "id", $id );
$query=$this->db->update( "euro_category", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `euro_category` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `euro_category` WHERE `id`='$id'")->row();
return $query;
}
    public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `euro_category` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `euro_category` ORDER BY `id` ASC")->result();
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
