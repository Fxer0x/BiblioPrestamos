<? class Libros_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function getAll()
  {
    $query = $this->db->query("SELECT * FROM Libros WHERE Disponible = 1");
    if ($query->num_rows() > 0) {
      return $query->result();
    }
    return false;
  }

  public function getPrestamos()
  {
    $ids = array();
    $idUsuario = $this->session->userdata('usuario')->ID;
    $query = $this->db->query("SELECT LibroID FROM Prestamos WHERE UsuarioID = '$idUsuario' AND FechaDevolucion >= NOW()");
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $ids[] = $row->LibroID;
      }
    }
    return $ids;
  }

  public function eliminar($id)
  {
    return $this->db->query("UPDATE Libros SET Disponible = 0 WHERE ID = '$id'");
  }

  public function ingresar($titulo, $autor, $anio)
  {
    return $this->db->query("INSERT INTO Libros (Titulo, Autor, AnioPublicacion, Disponible) VALUES ('$titulo', '$autor', '$anio', 1)");
  }

  public function getLibro($id)
  {
    $query = $this->db->query("SELECT * FROM Libros WHERE ID = '$id'");
    if ($query->num_rows() > 0) {
      return $query->row();
    }
    return false;
  }

  public function cambiar($id, $titulo, $autor, $anio)
  {
    return $this->db->query("UPDATE Libros SET Titulo = '$titulo', Autor = '$autor', AnioPublicacion = '$anio' WHERE ID = '$id'");
  }

  public function solicitar($id)
  {
    $idUsuario = $this->session->userdata('usuario')->ID;
    $query = $this->db->query("SELECT 1 FROM Libros WHERE ID = '$id'");
    if ($query->num_rows() > 0) {
      $query = $this->db->query("SELECT 1 FROM Prestamos WHERE LibroID = '$id' AND FechaDevolucion >= NOW()");
      if ($query->num_rows() > 0) {
        return 'solicitado';
      }
      return $this->db->query("INSERT INTO Prestamos (LibroID, UsuarioID, FechaPrestamo, FechaDevolucion) VALUES ('$id', '$idUsuario', NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY))");
    }
    return false;
  }
}
