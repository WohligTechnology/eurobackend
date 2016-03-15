<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller
{function getallhomeslider()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_homeslider`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`euro_homeslider`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`euro_homeslider`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`euro_homeslider`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_homeslider`");
$this->load->view("json",$data);
}
public function getsinglehomeslider()
{
$id=$this->input->get_post("id");
$data["message"]=$this->homeslider_model->getsinglehomeslider($id);
$this->load->view("json",$data);
}
function getallsubscribe()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_subscribe`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`euro_subscribe`.`email`";
$elements[1]->sort="1";
$elements[1]->header="Email";
$elements[1]->alias="email";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`euro_subscribe`.`timestamp`";
$elements[2]->sort="1";
$elements[2]->header="Timestamp";
$elements[2]->alias="timestamp";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_subscribe`");
$this->load->view("json",$data);
}
public function getsinglesubscribe()
{
$id=$this->input->get_post("id");
$data["message"]=$this->subscribe_model->getsinglesubscribe($id);
$this->load->view("json",$data);
}
function getallhomepageimage()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_homepageimage`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`euro_homepageimage`.`image1`";
$elements[1]->sort="1";
$elements[1]->header="Image1";
$elements[1]->alias="image1";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`euro_homepageimage`.`image2`";
$elements[2]->sort="1";
$elements[2]->header="Image2";
$elements[2]->alias="image2";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`euro_homepageimage`.`image3`";
$elements[3]->sort="1";
$elements[3]->header="Image3";
$elements[3]->alias="image3";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_homepageimage`");
$this->load->view("json",$data);
}
public function getsinglehomepageimage()
{
$id=$this->input->get_post("id");
$data["message"]=$this->homepageimage_model->getsinglehomepageimage($id);
$this->load->view("json",$data);
}
function getallexclusiveproduct()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_exclusiveproduct`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`euro_exclusiveproduct`.`image1`";
$elements[1]->sort="1";
$elements[1]->header="Image1";
$elements[1]->alias="image1";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`euro_exclusiveproduct`.`image2`";
$elements[2]->sort="1";
$elements[2]->header="Image2";
$elements[2]->alias="image2";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_exclusiveproduct`");
$this->load->view("json",$data);
}
public function getsingleexclusiveproduct()
{
$id=$this->input->get_post("id");
$data["message"]=$this->exclusiveproduct_model->getsingleexclusiveproduct($id);
$this->load->view("json",$data);
}
function getallpopularproduct()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_popularproduct`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`euro_popularproduct`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`euro_popularproduct`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`euro_popularproduct`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_popularproduct`");
$this->load->view("json",$data);
}
public function getsinglepopularproduct()
{
$id=$this->input->get_post("id");
$data["message"]=$this->popularproduct_model->getsinglepopularproduct($id);
$this->load->view("json",$data);
}
function getallcategory()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_category`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`euro_category`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`euro_category`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`euro_category`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`euro_category`.`banner`";
$elements[4]->sort="1";
$elements[4]->header="Banner";
$elements[4]->alias="banner";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`euro_category`.`image`";
$elements[5]->sort="1";
$elements[5]->header="Image";
$elements[5]->alias="image";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`euro_category`.`pdfdownload`";
$elements[6]->sort="1";
$elements[6]->header="Pdf download";
$elements[6]->alias="pdfdownload";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_category`");
$this->load->view("json",$data);
}
public function getsinglecategory()
{
$id=$this->input->get_post("id");
$data["message"]=$this->category_model->getsinglecategory($id);
$this->load->view("json",$data);
}
function getallgallery()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_gallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`euro_gallery`.`category`";
$elements[1]->sort="1";
$elements[1]->header="Category";
$elements[1]->alias="category";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`euro_gallery`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`euro_gallery`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`euro_gallery`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_gallery`");
$this->load->view("json",$data);
}
public function getsinglegallery()
{
$id=$this->input->get_post("id");
$data["message"]=$this->gallery_model->getsinglegallery($id);
$this->load->view("json",$data);
}
function getallsubcategory()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_subcategory`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`euro_subcategory`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`euro_subcategory`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`euro_subcategory`.`category`";
$elements[3]->sort="1";
$elements[3]->header="Category";
$elements[3]->alias="category";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`euro_subcategory`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Name";
$elements[4]->alias="name";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_subcategory`");
$this->load->view("json",$data);
}
public function getsinglesubcategory()
{
$id=$this->input->get_post("id");
$data["message"]=$this->subcategory_model->getsinglesubcategory($id);
$this->load->view("json",$data);
}
function getallproduct()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_product`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`euro_product`.`category`";
$elements[1]->sort="1";
$elements[1]->header="Category";
$elements[1]->alias="category";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`euro_product`.`subcategory`";
$elements[2]->sort="1";
$elements[2]->header="Sub category";
$elements[2]->alias="subcategory";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`euro_product`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`euro_product`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`euro_product`.`size`";
$elements[5]->sort="1";
$elements[5]->header="Size";
$elements[5]->alias="size";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_product`");
$this->load->view("json",$data);
}
public function getsingleproduct()
{
$id=$this->input->get_post("id");
$data["message"]=$this->product_model->getsingleproduct($id);
$this->load->view("json",$data);
}
  public function getImage()
{
            $urlfordatabase=$_SERVER["SCRIPT_FILENAME"];
             $urlfordatabase=substr($urlfordatabase,0,-9);
            $urlfordatabase=$urlfordatabase."application/controllers/site.php";
            $databaseurl=$urlfordatabase;
              $databaseurl = read_file($databaseurl);
                    $parts = explode('$image=$this->input->get_post("image");', $databaseurl);
         $n=count($parts);
         $content='';
         for($i=0; $i < $n-1;$i++){
           $content.=$parts[$i].'$image=$this->menu_model->createImage();';
         }
         $content=$content.end($parts);
                    if (write_file('C:/xampp/htdocs/euro/application/controllers/site.php', $content)) {
                        // echo 'File written!';
                    }
                    else{
                        // echo 'Unable to write the file';
                    }
}

 // API FROM HERE


 public function getslider()
{
$data["message"]=$this->restapi_model->getslider();
$this->load->view("json",$data);
}

public function getExclusivePdt()
{
  $data["message"]=$this->restapi_model->getExclusivePdt();
  $this->load->view("json",$data);
}

public function getSubscribers()
{
  $email=$this->input->get_post("email");

  if(empty($email)){
      $data["message"]=0;
  }
  else{
    $data["message"]=$this->restapi_model->getSubscribers($email);
  }

  $this->load->view("json",$data);
}

public function getAllProducts()
{
  $data["message"]=$this->restapi_model->getAllProducts();
  $this->load->view("json",$data);
}
public function getHomePageImage()
{
  $data["message"]=$this->restapi_model->getHomePageImage();
  $this->load->view("json",$data);
}
public function getEachProductGallery()
{
  $id=$this->input->get_post("id");
  $data["message"]=$this->restapi_model->getEachProductGallery($id);
  $this->load->view("json",$data);
}
public function getDownload()
{
  $id=$this->input->get_post("id");
  $data["message"]=$this->restapi_model->getDownload($id);
  $this->load->view("json",$data);
}
public function getAllSeries()
{

    $category=$this->input->get_post("category");
  $data["message"]=$this->restapi_model->getAllSeries($category);

  $this->load->view("json",$data);
}
public function series()
{
    $id=$this->input->get_post("id");
  $data["message"]=$this->restapi_model->series($id);
  $this->load->view("json",$data);
}

public function getPopularProduct()
{
  $data["message"]=$this->restapi_model->getPopularProduct();
  $this->load->view("json",$data);
}
public function getAllCategories()
{
    $data["message"]=$this->restapi_model->getAllCategory();
  $this->load->view("json",$data);
}

public function getCategoryById()
{
    $id=$this->input->get_post("id");
  $data["message"]=$this->restapi_model->getCategoryById($id);
  $this->load->view("json",$data);
}
public function SearchByCategory()
{
  $name=$this->input->get_post("name");
  $where = "WHERE 1";
$this->chintantable->createelement("`euro_product`.`id`", '1', "ID", "id");
$this->chintantable->createelement("`euro_product`.`name`", '1', "name", "name");
$this->chintantable->createelement("`euro_product`.`image`", '0', "image", "image");
$this->chintantable->createelement("`euro_product`.`size`", '0', "size", "size");
$this->chintantable->createelement("`euro_product`.`order`", '0', "order", "order");
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=  20;
}
if($orderby=="")
{
  $orderby="order";
  $orderorder="ASC";
}

if($name != "")
{

  $where .= " AND `euro_category`.`name` = '$name' OR `euro_subcategory`.`name` = '$name' OR `euro_product`.`name`= '$name'";
}
$data["message"]=$this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search,"", "FROM `euro_product` INNER JOIN `euro_category` ON `euro_product`.`category`=`euro_category`.`id` INNER JOIN `euro_subcategory` ON `euro_product`.`subcategory`=`euro_subcategory`.`id`", "$where");
$this->load->view("json",$data);
}

public function getProductsByCategory() {

    $categoryid = $this->input->get_post('categoryid');
    $subcategories  = $this->input->get_post("subcategories");
    $where = " ";
    if($subcategories != "")
    {
      $where .= " AND `euro_product`.`subcategory` = $subcategories ";
      // $where .= " AND `euro_product`.`subcategory` IN ($subcategories) ";
    }

    $this->chintantable->createelement('`euro_product`.`id`','1','ID', 'id');
    $this->chintantable->createelement('`euro_product`.`name`','1','name', 'name');
    $this->chintantable->createelement('`euro_product`.`image`','1','image', 'image');
    $this->chintantable->createelement('`euro_product`.`size`','1','size', 'size');
    $this->chintantable->createelement('`euro_product`.`order`','1','order', 'order');
    $search = $this->input->get_post('search');
    $pageno = $this->input->get_post('pageno');

    if($orderby=="")
    {
    $orderby="order";
    $orderorder="ASC";
    }

    $maxrow = $this->input->get_post('maxrow');
     $data3["data"] =  $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search,"", "FROM `euro_product` LEFT OUTER JOIN `euro_category` on `euro_product`.category=`euro_category`.`id`","WHERE `euro_product`.`category` = '$categoryid'", "$where", "GROUP BY `euro_product`.`id`","$orderby");
$data3["filter"] = $this->restapi_model->getFiltersLater($data3["data"]->querycomplete);

        $data["message"] = $data3;
    $this->load->view('json', $data);
}

public function contactUs()
{
  $data = json_decode(file_get_contents('php://input'), true);
  $name = $data['name'];
  $telephone = $data['telephone'];
  $email = $data['email'];
  $comment = $data['comment'];

$data['message'] = $this->restapi_model->contactUs($name,$telephone,$email,$comment);
$this->load->view('json', $data);
}



} ?>
