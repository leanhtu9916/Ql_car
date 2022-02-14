<?php 
	/**
	 * 
	 */ 
	require('models/model.php');
	class Controller
	{
		
		private $model;
		public function __construct()
		{
			// tạo một đối tượng có thể truy xuất vào file model là this->model
			$this->model = new Model();
		}
		public function Login()
		{
			// triệu hồi file giao diện đăng nhập
			include_once("views/login.php");
		}
		public function Signin()
		{
			// Tạo các biến để nhận giá trị ng dùng nhập vào
			$username = $_POST['username'];
			$password = $_POST['password'];
			$username = addslashes($username);
			$username = strip_tags($username);
			$password = addslashes($password);
			$password = strip_tags($password);

			if($username != "" && $password != ""){
				$password = md5($password);
				$signin = $this->model->Signin($username, $password);
				// nếu câu truy vấn trả về là có bản ghi thì tài khoản đó tồn tại trong CSDL
				// còn nếu ko có bản ghi thì tài khoản đó ko tồn tại trong CSDL.
				// sau đó kiểm tra số bản ghi trả về có lớn hơn 0 hay ko . 
				$num_rows = $signin->num_rows; 
				if($num_rows > 0){
					while ($data = $signin->fetch_array()) {
						$_SESSION["id_user"] = $data['id_user'];
						$_SESSION["permission"] = $data['permission'];
						$_SESSION["fullname"] = $data['fullname'];
						$_SESSION["dateofbirth"] = $data['dateofbirth'];
						$_SESSION["mail"] = $data['mail'];
						$_SESSION["phone"] = $data['phone'];
						$_SESSION["adress"] = $data['adress'];
						$_SESSION["room"] = $data['room'];
						$_SESSION["location"] = $data['location'];
						$_SESSION["avata"] = $data['avata'];
						$_SESSION["debt"] = $data['debt'];
					}
					header("location:index.php");
				}
				else{
					$_SESSION['error'] = "(Tên đăng nhập hoặc mật khẩu không đúng!)";
					header("location:index.php?action=login");
				}
			}
		}
		public function Logout()
		{
			session_destroy();
			header("location:?action=login");
		}
		public function Homepage()
		{
			$xemoi = $this->model->Xemoi();
			$mediumSUV = $this->model->MediumSUV();
			$sport = $this->model->Sport();
			$pickupTruct = $this->model->PickUpTruct();
			$sedan = $this->model->Sedan();
			$largeSUV = $this->model->LargeSUV();
			$phukien = $this->model->Phukien();
			// $id_user = $_SESSION['id_user'];
			// $qty = $this->model->Qty($id_user);
			// $tong = 0;
			// while ($qty_cart = $qty->fetch_array()) {
			// 	$tong =$tong + $qty_cart['price'] * $qty_cart['qty'];
			// }
			include_once("views/homepage.php");
		}
		public function Gioithieu()
		{
			include_once("views/gioithieu.php");
		}
		public function Search()
		{
			if(isset($_POST['search'])){
				$key = $_POST['key'];
			} else{
				$key = $_GET["key"];
			}
			$key = strip_tags($key);
			$key = addslashes($key);

			// $key = $_POST['key'];
			// $key = addslashes($key);
			// $key = strip_tags($key);
			$search = $this->model->Search($key);
			$tongso = $search->num_rows;
			$sotk1trang = 18;
			$sotrang = ceil($tongso/$sotk1trang);
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			else{
				$page = 1;
			}
			$form = ($page-1)*$sotk1trang;
			$home = $this->model->home($key,$form,$sotk1trang);
			include_once("views/timkiem.php");
		}
		public function Xemoi_home()
		{
			$key = "Xe mới";
			$search = $this->model->Xemoi_home();
			$tongso = $search->num_rows;
			$sotk1trang = 18;
			$sotrang = ceil($tongso/$sotk1trang);
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			else{
				$page = 1;
			}
			$form = ($page-1)*$sotk1trang;
			$home = $this->model->Xemoi_homee($form,$sotk1trang);
			include_once("views/timkiem.php");
		}
		public function MediumSUV_home()
		{
			$key = "dòng xe Medium SUV";
			$search = $this->model->MediumSUV_home();
			$tongso = $search->num_rows;
			$sotk1trang = 18;
			$sotrang = ceil($tongso/$sotk1trang);
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			else{
				$page = 1;
			}
			$form = ($page-1)*$sotk1trang;
			$home = $this->model->MediumSUV_homee($form,$sotk1trang);
			include_once("views/timkiem.php");
		}
		public function Sport_home()
		{
			$key = "DÒng xe Sport";
			$search = $this->model->Sport_home();
			$tongso = $search->num_rows;
			$sotk1trang = 18;
			$sotrang = ceil($tongso/$sotk1trang);
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			else{
				$page = 1;
			}
			$form = ($page-1)*$sotk1trang;
			$home = $this->model->Sport_homee($form,$sotk1trang);
			include_once("views/timkiem.php");
		}
		public function PickUpTruct_home()
		{
			$key = "Dòng xe bán tải ";
			$search = $this->model->PickUpTruct_home();
			$tongso = $search->num_rows;
			$sotk1trang = 18;
			$sotrang = ceil($tongso/$sotk1trang);
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			else{
				$page = 1;
			}
			$form = ($page-1)*$sotk1trang;
			$home = $this->model->PickUpTruct_homee($form,$sotk1trang);
			include_once("views/timkiem.php");
		}
		public function Sedan_home()
		{
			$key = "DÒng xe Sedan";
			$search = $this->model->Sedan_home();
			$tongso = $search->num_rows;
			$sotk1trang = 18;
			$sotrang = ceil($tongso/$sotk1trang);
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			else{
				$page = 1;
			}
			$form = ($page-1)*$sotk1trang;
			$home = $this->model->Sedan_homee($form,$sotk1trang);
			include_once("views/timkiem.php");
		}
		public function LargeSUV_home()
		{
			$key = "dòng xe Large SUV";
			$search = $this->model->LargeSUV_home();
			$tongso = $search->num_rows;
			$sotk1trang = 18;
			$sotrang = ceil($tongso/$sotk1trang);
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			else{
				$page = 1;
			}
			$form = ($page-1)*$sotk1trang;
			$home = $this->model->LargeSUV_homee($form,$sotk1trang);
			include_once("views/timkiem.php");
		}
		public function Phukien_home()
		{
			$key = "Phụ kiện ô tô";
			$search = $this->model->Phukien_home();
			$tongso = $search->num_rows;
			$sotk1trang = 18;
			$sotrang = ceil($tongso/$sotk1trang);
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			else{
				$page = 1;
			}
			$form = ($page-1)*$sotk1trang;
			$home = $this->model->Phukien_homee($form,$sotk1trang);
			include_once("views/timkiem.php");
		}
		public function Infor()
		{
			$id_user = $_SESSION["id_user"];
			$infor = $this->model->Infor($id_user);
			include_once("views/infor.php");
		}
		public function Infor_product()
		{
			$id = $_GET['id'];
			$product = $this->model->Infor_product($id);
			$id_category = $this->model->Get_id_category($id)['id_category'];
			$products = $this->model->Products($id_category);
			$qty_comment = $this->model->Qty_comment($id)['qty_comment'];
			$comment = $this->model->Comment($id);
			// $id_user = $_SESSION['id_user'];
			// $qty = $this->model->Qty($id_user);
			// $tong = 0;
			// while ($qty_cart = $qty->fetch_array()) {
			// 	$tong =$tong + $qty_cart['price'] * $qty_cart['qty'];
			// }
			include_once("views/product.php");
		}
		public function Comment()
		{
			if(isset($_SESSION['id_user'])){
				$id_user = $_SESSION['id_user'];
				$star = $_POST['star'];
				$id_product = $_POST['id_product'];
				$comment = $_POST['comment'];
				$comment = addslashes($comment);
				$comment = strip_tags($comment);
				if($star != null && $comment != null){
					$this->model->Add_comment($id_user,$id_product,$comment,$star);
					header("location:?action=infor_product&id=$id_product");
				}
				else{
					echo "string";
				}
			}
		}
		public function Cart()
		{
			$id_user = $_SESSION['id_user'];
			$cart = $this->model->Cart($id_user);
			$qty = $this->model->Qty($id_user);
			$tong = 0;
			while ($qty_cart = $qty->fetch_array()) {
				$tong =$tong + $qty_cart['price'] * $qty_cart['qty'];
			}
			include_once("views/cart.php");
		}
		public function Add_to_cart()
		{
			$id_user = $_SESSION['id_user'];
			$id_product = $_GET['id'];
			$get_id_cart = $this->model->Get_id_cart($id_user);
			$get_id = $get_id_cart->num_rows;

			if($get_id == 0){
				$this->model->Add_id_cart($id_user);
				$get_id_cart = $this->model->Get_id_cart($id_user);
			}
			$id_cart = $get_id_cart->fetch_array()['id_cart'];
			$this->model->Add_cart($id_cart, $id_product);
			
			header("location:?action=cart");
		}
		public function Add_to_carts()
		{
			$id_user = $_SESSION['id_user'];
			$id_product = $_GET['id'];
			$get_id_cart = $this->model->Get_id_cart($id_user);
			$get_id = $get_id_cart->num_rows;

			if($get_id == 0){
				$this->model->Add_id_cart($id_user);
				$get_id_cart = $this->model->Get_id_cart($id_user);
			}
			$id_cart = $get_id_cart->fetch_array()['id_cart'];
			$qty_cart = $_POST['qty_cart'];
			$this->model->Add_carts($id_cart, $id_product, $qty_cart);
			header("location:?action=cart");
		}
		public function Update_carts()
		{
			$id_product = $_POST['id_product'];
			$qty_cart = $_POST['qty_cart'];
			$this->model->Update_carts($id_product, $qty_cart);
			header("location:?action=cart");
		}
		public function Delete_cart()
		{
			$id_product = $_GET['id'];
			$this->model->Delete_cart($id_product);
			header("location:?action=cart");
		}

		public function Order()
		{
			$id_user = $_SESSION['id_user'];
			$cart = $this->model->Cart($id_user);
			$qty = $this->model->Qty($id_user);
			$tong = 0;
			while ($qty_cart = $qty->fetch_array()) {
				$tong =$tong + $qty_cart['price'] * $qty_cart['qty'];
			}
			$location = $this->model->Location();
			include_once("views/order.php");
		}
		public function Order_ok()
		{
			$id_user = $_SESSION['id_user'];
			$address_order = $_POST['address_order'];
			$id_location = $_POST['id_location'];
			$id_methods = $_POST['id_methods'];
			$price_order = $_POST['price_order'];
			$note = $_POST['note'];
			$phone = $_POST['phone'];
			$this->model->Order_ok($id_user, $address_order, $id_location, $id_methods, $price_order, $note, $phone);
			$get_order = $this->model->Get_order($id_user);
			$id_order = $get_order->fetch_array()['id_order'];
			$get_id_cart = $this->model->get_id_cart($id_user);
			$id_cart = $get_id_cart->fetch_array()['id_cart'];
			$cart_detail = $this->model->Cart_detail($id_cart);
			foreach ($cart_detail as $key => $value) {
				$id_product = $value['id_product'];
				$qty = $value['qty'];
				$this->model->Add_to_order_detail($id_order, $id_product, $qty);
			}
			$this->model->Delete_cart_order($id_cart);

			$bill = $this->model->Bill($id_order);

			$bill_detail = $this->model->Bill_detail($id_order);

			$qty = $this->model->Qty_order($id_order);
			$tong = 0;
			while ($qty_order = $qty->fetch_array()) {
				$tong =$tong + $qty_order['price'] * $qty_order['qty'];
			}

			include_once("views/bill.php");
		}
		public function Bill()
		{
			$id_user = $_SESSION['id_user'];
			$bill = $this->model->Detail_bill($id_user);
			include_once("views/history.php");
		}
		public function Changepass()
		{
			include_once("views/changepass.php");
		}
		public function Confirm()
		{
			$id_order = $_GET['id_order'];
			$this->model->Confirm($id_order);
			header("location:?action=bill");
		}
	}

 ?>