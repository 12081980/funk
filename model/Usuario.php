class Usuario {
private $conn;

public function __construct($db_name, $db_host, $db_user, $db_pass) {

$this->conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($this->conn->connect_error) {
die("Connection failed: " . $this->conn->connect_error);
}
}

public function buscarUsuarioPorId($id) {
$stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

return $result->fetch_assoc();
}


}