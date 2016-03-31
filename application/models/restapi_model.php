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
    $this->db->query("INSERT INTO `euro_subscribe`(`email`) VALUE('$email')");
    $id=$this->db->insert_id();
    $object = new stdClass();
    $object->value = true;
    return $object;
          }
}

public function getAllCategory()
{
$query= $this->db->query("SELECT `id`,`name`,`image`,`banner`,`image2` AS 'featureimage',`pdfdownload` AS 'pdf' FROM `euro_category` WHERE `status`=1 ORDER BY `order`")->result();
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
$query= $this->db->query("SELECT  `id`, `image` FROM `euro_gallery` WHERE `category`='$id' ORDER BY `order`")->result();
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
$query= $this->db->query("SELECT `euro_subcategory`.`id`,`euro_subcategory`.`name` FROM `euro_subcategory` WHERE `category`='$id' ORDER BY `order`")->result();
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
Email : $email <br/>
Comment : $comment
  </p>

</div></body></html>";
if(!empty($email))
{
$url = 'https://api.sendgrid.com/';
$user = 'poojathakare';
$pass = 'wohlig123';
$request =  $url.'api/mail.send.json';

$json_string = array(

'to' => array(
// 'info@europratik.com','catch_umang@yahoo.co.in','amitwohlig@gmail.com '
'vinodwohlig@gmail.com'
),
'category' => 'test_category'
);


$params = array(
'api_user'  => $user,
'api_key'   => $pass,
'x-smtpapi' => json_encode($json_string),
'to'        => 'info@europratik.com',
'subject'   => 'Contact Form Submission',
'html'      => $message,
'text'      => 'testttttttttt',
'from'      => 'info@europratik.com',
//  'from'      => 'info@willnevergrowup.com',
);

$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
// print everything out
// print_r($response);

// obtain response
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
}
