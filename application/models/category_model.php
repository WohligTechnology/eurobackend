<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class category_model extends CI_Model
{
public function create($order,$status,$name,$banner,$banner2,$image,$image2,$pdfdownload)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"banner" => $banner,"banner2" => $banner2,"image" => $image,"image2" => $image2,"pdfdownload" => $pdfdownload);
// print_r($data);
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
public function edit($id,$order,$status,$name,$banner,$banner2,$image,$image2,$pdfdownload)
{
$data=array("order" => $order,"status" => $status,"name" => $name);
if($image != "")
  $data['image']=$image;
if($image2 != "")
  $data['image2']=$image2;
if($banner != "")
  $data['banner']=$banner;
if($banner2 != "")
  $data['banner2']=$banner2;
if($pdfdownload != "")
  $data['pdfdownload']=$pdfdownload;
$this->db->where( "id", $id );
// print_r($data);
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
public function getimage2byid($id)
{
$query=$this->db->query("SELECT `image2` FROM `euro_category` WHERE `id`='$id'")->row();
return $query;
}
    public function getbannerbyid($id)
{
$query=$this->db->query("SELECT `banner` FROM `euro_category` WHERE `id`='$id'")->row();
return $query;
}
    public function getbanner2byid($id)
{
$query=$this->db->query("SELECT `banner2` FROM `euro_category` WHERE `id`='$id'")->row();
return $query;
}
    public function getpdfbyid($id)
{
$query=$this->db->query("SELECT `pdfdownload` FROM `euro_category` WHERE `id`='$id'")->row();
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
public function getcategorydropdown()
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
