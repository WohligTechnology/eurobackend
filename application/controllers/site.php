<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller
{
	public function __construct( )
	{
		parent::__construct();

		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
    public function getOrderingDone()
    {
        $orderby=$this->input->get("orderby");
        $ids=$this->input->get("ids");
        $ids=explode(",",$ids);
        $tablename=$this->input->get("tablename");
        $where=$this->input->get("where");
        if($where == "" || $where=="undefined")
        {
            $where=1;
        }
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $i=1;
        foreach($ids as $id)
        {
            //echo "UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = `$id` AND $where";
            $this->db->query("UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = '$id' AND $where");
            $i++;
            //echo "/n";
        }
        $data["message"]=true;
        $this->load->view("json",$data);

    }
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data['gender']=$this->user_model->getgenderdropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)
		{
			$data['alerterror'] = validation_errors();
            $data['gender']=$this->user_model->getgenderdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $phone=$this->input->post('phone');
            $billingaddress=$this->input->post('billingaddress');
            $billingcity=$this->input->post('billingcity');
            $billingstate=$this->input->post('billingstate');
            $billingcountry=$this->input->post('billingcountry');
            $billingpincode=$this->input->post('billingpincode');
            $billingcontact=$this->input->post('billingcontact');

            $shippingaddress=$this->input->post('shippingaddress');
            $shippingcity=$this->input->post('shippingcity');
            $shippingstate=$this->input->post('shippingstate');
            $shippingcountry=$this->input->post('shippingcountry');
            $shippingpincode=$this->input->post('shippingpincode');
            $shippingcontact=$this->input->post('shippingcontact');
            $shippingname=$this->input->post('shippingname');
            $currency=$this->input->post('currency');
            $credit=$this->input->post('credit');
            $companyname=$this->input->post('companyname');
            $registrationno=$this->input->post('registrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');

            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];

                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }

			}

			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$firstname,$lastname,$phone,$billingaddress,$billingcity,$billingstate,$billingcountry,$billingpincode,$billingcontact,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$shippingcontact,$shippingname,$currency,$credit,$companyname,$registrationno,$vatnumber,$country,$fax,$gender)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");

		$data['title']='View Users';
		$this->load->view('template',$data);
	}
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);


        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";


        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";

        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";

        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";

        $elements[4]=new stdClass();
        $elements[4]->field="`user`.`logintype`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";

        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";

        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";

        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";


        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }

        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }

        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");

		$this->load->view("json",$data);
	}


	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
        $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data['gender']=$this->user_model->getgenderdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('templatewith2',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);

		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data['gender']=$this->user_model->getgenderdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{

            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
//            $category=$this->input->get_post('category');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $phone=$this->input->post('phone');
            $billingaddress=$this->input->post('billingaddress');
            $billingcity=$this->input->post('billingcity');
            $billingstate=$this->input->post('billingstate');
            $billingcountry=$this->input->post('billingcountry');
            $billingpincode=$this->input->post('billingpincode');
            $billingcontact=$this->input->post('billingcontact');

            $shippingaddress=$this->input->post('shippingaddress');
            $shippingcity=$this->input->post('shippingcity');
            $shippingstate=$this->input->post('shippingstate');
            $shippingcountry=$this->input->post('shippingcountry');
            $shippingpincode=$this->input->post('shippingpincode');
            $shippingcontact=$this->input->post('shippingcontact');
            $shippingname=$this->input->post('shippingname');
            $currency=$this->input->post('currency');
            $credit=$this->input->post('credit');
            $companyname=$this->input->post('companyname');
            $registrationno=$this->input->post('registrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];

                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }

			}

            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }

			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$firstname,$lastname,$phone,$billingaddress,$billingcity,$billingstate,$billingcountry,$billingpincode,$billingcontact,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$shippingcontact,$shippingname,$currency,$credit,$companyname,$registrationno,$vatnumber,$country,$fax,$gender)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";

			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);

		}
	}

	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    public function viewcart()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcart";
    $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
$data['page2']='block/userblock';
$data["base_url"]=site_url("site/viewcartjson?id=").$this->input->get('id');
$data["title"]="View cart";
$this->load->view("templatewith2",$data);
}
function viewcartjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`fynx_cart`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`fynx_cart`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`fynx_cart`.`quantity`";
$elements[2]->sort="1";
$elements[2]->header="Quantity";
$elements[2]->alias="quantity";
$elements[3]=new stdClass();
$elements[3]->field="`fynx_cart`.`product`";
$elements[3]->sort="1";
$elements[3]->header="Product";
$elements[3]->alias="product";
$elements[4]=new stdClass();
$elements[4]->field="`fynx_cart`.`timestamp`";
$elements[4]->sort="1";
$elements[4]->header="Timestamp";
$elements[4]->alias="timestamp";

$elements[5]=new stdClass();
$elements[5]->field="`fynx_cart`.`size`";
$elements[5]->sort="1";
$elements[5]->header="Size";
$elements[5]->alias="size";

$elements[6]=new stdClass();
$elements[6]->field="`fynx_cart`.`color`";
$elements[6]->sort="1";
$elements[6]->header="Color";
$elements[6]->alias="color";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `fynx_cart`","WHERE `fynx_cart`.`user`='$id'");
$this->load->view("json",$data);
}
    public function viewwishlist()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewwishlist";
    $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
$data['page2']='block/userblock';
$data["base_url"]=site_url("site/viewwishlistjson?id=".$this->input->get('id'));
$data["title"]="View wishlist";
$this->load->view("templatewith2",$data);
}
function viewwishlistjson()
{
    $user=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`fynx_wishlist`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`fynx_wishlist`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`fynx_wishlist`.`product`";
$elements[2]->sort="1";
$elements[2]->header="Product";
$elements[2]->alias="product";
$elements[3]=new stdClass();
$elements[3]->field="`fynx_wishlist`.`timestamp`";
$elements[3]->sort="1";
$elements[3]->header="Timestamp";
$elements[3]->alias="timestamp";

$elements[4]=new stdClass();
$elements[4]->field="`fynx_product`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Product Name";
$elements[4]->alias="productname";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `fynx_wishlist` LEFT OUTER JOIN `fynx_product` ON `fynx_product`.`id`=`fynx_wishlist`.`product`","WHERE `fynx_wishlist`.`user`='$user'");
$this->load->view("json",$data);
}




public function viewhomeslider()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="viewhomeslider";
$data["base_url"]=site_url("site/viewhomesliderjson");
$data["title"]="View homeslider";
$this->load->view("template",$data);
}
function viewhomesliderjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_homeslider`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`euro_homeslider`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`euro_homeslider`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_homeslider`");
$this->load->view("json",$data);
}

public function createhomeslider()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="createhomeslider";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create homeslider";
$this->load->view("template",$data);
}
public function createhomeslidersubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createhomeslider";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create homeslider";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$image=$this->menu_model->createImage();
if($this->homeslider_model->create($order,$status,$image)==0)
$data["alerterror"]="New homeslider could not be created.";
else
$data["alertsuccess"]="homeslider created Successfully.";
$data["redirect"]="site/viewhomeslider";
$this->load->view("redirect",$data);
}
}
public function edithomeslider()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="edithomeslider";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit homeslider";
$data["before"]=$this->homeslider_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edithomeslidersubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edithomeslider";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit homeslider";
$data["before"]=$this->homeslider_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$image=$this->menu_model->createImage();
if($this->homeslider_model->edit($id,$order,$status,$image)==0)
$data["alerterror"]="New homeslider could not be Updated.";
else
$data["alertsuccess"]="homeslider Updated Successfully.";
$data["redirect"]="site/viewhomeslider";
$this->load->view("redirect",$data);
}
}
public function deletehomeslider()
{
$access=array("1");
$this->checkaccess($access);
$this->homeslider_model->delete($this->input->get("id"));
$data["redirect"]="site/viewhomeslider";
$this->load->view("redirect",$data);
}
public function viewsubscribe()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewsubscribe";
$data["base_url"]=site_url("site/viewsubscribejson");
$data["title"]="View subscribe";
$this->load->view("template",$data);
}
function viewsubscribejson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_subscribe`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`euro_subscribe`.`email`";
$elements[1]->sort="1";
$elements[1]->header="Email";
$elements[1]->alias="email";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_subscribe`");
$this->load->view("json",$data);
}

public function createsubscribe()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createsubscribe";
$data["title"]="Create subscribe";
$this->load->view("template",$data);
}
public function createsubscribesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createsubscribe";
$data["title"]="Create subscribe";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$email=$this->input->get_post("email");
if($this->subscribe_model->create($email,$timestamp)==0)
$data["alerterror"]="New subscribe could not be created.";
else
$data["alertsuccess"]="subscribe created Successfully.";
$data["redirect"]="site/viewsubscribe";
$this->load->view("redirect",$data);
}
}
public function editsubscribe()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editsubscribe";
$data["title"]="Edit subscribe";
$data["before"]=$this->subscribe_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editsubscribesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editsubscribe";
$data["title"]="Edit subscribe";
$data["before"]=$this->subscribe_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$email=$this->input->get_post("email");
$timestamp=$this->input->get_post("timestamp");
if($this->subscribe_model->edit($id,$email,$timestamp)==0)
$data["alerterror"]="New subscribe could not be Updated.";
else
$data["alertsuccess"]="subscribe Updated Successfully.";
$data["redirect"]="site/viewsubscribe";
$this->load->view("redirect",$data);
}
}
public function deletesubscribe()
{
$access=array("1");
$this->checkaccess($access);
$this->subscribe_model->delete($this->input->get("id"));
$data["redirect"]="site/viewsubscribe";
$this->load->view("redirect",$data);
}
public function viewhomepageimage()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="viewhomepageimage";
$data["base_url"]=site_url("site/viewhomepageimagejson");
$data["title"]="View homepageimage";
$this->load->view("template",$data);
}
function viewhomepageimagejson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_homepageimage`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`euro_homepageimage`.`image1`";
$elements[1]->sort="1";
$elements[1]->header="Image1";
$elements[1]->alias="image1";
$elements[2]=new stdClass();
$elements[2]->field="`euro_homepageimage`.`image2`";
$elements[2]->sort="1";
$elements[2]->header="Image2";
$elements[2]->alias="image2";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_homepageimage`");
$this->load->view("json",$data);
}

public function createhomepageimage()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="createhomepageimage";
$data["title"]="Create homepageimage";
$this->load->view("template",$data);
}
public function createhomepageimagesubmit()
{
$access=array("1");
$this->checkaccess($access);
$id=$this->input->get_post("id");
$link1=$this->input->get_post("link1");
$link2=$this->input->get_post("link2");
$link3=$this->input->get_post("link3");
$image1=$this->menu_model->createImage1();
$image2=$this->menu_model->createImage2();
$image3=$this->menu_model->createImage3();
//    echo $image1;
//    echo $image2;
//    echo $image3;
if($this->homepageimage_model->create($image1,$image2,$image3,$link1,$link2,$link3)==0)
$data["alerterror"]="New homepageimage could not be created.";
else
$data["alertsuccess"]="homepageimage created Successfully.";
$data["redirect"]="site/viewhomepageimage";
$this->load->view("redirect",$data);

}
public function edithomepageimage()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="edithomepageimage";
$data["title"]="Edit homepageimage";
$data["before"]=$this->homepageimage_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edithomepageimagesubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$id=$this->input->get_post("id");
$link1=$this->input->get_post("link1");
$link2=$this->input->get_post("link2");
$link3=$this->input->get_post("link3");
$image1=$this->menu_model->createImage1();
$image2=$this->menu_model->createImage2();
$image3=$this->menu_model->createImage3();
if($this->homepageimage_model->edit($id,$image1,$image2,$image3,$link1,$link2,$link3)==0)
$data["alerterror"]="New homepageimage could not be Updated.";
else
$data["alertsuccess"]="homepageimage Updated Successfully.";
$data["redirect"]="site/viewhomepageimage";
$this->load->view("redirect",$data);

}
public function deletehomepageimage()
{
$access=array("1");
$this->checkaccess($access);
$this->homepageimage_model->delete($this->input->get("id"));
$data["redirect"]="site/viewhomepageimage";
$this->load->view("redirect",$data);
}
public function viewexclusiveproduct()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="viewexclusiveproduct";
$data["base_url"]=site_url("site/viewexclusiveproductjson");
$data["title"]="View exclusiveproduct";
$this->load->view("template",$data);
}
function viewexclusiveproductjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_exclusiveproduct`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`euro_exclusiveproduct`.`image1`";
$elements[1]->sort="1";
$elements[1]->header="Image1";
$elements[1]->alias="image1";
$elements[2]=new stdClass();
$elements[2]->field="`euro_exclusiveproduct`.`image2`";
$elements[2]->sort="1";
$elements[2]->header="Image2";
$elements[2]->alias="image2";
$elements[3]=new stdClass();
$elements[3]->field="`euro_exclusiveproduct`.`link`";
$elements[3]->sort="1";
$elements[3]->header="link";
$elements[3]->alias="link";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_exclusiveproduct`");
$this->load->view("json",$data);
}

public function createexclusiveproduct()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="createexclusiveproduct";
$data["title"]="Create exclusiveproduct";
$this->load->view("template",$data);
}
public function createexclusiveproductsubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$id=$this->input->get_post("id");
$image1=$this->menu_model->createImage1();
$image2=$this->menu_model->createImage2();
$link=$this->input->get_post("link");
if($this->exclusiveproduct_model->create($image1,$image2,$link)==0)
$data["alerterror"]="New exclusiveproduct could not be created.";
else
$data["alertsuccess"]="exclusiveproduct created Successfully.";
$data["redirect"]="site/viewexclusiveproduct";
$this->load->view("redirect",$data);

}
public function editexclusiveproduct()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="editexclusiveproduct";
$data["title"]="Edit exclusiveproduct";
$data["before"]=$this->exclusiveproduct_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editexclusiveproductsubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("image1","Image1","trim");
$this->form_validation->set_rules("image2","Image2","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editexclusiveproduct";
$data["title"]="Edit exclusiveproduct";
$data["before"]=$this->exclusiveproduct_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$link=$this->input->get_post("link");
$config['upload_path'] = './uploads/';
 $config['allowed_types'] = 'gif|jpg|png';
 $this->load->library('upload', $config);
 $filename="image1";
 $image1="";
 if (  $this->upload->do_upload($filename))
 {
	 $uploaddata = $this->upload->data();
	 $image=$uploaddata['file_name'];
 }
if($image1=="")
			 {
			 $image1=$this->exclusiveproduct_model->getimagebyid($id);
				$image1=$image1->image1;
			 }
 $filename="image2";
 $image2="";
 if (  $this->upload->do_upload($filename))
 {
	 $uploaddata = $this->upload->data();
	 $image2=$uploaddata['file_name'];
 }
if($image2=="")
			 {
			 $image2=$this->exclusiveproduct_model->getimage2byid($id);
					// print_r($image);
					 $image2=$image2->image;
			 }

if($this->exclusiveproduct_model->edit($id,$image,$image2,$link)==0)
$data["alerterror"]="New exclusiveproduct could not be Updated.";
else
$data["alertsuccess"]="exclusiveproduct Updated Successfully.";
$data["redirect"]="site/viewexclusiveproduct";
$this->load->view("redirect",$data);
}
}
public function deleteexclusiveproduct()
{
$access=array("1");
$this->checkaccess($access);
$this->exclusiveproduct_model->delete($this->input->get("id"));
$data["redirect"]="site/viewexclusiveproduct";
$this->load->view("redirect",$data);
}
public function viewpopularproduct()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="viewpopularproduct";
$data["base_url"]=site_url("site/viewpopularproductjson");
$data["title"]="View popularproduct";
$this->load->view("template",$data);
}
function viewpopularproductjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_popularproduct`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`euro_popularproduct`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`euro_popularproduct`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`euro_popularproduct`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`euro_category`.`name`";
$elements[4]->sort="1";
$elements[4]->header="category";
$elements[4]->alias="category";
$elements[5]=new stdClass();
$elements[5]->field="`euro_popularproduct`.`link`";
$elements[5]->sort="1";
$elements[5]->header="link";
$elements[5]->alias="link";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_popularproduct` LEFT OUTER JOIN `euro_category` ON `euro_popularproduct`.`category`=`euro_category`.`id`");
$this->load->view("json",$data);
}

public function createpopularproduct()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="createpopularproduct";
$data['status'] =$this->user_model->getstatusdropdown();
$data['product'] =$this->product_model->getproductdropdown();
$data['category'] =$this->category_model->getcategorydropdown();
$data["title"]="Create popularproduct";
$this->load->view("template",$data);
}
public function createpopularproductsubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createpopularproduct";
$data['status'] =$this->user_model->getstatusdropdown();
$data['product'] =$this->product_model->getproductdropdown();
$data['category'] =$this->category_model->getcategorydropdown();
$data["title"]="Create popularproduct";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$category=$this->input->get_post("category");
$product=$this->input->get_post("product");
$link=$this->input->get_post("link");
$image=$this->menu_model->createImage();
$image2=$this->menu_model->createImage2();
if($this->popularproduct_model->create($order,$status,$category,$product,$image,$image2,$link)==0)
$data["alerterror"]="New popularproduct could not be created.";
else
$data["alertsuccess"]="popularproduct created Successfully.";
$data["redirect"]="site/viewpopularproduct";
$this->load->view("redirect",$data);
}
}
public function editpopularproduct()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="editpopularproduct";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data['category'] =$this->category_model->getcategorydropdown();
$data["title"]="Edit popularproduct";
$data["before"]=$this->popularproduct_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editpopularproductsubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editpopularproduct";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data['category'] =$this->category_model->getcategorydropdown();
$data["title"]="Edit popularproduct";
$data["before"]=$this->popularproduct_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$category=$this->input->get_post("category");
$link=$this->input->get_post("link");
$config['upload_path'] = './uploads/';
 $config['allowed_types'] = 'gif|jpg|png';
 $this->load->library('upload', $config);
 $filename="image";
 $image="";
 if (  $this->upload->do_upload($filename))
 {
	 $uploaddata = $this->upload->data();
	 $image=$uploaddata['file_name'];
 }
if($image=="")
			 {
			 $image=$this->popularproduct_model->getimagebyid($id);
				$image=$image->image;
			 }
 $filename="image2";
 $image2="";
 if (  $this->upload->do_upload($filename))
 {
	 $uploaddata = $this->upload->data();
	 $image2=$uploaddata['file_name'];
 }
if($image2=="")
			 {
			 $image2=$this->popularproduct_model->getimage2byid($id);
					// print_r($image);
					 $image2=$image2->image;
			 }
if($this->popularproduct_model->edit($id,$order,$category,$status,$image,$image2,$link)==0)
$data["alerterror"]="New popularproduct could not be Updated.";
else
$data["alertsuccess"]="popularproduct Updated Successfully.";
$data["redirect"]="site/viewpopularproduct";
$this->load->view("redirect",$data);
}
}
public function deletepopularproduct()
{
$access=array("1");
$this->checkaccess($access);
$this->popularproduct_model->delete($this->input->get("id"));
$data["redirect"]="site/viewpopularproduct";
$this->load->view("redirect",$data);
}
public function viewcategory()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="viewcategory";
$data["base_url"]=site_url("site/viewcategoryjson");
$data["title"]="View category";
$this->load->view("template",$data);
}
function viewcategoryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_category`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`euro_category`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`euro_category`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`euro_category`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";
$elements[4]=new stdClass();
$elements[4]->field="`euro_category`.`banner`";
$elements[4]->sort="1";
$elements[4]->header="Banner";
$elements[4]->alias="banner";
$elements[5]=new stdClass();
$elements[5]->field="`euro_category`.`image`";
$elements[5]->sort="1";
$elements[5]->header="Image";
$elements[5]->alias="image";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_category`");
$this->load->view("json",$data);
}

public function createcategory()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="createcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create category";
$this->load->view("template",$data);
}
public function createcategorysubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("banner","Banner","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create category";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
//$banner=$this->input->get_post("banner");
$image=$this->menu_model->createImage();
$image2=$this->menu_model->createImage2();
$banner=$this->menu_model->createBanner();
$banner2=$this->menu_model->createBanner2();
//$pdfdownload=$this->menu_model->createPDF();
// $pdfdownload=$this->input->get_post("pdfdownload");
$config['upload_path'] = './uploads/';
$config['allowed_types'] = '*';
$this->load->library('upload', $config);
$filename="pdfdownload";
$pdfdownload="";

if (  $this->upload->do_upload($filename))
{
$uploaddata = $this->upload->data();
$pdfdownload=$uploaddata['file_name'];

		$config_r['source_pdf']   = './uploads/' . $uploaddata['file_name'];

}

$config['upload_path'] = './uploads/';
$config['allowed_types'] = 'gif|jpg|png|jpeg';
$this->load->library('upload', $config);
$filename="defaultimage";
$defaultimage="";
if (  $this->upload->do_upload($filename))
{
$uploaddata = $this->upload->data();
$defaultimage=$uploaddata['file_name'];

		$config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
		$config_r['maintain_ratio'] = TRUE;
		$config_t['create_thumb'] = FALSE;///add this
		$config_r['quality']    = 100;
		//end of configs

		$this->load->library('image_lib', $config_r);
		$this->image_lib->initialize($config_r);
		if(!$this->image_lib->resize())
		{
				echo "Failed." . $this->image_lib->display_errors();
				//return false;
		}
		else
		{
				//print_r($this->image_lib->dest_image);
				//dest_image
				$defaultimage=$this->image_lib->dest_image;
				//return false;
		}

}


if($this->category_model->create($order,$status,$name,$banner,$banner2,$image,$image2,$pdfdownload,$defaultimage)==0)
$data["alerterror"]="New category could not be created.";
else
$data["alertsuccess"]="category created Successfully.";
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
}
public function editcategory()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="editcategory";
$data["title"]="Edit category";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->category_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcategorysubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("banner","Banner","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("pdfdownload","Pdf download","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit category";
$data["before"]=$this->category_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
// $image=$this->menu_model->createImage();
// $image2=$this->menu_model->createImage2();
// $banner=$this->menu_model->createBanner();
// $banner2=$this->menu_model->createBanner2();
$config['upload_path'] = './uploads/';
 $config['allowed_types'] = 'gif|jpg|png';
 $this->load->library('upload', $config);
 $filename="image";
 $image="";
 if (  $this->upload->do_upload($filename))
 {
	 $uploaddata = $this->upload->data();
	 $image=$uploaddata['file_name'];
 }
if($image=="")
			 {
			 $image=$this->category_model->getimagebyid($id);
				$image=$image->image;
			 }
 $filename="image2";
 $image2="";
 if (  $this->upload->do_upload($filename))
 {
	 $uploaddata = $this->upload->data();
	 $image2=$uploaddata['file_name'];
 }
if($image2=="")
			 {
			 $image2=$this->category_model->getimage2byid($id);
					// print_r($image);
					 $image2=$image2->image2;
			 }

			 $filename="banner";
			 $banner="";
			 if (  $this->upload->do_upload($filename))
			 {
				 $uploaddata = $this->upload->data();
				 $banner=$uploaddata['file_name'];
			 }
			if($banner=="")
						 {
						 $banner=$this->category_model->getimage2byid($id);
								// print_r($image);
								 $banner=$banner->banner;
						 }

						 $filename="banner2";
						 $banner2="";
						 if (  $this->upload->do_upload($filename))
						 {
							 $uploaddata = $this->upload->data();
							 $banner2=$uploaddata['file_name'];
						 }
						if($banner2=="")
									 {
									 $banner2=$this->category_model->getimage2byid($id);
											// print_r($image);
											 $banner2=$banner2->banner2;
									 }
									 $filename="pdfdownload";
									 $pdfdownload="";
									 if (  $this->upload->do_upload($filename))
									 {
										 $uploaddata = $this->upload->data();
										 $pdfdownload=$uploaddata['file_name'];
										 	print_r($pdfdownload);
									 }
									if($pdfdownload=="")
												 {
												 $pdfdownload=$this->category_model->getpdfbyid($id);
														print_r($pdfdownload);
														 $pdfdownload=$pdfdownload->pdfdownload;
												 }




												 $config['upload_path'] = './uploads/';
											 $config['allowed_types'] = 'gif|jpg|png|jpeg';
											 $this->load->library('upload', $config);
											 $filename="defaultimage";
											 $defaultimage="";
											 if (  $this->upload->do_upload($filename))
											 {
											 $uploaddata = $this->upload->data();
											 $defaultimage=$uploaddata['file_name'];

											 			$config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
											 			$config_r['maintain_ratio'] = TRUE;
											 			$config_t['create_thumb'] = FALSE;///add this
											 			$config_r['width']   = 800;
											 			$config_r['height'] = 800;
											 			$config_r['quality']    = 100;
											 			//end of configs

											 			$this->load->library('image_lib', $config_r);
											 			$this->image_lib->initialize($config_r);
											 			if(!$this->image_lib->resize())
											 			{
											 					echo "Failed." . $this->image_lib->display_errors();
											 					//return false;
											 			}
											 			else
											 			{
											 					//print_r($this->image_lib->dest_image);
											 					//dest_image
											 					$defaultimage=$this->image_lib->dest_image;
											 					//return false;
											 			}

											 }

											 	if($defaultimage=="")
											 	{
											 	$defaultimage=$this->category_model->getdefaultimagebyid($id);
											 		 // print_r($image);
											 			$defaultimage=$defaultimage->defaultimage;
											 	}
if($this->category_model->edit($id,$order,$status,$name,$banner,$banner2,$image,$image2,$pdfdownload,$defaultimage)==0)
$data["alerterror"]="New category could not be Updated.";
else
$data["alertsuccess"]="category Updated Successfully.";
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
}
public function deletecategory()
{
$access=array("1");
$this->checkaccess($access);
$this->category_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
public function viewgallery()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="viewgallery";
$data["base_url"]=site_url("site/viewgalleryjson");
$data["title"]="View gallery";
$this->load->view("template",$data);
}
function viewgalleryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_gallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`euro_gallery`.`category`";
$elements[1]->sort="1";
$elements[1]->header="Category";
$elements[1]->alias="category";
$elements[2]=new stdClass();
$elements[2]->field="`euro_gallery`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`euro_gallery`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_gallery`");
$this->load->view("json",$data);
}

public function creategallery()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="creategallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'category' ] =$this->category_model->getdropdown();
$data["title"]="Create gallery";
$this->load->view("template",$data);
}
public function creategallerysubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="creategallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'category' ] =$this->category_model->getdropdown();
$data["title"]="Create gallery";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$category=$this->input->get_post("category");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$image=$this->menu_model->createImage();
if($this->gallery_model->create($category,$order,$status,$image)==0)
$data["alerterror"]="New gallery could not be created.";
else
$data["alertsuccess"]="gallery created Successfully.";
$data["redirect"]="site/viewgallery";
$this->load->view("redirect",$data);
}
}
public function editgallery()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="editgallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'category' ] =$this->category_model->getdropdown();
$data["title"]="Edit gallery";
$data["before"]=$this->gallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editgallerysubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editgallery";
$data[ 'category' ] =$this->category_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit gallery";
$data["before"]=$this->gallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$category=$this->input->get_post("category");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$image=$this->menu_model->createImage();
if($this->gallery_model->edit($id,$category,$order,$status,$image)==0)
$data["alerterror"]="New gallery could not be Updated.";
else
$data["alertsuccess"]="gallery Updated Successfully.";
$data["redirect"]="site/viewgallery";
$this->load->view("redirect",$data);
}
}
public function deletegallery()
{
$access=array("1");
$this->checkaccess($access);
$this->gallery_model->delete($this->input->get("id"));
$data["redirect"]="site/viewgallery";
$this->load->view("redirect",$data);
}
public function viewsubcategory()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="viewsubcategory";
$data["base_url"]=site_url("site/viewsubcategoryjson");
$data["title"]="View subcategory";
$this->load->view("template",$data);
}
function viewsubcategoryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_subcategory`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`euro_subcategory`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`euro_subcategory`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`euro_category`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Category";
$elements[3]->alias="category";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_subcategory` LEFT OUTER JOIN `euro_category` ON `euro_category`.`id`=`euro_subcategory`.`category`");
$this->load->view("json",$data);
}

public function createsubcategory()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="createsubcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'category' ] =$this->category_model->getdropdown();
$data["title"]="Create subcategory";
$this->load->view("template",$data);
}
public function createsubcategorysubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createsubcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'category' ] =$this->category_model->getdropdown();
$data["title"]="Create subcategory";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$category=$this->input->get_post("category");
$name=$this->input->get_post("name");
if($this->subcategory_model->create($order,$status,$category,$name)==0)
$data["alerterror"]="New subcategory could not be created.";
else
$data["alertsuccess"]="subcategory created Successfully.";
$data["redirect"]="site/viewsubcategory";
$this->load->view("redirect",$data);
}
}
public function editsubcategory()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="editsubcategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'category' ] =$this->category_model->getdropdown();
$data["title"]="Edit subcategory";
$data["before"]=$this->subcategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editsubcategorysubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editsubcategory";
$data[ 'category' ] =$this->category_model->getdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit subcategory";
$data["before"]=$this->subcategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$category=$this->input->get_post("category");
$name=$this->input->get_post("name");
if($this->subcategory_model->edit($id,$order,$status,$category,$name)==0)
$data["alerterror"]="New subcategory could not be Updated.";
else
$data["alertsuccess"]="subcategory Updated Successfully.";
$data["redirect"]="site/viewsubcategory";
$this->load->view("redirect",$data);
}
}
public function deletesubcategory()
{
$access=array("1");
$this->checkaccess($access);
$this->subcategory_model->delete($this->input->get("id"));
$data["redirect"]="site/viewsubcategory";
$this->load->view("redirect",$data);
}
public function viewproduct()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="viewproduct";
$data["base_url"]=site_url("site/viewproductjson");
$data["title"]="View product";
$this->load->view("template",$data);
}
function viewproductjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_product`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`euro_product`.`category`";
$elements[1]->sort="1";
$elements[1]->header="Category";
$elements[1]->alias="category";
$elements[2]=new stdClass();
$elements[2]->field="`euro_product`.`subcategory`";
$elements[2]->sort="1";
$elements[2]->header="Sub category";
$elements[2]->alias="subcategory";
$elements[3]=new stdClass();
$elements[3]->field="`euro_product`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";
$elements[4]=new stdClass();
$elements[4]->field="`euro_product`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_product`");
$this->load->view("json",$data);
}

public function createproduct()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="createproduct";
$data[ 'category' ] =$this->category_model->getdropdown();
$data[ 'subcategory' ] =$this->subcategory_model->getdropdown();
$data["title"]="Create product";
$this->load->view("template",$data);
}
public function createproductsubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("subcategory","Sub category","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("size","Size","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createproduct";
$data[ 'category' ] =$this->category_model->getdropdown();
$data[ 'subcategory' ] =$this->subcategory_model->getdropdown();
$data["title"]="Create product";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$category=$this->input->get_post("category");
$subcategory=$this->input->get_post("subcategory");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$size=$this->input->get_post("size");
if($this->product_model->create($order,$category,$subcategory,$name,$image,$size)==0)
$data["alerterror"]="New product could not be created.";
else
$data["alertsuccess"]="product created Successfully.";
$data["redirect"]="site/viewproduct";
$this->load->view("redirect",$data);
}
}
public function editproduct()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="editproduct";
$data[ 'category' ] =$this->category_model->getdropdown();
$data[ 'subcategory' ] =$this->subcategory_model->getdropdown();
$data["title"]="Edit product";
$data["before"]=$this->product_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editproductsubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("category","Category","trim");
$this->form_validation->set_rules("subcategory","Sub category","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("size","Size","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editproduct";
$data[ 'category' ] =$this->category_model->getdropdown();
$data[ 'subcategory' ] =$this->subcategory_model->getdropdown();
$data["title"]="Edit product";
$data["before"]=$this->product_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$category=$this->input->get_post("category");
$subcategory=$this->input->get_post("subcategory");
$name=$this->input->get_post("name");
$image=$this->menu_model->createImage();
$size=$this->input->get_post("size");
if($this->product_model->edit($id,$order,$category,$subcategory,$name,$image,$size)==0)
$data["alerterror"]="New product could not be Updated.";
else
$data["alertsuccess"]="product Updated Successfully.";
$data["redirect"]="site/viewproduct";
$this->load->view("redirect",$data);
}
}
public function deleteproduct()
{
$access=array("1");
$this->checkaccess($access);
$this->product_model->delete($this->input->get("id"));
$data["redirect"]="site/viewproduct";
$this->load->view("redirect",$data);
}
public function viewdownload()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="viewdownload";
$data["base_url"]=site_url("site/viewdownloadjson");
$data["title"]="View Download";
$this->load->view("template",$data);
}
function viewdownloadjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`download`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`download`.`image`";
$elements[1]->sort="1";
$elements[1]->header="Image";
$elements[1]->alias="image";
$elements[2]=new stdClass();
$elements[2]->field="`download`.`pdf`";
$elements[2]->sort="1";
$elements[2]->header="pdf";
$elements[2]->alias="pdf";
$elements[3]=new stdClass();
$elements[3]->field="`download`.`order`";
$elements[3]->sort="1";
$elements[3]->header="order";
$elements[3]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `download`");
$this->load->view("json",$data);
}

public function createdownload()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="createdownload";
$data["title"]="Create Download";
$this->load->view("template",$data);
}
public function createdownloadsubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$id=$this->input->get_post("id");
// $image=$this->menu_model->createImage1();
$order=$this->input->get_post("order");

$config['upload_path'] = './uploads/';
 $config['allowed_types'] = '*';
 $this->load->library('upload', $config);
 $filename="pdf";
 $pdf="";
 if (  $this->upload->do_upload($filename))
 {
	 $uploaddata = $this->upload->data();
	 $pdf=$uploaddata['file_name'];
 }

$image=$this->menu_model->createImage1();
if($this->download_model->create($image,$pdf,$order)==0)
$data["alerterror"]="New Download could not be created.";
else
$data["alertsuccess"]="Download created Successfully.";
$data["redirect"]="site/viewdownload";
$this->load->view("redirect",$data);

}
public function editdownload()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="editdownload";
$data["title"]="Edit Download";
$data["before"]=$this->download_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editdownloadsubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("image1","Image1","trim");
$this->form_validation->set_rules("image2","Image2","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editdownload";
$data["title"]="Edit Download";
$data["before"]=$this->download_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$config['upload_path'] = './uploads/';
 $config['allowed_types'] = '*';
 $this->load->library('upload', $config);
 $filename="image";
 $image="";
 if (  $this->upload->do_upload($filename))
 {
	 $uploaddata = $this->upload->data();
	 $image=$uploaddata['file_name'];
 }
if($image=="")
			 {
			 $image=$this->exclusiveproduct_model->getimagebyid($id);
				$image=$image->image;
			 }
 $filename="pdf";
 $pdf="";
 if (  $this->upload->do_upload($filename))
 {
	 $uploaddata = $this->upload->data();
	 $pdf=$uploaddata['file_name'];
 }


if($this->download_model->edit($id,$image,$pdf,$order)==0)
$data["alerterror"]="New Download could not be Updated.";
else
$data["alertsuccess"]="Download Updated Successfully.";
$data["redirect"]="site/viewdownload";
$this->load->view("redirect",$data);
}
}
public function deletedownload()
{
$access=array("1");
$this->checkaccess($access);
$this->download_model->delete($this->input->get("id"));
$data["redirect"]="site/viewdownload";
$this->load->view("redirect",$data);
}

       // contact

    function viewcontact()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewcontact';
        $data["base_url"]=site_url("site/viewcontactjson");
		$data['title']='View Contact';
		$this->load->view('template',$data);
	}
    public function editcontact()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="editcontact";
    $data["title"]="Edit Contact";
    $data["before"]=$this->newsletter_model->beforeeditcontact($this->input->get("id"));
    $this->load->view("template",$data);
}
    function viewcontactjson()
{
    $elements=array();
    $elements[0]=new stdClass();
    $elements[0]->field="`contact`.`id`";
    $elements[0]->sort="1";
    $elements[0]->header="ID";
    $elements[0]->alias="id";
    $elements[1]=new stdClass();
    $elements[1]->field="`contact`.`email`";
    $elements[1]->sort="1";
    $elements[1]->header="Email Id";
    $elements[1]->alias="email";
    $elements[2]=new stdClass();
    $elements[2]->field="`contact`.`telephone`";
    $elements[2]->sort="1";
    $elements[2]->header="Contact";
    $elements[2]->alias="telephone";
    $elements[3]=new stdClass();
    $elements[3]->field="`contact`.`comment`";
    $elements[3]->sort="1";
    $elements[3]->header="Comment";
    $elements[3]->alias="comment";

    $elements[4]=new stdClass();
    $elements[4]->field="`contact`.`name`";
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
    $maxrow=20;
    }
    if($orderby=="")
    {
    $orderby="id";
    $orderorder="ASC";
    }
    $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `contact`");
    $this->load->view("json",$data);
}

public function viewnotification()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewnotification";
$data["base_url"]=site_url("site/viewnotificationjson");
$data["title"]="View notification";
$this->load->view("template",$data);
}
function viewnotificationjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`notification`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`notification`.`email`";
$elements[1]->sort="1";
$elements[1]->header="Email";
$elements[1]->alias="email";
$elements[2]=new stdClass();
$elements[2]->field="`notification`.`timestamp`";
$elements[2]->sort="1";
$elements[2]->header="Timestamp";
$elements[2]->alias="timestamp";
$elements[3]=new stdClass();
$elements[3]->field="`notification`.`text`";
$elements[3]->sort="1";
$elements[3]->header="Text";
$elements[3]->alias="text";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `notification`");
$this->load->view("json",$data);
}

public function createnotification()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createnotification";
$data["title"]="Create notification";
$this->load->view("template",$data);
}
public function createnotificationsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createnotification";
$data["title"]="Create notification";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$email=$this->input->get_post("email");
$text=$this->input->get_post("text");
$order=$this->input->get_post("order");
if($this->notification_model->create($email,$timestamp,$text,$order)==0)
$data["alerterror"]="New notification could not be created.";
else
$data["alertsuccess"]="notification created Successfully.";
$data["redirect"]="site/viewnotification";
$this->load->view("redirect",$data);
}
}
public function editnotification()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editnotification";
$data["title"]="Edit notification";
$data["before"]=$this->notification_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editnotificationsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editnotification";
$data["title"]="Edit notification";
$data["before"]=$this->notification_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$email=$this->input->get_post("email");
$text=$this->input->get_post("text");
$order=$this->input->get_post("order");
$timestamp=$this->input->get_post("timestamp");
if($this->notification_model->edit($id,$email,$timestamp,$text,$order)==0)
$data["alerterror"]="New notification could not be Updated.";
else
$data["alertsuccess"]="notification Updated Successfully.";
$data["redirect"]="site/viewnotification";
$this->load->view("redirect",$data);
}
}
public function deletenotification()
{
$access=array("1");
$this->checkaccess($access);
$this->notification_model->delete($this->input->get("id"));
$data["redirect"]="site/viewnotification";
$this->load->view("redirect",$data);
}
public function viewarrival()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="viewarrival";
$data["base_url"]=site_url("site/viewarrivaljson");
$data["title"]="View arrival";
$this->load->view("template",$data);
}
function viewarrivaljson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`euro_arrival`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`euro_arrival`.`image1`";
$elements[1]->sort="1";
$elements[1]->header="Image1";
$elements[1]->alias="image1";
// $elements[2]=new stdClass();
// $elements[2]->field="`euro_arrival`.`image2`";
// $elements[2]->sort="1";
// $elements[2]->header="Image2";
// $elements[2]->alias="image2";
$elements[3]=new stdClass();
$elements[3]->field="`euro_arrival`.`order`";
$elements[3]->sort="1";
$elements[3]->header="order";
$elements[3]->alias="order";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `euro_arrival`");
$this->load->view("json",$data);
}

public function createarrival()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="createarrival";
$data["title"]="Create arrival";
$this->load->view("template",$data);
}
public function createarrivalsubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$link=$this->input->get_post("link");
// $image1=$this->menu_model->createImage1();
// $image2=$this->menu_model->createImage2();
$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->load->library('upload', $config);
				$filename = 'image';
				$image = '';
				if ($this->upload->do_upload($filename)) {
						$uploaddata = $this->upload->data();
						$image1 = $uploaddata['file_name'];
				}
				// $filename = 'image2';
				// $image2 = '';
				// if ($this->upload->do_upload($filename)) {
				// 		$uploaddata = $this->upload->data();
				// 		$image2 = $uploaddata['file_name'];
				// }
$order=$this->input->get_post("order");

if($this->arrival_model->create($image1,$order,$link)==0)
$data["alerterror"]="New arrival could not be created.";
else
 $data["alertsuccess"]="arrival created Successfully.";
$data["redirect"]="site/viewarrival";
$this->load->view("redirect",$data);

}
public function editarrival()
{
$access=array("1","2");
$this->checkaccess($access);
$data["page"]="editarrival";
$data["title"]="Edit arrival";
$data["before"]=$this->arrival_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editarrivalsubmit()
{
$access=array("1","2");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("image1","Image1","trim");
$this->form_validation->set_rules("image2","Image2","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editarrival";
$data["title"]="Edit arrival";
$data["before"]=$this->arrival_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$link=$this->input->get_post("link");
$config['upload_path'] = './uploads/';
 $config['allowed_types'] = '*';
 $this->load->library('upload', $config);
 $filename="image1";
 $image1="";
 if ($this->upload->do_upload($filename))
 {
	 $uploaddata = $this->upload->data();
	 $image1=$uploaddata['file_name'];
 }
if($image1=="")
			 {
			 $image1=$this->arrival_model->getimagebyid($id);
				$image1=$image1->image1;
			 }
//  $filename="image2";
//  $image2="";
//  if (  $this->upload->do_upload($filename))
//  {
// 	 $uploaddata = $this->upload->data();
// 	 $image2=$uploaddata['file_name'];
//  }
// if($image2=="")
// 			 {
// 			 $image2=$this->arrival_model->getimage2byid($id);
// 					// print_r($image);
// 					 $image2=$image2->image;
// 			 }


if($this->arrival_model->edit($id,$image1,$order,$link)==0)
$data["alerterror"]="New arrival could not be Updated.";
else
$data["alertsuccess"]="arrival Updated Successfully.";
$data["redirect"]="site/viewarrival";
$this->load->view("redirect",$data);
}
}
public function deletearrival()
{
$access=array("1");
$this->checkaccess($access);
$this->arrival_model->delete($this->input->get("id"));
$data["redirect"]="site/viewarrival";
$this->load->view("redirect",$data);
}

}
