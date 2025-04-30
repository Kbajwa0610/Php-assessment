<?php
require_once '../app/models/FormModel.php';

class FormController {
    public function showForm() {
        include '../app/views/form.html';
    }

    public function submitForm() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $model = new FormModel();
            $errors = $model->validate($_POST);

            if (empty($errors)) {
                $model->saveData($_POST);
                echo "Form submitted successfully!";
            } else {
                include '../app/views/form.html';
            }
        }
    }
}
