<?php

require_once 'model/model.php';



class Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new Model();
        $action = $_GET['action'] ?? 'login';

        switch ($action) {
            case 'login':
                if (isset($_POST['login'])) {
                    $name = $_POST['name'] ?? '';
                    $pass = $_POST['pass'] ?? '';
                    $user = $this->model->login($name, $pass);
                    if ($user) {
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['name'] = $user['name'];
                        header("Location: ?action=home");
                        exit;
                    } else {
                        $error = "Sai tài khoản hoặc mật khẩu.";
                        include 'view/login.php';
                    }
                } else {
                    include 'view/login.php';
                }
                break;

            case 'sign':
    if (isset($_POST['sign'])) {
        $name = $_POST['name'] ?? '';
        $pass = $_POST['pass'] ?? '';
        if ($this->model->register($name, $pass)) {
            header("Location: ?action=login");
            exit;
        } else {
            $error = "Tên đăng nhập đã tồn tại.";
            include 'view/sign.php';
        }
    } else {
        include 'view/sign.php'; // ✅ Sửa dòng này
    }
    break;

            case 'home':
                if (!isset($_SESSION['id'])) {
                    header("Location: ?action=login");
                    exit;
                }
                $notes = $this->model->getNotesByUser($_SESSION['id']);
                include 'view/home.php';
                break;

            case 'addnote':
                if (!isset($_SESSION['id'])) {
                    header("Location: ?action=login");
                    exit;
                }
                if (isset($_POST['add'])) {
                    $name_note = $_POST['name_note'] ?? '';
                    $data = $_POST['data'] ?? '';
                    $this->model->addNote($_SESSION['id'], $name_note, $data);
                    header("Location: ?action=home");
                    exit;
                } else {
                    include 'view/addnote.php';
                }
                break;

            case 'editnote':
                if (!isset($_SESSION['id'])) {
                    header("Location: ?action=login");
                    exit;
                }
                $id_note = $_GET['id_note'] ?? 0;
                if (isset($_POST['edit'])) {
                    $name_note = $_POST['name_note'] ?? '';
                    $data = $_POST['data'] ?? '';
                    $this->model->updateNote($id_note, $name_note, $data);
                    header("Location: ?action=home");
                    exit;
                } else {
                    $note = $this->model->getNoteById($id_note);
                    include 'view/editnote.php';
                }
                break;

            case 'delete':
                if (isset($_GET['id_note'])) {
                    $this->model->deleteNote($_GET['id_note']);
                }
                header("Location: ?action=home");
                exit;
                break;

            case 'search':
                if (!isset($_SESSION['id'])) {
                    header("Location: ?action=login");
                    exit;
                }
                $keyword = $_POST['keyword'] ?? '';
                $notes = $this->model->searchNotes($_SESSION['id'], $keyword);
                include 'view/home.php';
                break;

            case 'logout':
                session_destroy();
                header("Location: ?action=login");
                exit;
                break;

            default:
                include 'view/login.php';
                break;
        }
    }
}