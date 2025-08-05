<?php
class Model
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'project_note');
        if (!$this->conn) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }
        mysqli_set_charset($this->conn, 'utf8');
    }

    public function register($name, $pass)
    {
        $name = mysqli_real_escape_string($this->conn, $name);
        $pass = mysqli_real_escape_string($this->conn, $pass);

        $query = "SELECT id FROM user WHERE name = '$name'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) > 0) {
            return false;
        }

        $query = "INSERT INTO user (name, pass) VALUES ('$name', '$pass')";
        return mysqli_query($this->conn, $query);
    }

    public function login($name, $pass)
    {
        $name = mysqli_real_escape_string($this->conn, $name);
        $pass = mysqli_real_escape_string($this->conn, $pass);

        $query = "SELECT id, name FROM user WHERE name = '$name' AND pass = '$pass'";
        $result = mysqli_query($this->conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            return ['id' => $row['id'], 'name' => $row['name']];
        }
        return null;
    }

    public function getNotesByUser($id)
    {
        $id = (int)$id;
        $query = "SELECT id_note, name_note, data FROM note WHERE id = $id";
        $result = mysqli_query($this->conn, $query);

        $notes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $notes[] = $row;
        }
        return $notes;
    }

    public function addNote($id, $name_note, $data)
    {
        $id = (int)$id;
        $name_note = mysqli_real_escape_string($this->conn, $name_note);
        $data = mysqli_real_escape_string($this->conn, $data);

        $query = "INSERT INTO note (id, name_note, data) VALUES ($id, '$name_note', '$data')";
        return mysqli_query($this->conn, $query);
    }

    public function getNoteById($id_note)
    {
        $id_note = (int)$id_note;
        $query = "SELECT id_note, name_note, data FROM note WHERE id_note = $id_note";
        $result = mysqli_query($this->conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row;
        }
        return null;
    }

    public function updateNote($id_note, $name_note, $data)
    {
        $id_note = (int)$id_note;
        $name_note = mysqli_real_escape_string($this->conn, $name_note);
        $data = mysqli_real_escape_string($this->conn, $data);

        $query = "UPDATE note SET name_note = '$name_note', data = '$data' WHERE id_note = $id_note";
        return mysqli_query($this->conn, $query);
    }

    public function deleteNote($id_note)
    {
        $id_note = (int)$id_note;
        $query = "DELETE FROM note WHERE id_note = $id_note";
        return mysqli_query($this->conn, $query);
    }

    public function searchNotes($id, $keyword)
    {
        $id = (int)$id;
        $keyword = mysqli_real_escape_string($this->conn, $keyword);
        $keyword = "%$keyword%";

        $query = "SELECT id_note, name_note, data FROM note 
                  WHERE id = $id AND (name_note LIKE '$keyword' OR data LIKE '$keyword')";
        $result = mysqli_query($this->conn, $query);

        $notes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $notes[] = $row;
        }
        return $notes;
    }
}
