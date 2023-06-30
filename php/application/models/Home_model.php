<? class Home_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function ingresar($email, $pass)
  {
    $query = $this->db->query("SELECT * FROM Usuarios WHERE Email = '$email' AND Pass = '$pass'");
    if ($query->num_rows() > 0) {
      return $query->row();
    }
    return false;
  }

  public function crear($nombre, $apellido, $direccion, $telefono, $email, $pass)
  {
    $query = $this->db->query("SELECT 1 FROM Usuarios WHERE Email = '$email'");
    if ($query->num_rows() > 0) {
      return 'existe';
    } else {
      $query = $this->db->query("INSERT INTO Usuarios (Nombre, Apellido, Direccion, Telefono, Email, Pass) VALUES ('$nombre', '$apellido', '$direccion', '$telefono', '$email', '$pass')");
      if ($query) {
        return 'creado';
      }
      return false;
    }
  }
}
