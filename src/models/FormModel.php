<?php

class FormModel {
    public function validate($data) {
        $errors = [];

        if (empty($data['full_name'])) $errors[] = "Full Name is required.";
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";
        if (strlen($data['password']) < 6) $errors[] = "Password must be at least 6 characters.";
        if (empty($data['dob'])) $errors[] = "Date of Birth is required.";
        if (empty($data['gender'])) $errors[] = "Gender is required.";

        return $errors;
    }

    public function saveData($data) {
        $cleanData = [
            'Full Name' => htmlspecialchars($data['full_name']),
            'Email' => htmlspecialchars($data['email']),
            'Date of Birth' => htmlspecialchars($data['dob']),
            'Gender' => htmlspecialchars($data['gender']),
            'Hobbies' => isset($data['hobbies']) ? implode(", ", $data['hobbies']) : '',
            'Bio' => htmlspecialchars($data['bio']),
        ];

        $txt = "";
        foreach ($cleanData as $key => $value) {
            $txt .= "$key: $value\n";
        }
        $txt .= "-----------------------\n";

        file_put_contents('../storage/form_data.txt', $txt, FILE_APPEND);
    }
}
