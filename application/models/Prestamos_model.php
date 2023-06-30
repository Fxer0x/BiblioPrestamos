<? class Prestamos_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function getAll()
  {
    if ($this->session->userdata('usuario')->Rol == 'Admin') {
      $query = $this->db->query("SELECT p.FechaPrestamo, p.FechaDevolucion, CONCAT(u.Nombre, ' ', u.Apellido) Usuario, l.Titulo Libro FROM Prestamos p INNER JOIN Usuarios u ON p.UsuarioID = u.ID INNER JOIN Libros l ON p.LibroID = l.ID");
    } else {
      $query = $this->db->query("SELECT p.FechaPrestamo, p.FechaDevolucion, CONCAT(u.Nombre, ' ', u.Apellido) Usuario, l.Titulo Libro FROM Prestamos p INNER JOIN Usuarios u ON p.UsuarioID = u.ID INNER JOIN Libros l ON p.LibroID = l.ID WHERE u.ID = " . $this->session->userdata('usuario')->ID);
    }
    if ($query->num_rows() > 0) {
      return $query->result();
    }
    return false;
  }
}
