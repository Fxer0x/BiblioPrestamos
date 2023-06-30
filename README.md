# BiblioPrestamos

Instrucciones para ejecutar el proyecto:
docker-compose up -d

Para acceder a la aplicación:
http://localhost:8080/

Crear database:

CREATE TABLE Usuarios (
ID BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Nombre VARCHAR(100) NOT NULL,
Apellido VARCHAR(100),
Direccion VARCHAR(200),
Telefono VARCHAR(20),
Email VARCHAR(100),
Pass VARCHAR(100),
Rol ENUM ('Usuario', 'Admin') DEFAULT 'Usuario'
);

CREATE TABLE Libros (
ID BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Titulo VARCHAR(100) NOT NULL,
Autor VARCHAR(100) NOT NULL,
AnioPublicacion INT,
Disponible TINYINT(1)
);

CREATE TABLE Prestamos (
ID BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
UsuarioID BIGINT UNSIGNED,
LibroID BIGINT UNSIGNED,
FechaPrestamo DATE,
FechaDevolucion DATE,
FOREIGN KEY (UsuarioID) REFERENCES Usuarios(ID),
FOREIGN KEY (LibroID) REFERENCES Libros(ID)
);

Ingreso de algunos libros:

INSERT INTO Libros (Titulo, Autor, AnioPublicacion, Disponible) VALUES
('Cien años de soledad', 'Gabriel García Márquez', 1967, 1),
('Ficciones', 'Jorge Luis Borges', 1944, 1),
('Rayuela', 'Julio Cortázar', 1963, 1),
('Pedro Páramo', 'Juan Rulfo', 1955, 1),
('La casa de los espíritus', 'Isabel Allende', 1982, 1),
('Los detectives salvajes', 'Roberto Bolaño', 1998, 1),
('El amor en los tiempos del cólera', 'Gabriel García Márquez', 1985, 1),
('El túnel', 'Ernesto Sabato', 1948, 1),
('Fahrenheit 451', 'Ray Bradbury', 1953, 1),
('Crónica de una muerte anunciada', 'Gabriel García Márquez', 1981, 1),
('El Aleph', 'Jorge Luis Borges', 1949, 1),
('Como agua para chocolate', 'Laura Esquivel', 1989, 1),
('Los pasos perdidos', 'Alejo Carpentier', 1953, 1),
('El coronel no tiene quien le escriba', 'Gabriel García Márquez', 1961, 1),
('Conversación en La Catedral', 'Mario Vargas Llosa', 1969, 1),
('El amor en los tiempos del desprecio', 'Eduardo Galeano', 2004, 1),
('El otoño del patriarca', 'Gabriel García Márquez', 1975, 1),
('El laberinto de la soledad', 'Octavio Paz', 1950, 1),
('El perfume', 'Patrick Süskind', 1985, 1),
('Pedagogía del oprimido', 'Paulo Freire', 1968, 1),
('La ciudad y los perros', 'Mario Vargas Llosa', 1963, 1),
('La sombra del viento', 'Carlos Ruiz Zafón', 2001, 1),
('Cien años de soledad', 'Gabriel García Márquez', 1967, 1),
('Ficciones', 'Jorge Luis Borges', 1944, 1),
('Rayuela', 'Julio Cortázar', 1963, 1),
('Pedro Páramo', 'Juan Rulfo', 1955, 1),
('La casa de los espíritus', 'Isabel Allende', 1982, 1),
('Los detectives salvajes', 'Roberto Bolaño', 1998, 1),
('El amor en los tiempos del cólera', 'Gabriel García Márquez', 1985, 1),
('El túnel', 'Ernesto Sabato', 1948, 1),
('Fahrenheit 451', 'Ray Bradbury', 1953, 1),
('Crónica de una muerte anunciada', 'Gabriel García Márquez', 1981, 1),
('El Aleph', 'Jorge Luis Borges', 1949, 1),
('Como agua para chocolate', 'Laura Esquivel', 1989, 1),
('Los pasos perdidos', 'Alejo Carpentier', 1953, 1),
('El coronel no tiene quien le escriba', 'Gabriel García Márquez', 1961, 1),
('Conversación en La Catedral', 'Mario Vargas Llosa', 1969, 1),
('El amor en los tiempos del desprecio', 'Eduardo Galeano', 2004, 1),
('El otoño del patriarca', 'Gabriel García Márquez', 1975, 1),
('El laberinto de la soledad', 'Octavio Paz', 1950, 1),
('El perfume', 'Patrick Süskind', 1985, 1),
('Pedagogía del oprimido', 'Paulo Freire', 1968, 1),
('La ciudad y los perros', 'Mario Vargas Llosa', 1963, 1),
('La sombra del viento', 'Carlos Ruiz Zafón', 2001, 1),
('Cien años de soledad', 'Gabriel García Márquez', 1967, 1),
('Ficciones', 'Jorge Luis Borges', 1944, 1),
('Rayuela', 'Julio Cortázar', 1963, 1),
('Pedro Páramo', 'Juan Rulfo', 1955, 1),
('La casa de los espíritus', 'Isabel Allende', 1982, 1),
('Los detectives salvajes', 'Roberto Bolaño', 1998, 1);

Ingresar usuario administrador:

INSERT INTO Usuarios (Nombre, Email, Pass, Rol) VALUES
('Admin', 'admin@gmail.com', '123456', 'Admin');
