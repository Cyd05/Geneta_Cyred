<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('StudentsModel');
    }

    // Display all students and the GUI
    public function index()
    {
        $students = $this->StudentsModel->all();
        $this->call->view('StudentView', ['students' => $students]);
    }

    // Create a new student record
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'last_name' => $_POST['last_name'] ?? '',
                'first_name' => $_POST['first_name'] ?? '',
                'email' => $_POST['email'] ?? ''
            ];
            $insert_id = $this->StudentsModel->insert($data);
            if ($insert_id) {
                redirect('student');
            } else {
                echo "Failed to create student.";
            }
        } else {
            show_error('Invalid Request', 'Create method only accepts POST requests.');
        }
    }

    // Update an existing student record
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
            $data = [
                'last_name' => $_POST['last_name'] ?? '',
                'first_name' => $_POST['first_name'] ?? '',
                'email' => $_POST['email'] ?? ''
            ];
            if ($id > 0 && $this->StudentsModel->update($id, $data)) {
                redirect('student');
            } else {
                echo "Failed to update student.";
            }
        } else {
            show_error('Invalid Request', 'Update method only accepts POST requests.');
        }
    }

    // Delete a student record
    public function delete()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        if ($id > 0 && $this->StudentsModel->delete($id)) {
            redirect('student');
        } else {
            echo "Failed to delete student.";
        }
    } else {
        show_error('Invalid Request', 'Delete method only accepts POST requests.');
    }
}
}