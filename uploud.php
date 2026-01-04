<?php
header("Access-Control-Allow-Origin: *");
include 'config.php'; // Koneksi MySQL

if (isset($_POST['image'])) {
    $img = $_POST['image'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    
    $file_name = 'captured_' . time() . '.png';
    $file_path = 'uploads/' . $file_name;
    
    if (file_put_contents($file_path, $data)) {
        $sql = "INSERT INTO gallery (image_path) VALUES ('$file_name')";
        mysqli_query($conn, $sql);
        echo json_encode(["status" => "success", "url" => $file_path]);
    }
}
?>