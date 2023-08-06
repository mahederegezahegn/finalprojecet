<?php
include('db.php');
if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    $result1 = mysqli_query($conn, "UPDATE appointment SET approve = '1' WHERE appointment_id = '$appointment_id'");
    if (!$result1) {
        echo "Error approving appointment.";
        exit;
    } else {
        $sw = "SELECT * FROM appointment WHERE appointment_id = $appointment_id";
        $res = mysqli_query($conn, $sw);
        $row = mysqli_fetch_array($res);
        $uname = $row['name'];
        $res = $row['reason'];
        $re = "SELECT * FROM patients WHERE first_name = '$uname'";
        $sq = mysqli_query($conn, $re);
        $ro1 = mysqli_fetch_array($sq);
        $firstname = $ro1['first_name'];
        $lastname = $ro1['last_name'];
        $email = $ro1['email'];
        $gender = $ro1['gender'];
        $phone = $ro1['phone'];
        $city = $ro1['city'];

        // Check if the patient already exists in the approve_patient table
        $dup_check = "SELECT * FROM approve_patient WHERE first_name = '$firstname' AND last_name = '$lastname' AND email = '$email'";
        $dup_result = mysqli_query($conn, $dup_check);
        if (mysqli_num_rows($dup_result) > 0) {
            echo "Duplicate entry found.";
            header("location:board.php");
            exit;
        } else {
            $insert = "INSERT INTO approve_patient(first_name, last_name, email, phone, gender, city, reasone,appointment_id) VALUES 
            ('$firstname','$lastname','$email','$phone','$gender','$city','$res','$appointment_id')";
            $as = mysqli_query($conn, $insert);
            if ($as) {
                header("location:board.php");
            }
        }
    }
}
?>