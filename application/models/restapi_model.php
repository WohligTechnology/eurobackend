<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{

public function getslider()
{
    $query=$this->db->query("SELECT `id`, `order`, `status`, `image` FROM `euro_homeslider` WHERE `status`=1 ORDER BY `order`")->result();
    return $query;
}
public function getExclusivePdt()
{
  $query=$this->db->query("SELECT `id`,`link`, `image1`, `image2` FROM `euro_exclusiveproduct` WHERE 1")->result();
  return $query;
}
public function getNotification()
{
  $query=$this->db->query("SELECT `id`, `text`, `timestamp`, `order` FROM `notification` WHERE 1 ORDER BY `order`")->result();
  return $query;
}
public function getAllArrival()
{
  $query=$this->db->query("SELECT `id`, `image1`,`link`,`order` FROM `euro_arrival` WHERE 1 ORDER BY `order`")->result();
  return $query;
}
public function getProductDetail($id)
{
  $query=$this->db->query("SELECT `euro_category`.`name` AS 'categoryname',`euro_subcategory`.`name` AS 'seriesname',`euro_product`.`name`,`euro_product`.`image`,`euro_product`.`size` FROM `euro_product` LEFT OUTER JOIN
`euro_category` ON `euro_category`.`id` = `euro_product`.`category` LEFT OUTER JOIN `euro_subcategory` ON `euro_subcategory`.`id` = `euro_product`.`subcategory` WHERE `euro_product`.`id`=$id")->row();
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
      $message = "<html><body><div id=':1fn' class='a3s adM' style='overflow: hidden;'>
      <p style='color:#000;font-family:Roboto;font-size:14px'>
    New Subscription from $email</p>

    </div></body></html>";
    $this->email_model->emailer($message,'New Subscription',$email,$username);
    $this->db->query("INSERT INTO `euro_subscribe`(`email`) VALUE('$email')");
    $id=$this->db->insert_id();
    $object = new stdClass();
    $object->value = true;
    return $object;
          }
}

public function testmail()
{
  $message = "<html><body><div id=':1fn' class='a3s adM' style='overflow: hidden;'>
  <p style='color:#000;font-family:Roboto;font-size:14px'>
New Subscription from $email

  </p>

</div></body></html>";
$this->email_model->emailer($message,'New Subscription','vinodwohlig@gmail.com',$username);
}

public function getAllCategory()
{
$query= $this->db->query("SELECT `id`,`name`,`image`,`banner`,`image2` AS 'featureimage',`pdfdownload` AS 'pdf',`defaultimage` FROM `euro_category` WHERE `status`=1 ORDER BY `order`")->result();
return $query;
}

public function getFiltersLater ($query) {
  $query2 = " SELECT `id` FROM ($query) as `tab1` ";
  $query3['subcategory'] = $this->db->query(" SELECT DISTINCT `euro_subcategory`.`name`,`euro_subcategory`.`id`,`euro_subcategory`.`order` FROM `euro_product` INNER JOIN `euro_subcategory` ON `euro_product`.`subcategory` = `euro_subcategory`.`id` WHERE `euro_product`.`id` IN ($query2) " )->result();
  return $query3;
}

public function getAllProducts()
{
$query= $this->db->query("SELECT `euro_category`.`id`,`euro_category`.`name`, `euro_category`.`image` FROM `euro_category` ORDER BY `order`")->result();

return $query;
}
public function getHomePageImage()
{
$query= $this->db->query("SELECT `id`, `link1`,`image1`,`link2`, `image2`,`link3`, `image3` FROM `euro_homepageimage`")->result();
return $query;
}
public function getGalleryImages()
{
$query= $this->db->query("SELECT  `euro_gallery`.`id`,  `euro_category`.`name` AS 'categoryName',`euro_category`.`image` AS 'categoryImg',  `euro_gallery`.`order`,  `euro_gallery`.`status`,  `euro_gallery`.`image`, `euro_gallery`.`pdf` FROM `euro_gallery` INNER JOIN `euro_category` ON `euro_gallery`.`category`=`euro_category`.`id`")->result();
return $query;
}
public function getEachProductGallery($id)
{
$query= $this->db->query("SELECT  `euro_gallery`.`id`,  `euro_gallery`.`image` AS 'image',`euro_gallery`.`image` AS 'src',`euro_category`.`name` FROM `euro_gallery` LEFT OUTER JOIN `euro_category` ON `euro_category`.`id`=`euro_gallery`.`category` WHERE `euro_gallery`.`category`='$id' ORDER BY `euro_gallery`.`order`")->result();
return $query;
}
public function getDownload($id)
{
  if($id != "")
  {
    $query= $this->db->query("SELECT  `id`, `image`,`pdf` FROM `download` WHERE `id`='$id' ORDER BY `order`")->row();
  }
  else {
  $query= $this->db->query("SELECT  `id`, `image`,`pdf` FROM `download` ORDER BY `order`")->result();
  }

return $query;
}

public function getAllSeries($category)
{
  if($category !="")
  {
    $query= $this->db->query("SELECT `id`,`name`,`category` FROM `euro_subcategory` WHERE `category`='$category' AND `status`=1 ORDER BY `order`")->result();
  }
  else {
    $query= $this->db->query("SELECT `id`,`name`,`category` FROM `euro_subcategory` WHERE `status`=1 ORDER BY `order`")->result();
  }

return $query;
}
public function getPopularProduct()
{
$query= $this->db->query("SELECT `euro_popularproduct`.`id`,`euro_popularproduct`.`link`,`euro_popularproduct`.`image` AS 'frontImage', `euro_popularproduct`.`image2` AS 'backImage' FROM `euro_popularproduct`  ORDER BY `euro_popularproduct`.`order`")->result();

return $query;
}
public function series($id)
{
$query= $this->db->query("SELECT `euro_subcategory`.`id` AS 'id',`euro_subcategory`.`name`,`euro_category`.`name` AS 'categoryname' FROM `euro_subcategory` LEFT OUTER JOIN `euro_category` ON `euro_category`.`id` = `euro_subcategory`.`category` WHERE `euro_subcategory`.`category`='$id' ORDER BY `euro_subcategory`.`order`")->result();
// print_r($query);
foreach ($query as $subcat) {
  $s = $this->db->query("SELECT `image` FROM `euro_product` WHERE `subcategory`='$subcat->id'")->row();
  $subcat->image= $s->image;
}
return $query;
}
public function getCategoryById($id)
{
$query= $this->db->query("SELECT `id`,`name`,`banner`,`pdfdownload` AS 'pdf' FROM `euro_category` WHERE `id`='$id'")->row();
return $query;
}
// public function SearchByCategory($name)
// {
// $query= $this->db->query("SELECT `euro_product`.`id`,`euro_product`.`name`,`euro_product`.`image`,`euro_product`.`size` FROM `euro_product` INNER JOIN `euro_category` ON `euro_product`.`category`=`euro_category`.`id` WHERE `euro_category`.`name` LIKE '$name%'")->result();
// return $query;
// }

public function contactUs($name,$telephone,$email,$comment,$city,$state)
{
  $this->db->query("INSERT INTO `contact`(`name`,`telephone`,`email`,`comment`,`city`,`state`) VALUE('$name','$telephone','$email','$comment','$city','$state')");
  $id=$this->db->insert_id();

  $message = "<html><body><div id=':1fn' class='a3s adM' style='overflow: hidden;'>
  <p style='color:#000;font-family:Roboto;font-size:14px'>Name : $name <br/>
Phone : $telephone <br/>
City : $city <br/>
State : $state <br/>
Email : $email <br/>
Comment : $comment
  </p>

</div></body></html>";
if(!empty($email))
{
// $viewcontent = $this->load->view('emailers/forgotpassword', $data, true);
$this->email_model->emailer($message,'Contact Form Submission',$email,$username);
}
  if($id != "")
  {

$response = curl_exec($session);
    $object = new stdClass();
    $object->value = true;
    return $object;
  }
  else {
    $object = new stdClass();
    $object->value = false;
    return $object;
  }

}

public function changeSiteBanner($image)
{
  $query= $this->db->query(" UPDATE `config` SET `content`='$image' WHERE `title`='siteBanner' ");
}

public function getSiteBanner()
{
  $query = $this->db->query(" SELECT * FROM  `config` WHERE `title`='siteBanner' ")->row();
  return $query;
}

}
