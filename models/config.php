<!-- file này bỏ -->

private $conn;
		public function __construct()
		{
			$host = "localhost";
			$username = "root";
			$password = "";
			$database = "ql_car";

			$this->conn= new mysqli($host, $username, $password, $database) or die('Loi ket noi');
			$this->conn->set_charset("UTF8");
			//$this->conn->close();
		}