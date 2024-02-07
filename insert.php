<?php
include 'db_connection.php';

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check the response
    if ($response['success']) {
        // Retrieve parameters from the GET request
        $vehicleRegNo = $_GET['vehicleRegNo'] ?? '';
        $rtspUrl = $_GET['rtspUrl'] ?? '';
        $driverName = $_GET['driverName'] ?? '';
        $driverPhoneNo = $_GET['driverPhoneNo'] ?? '';
        $username = $_GET['username'] ?? '';
        $password = $_GET['password'] ?? '';

        // Ensure that $response['pdo'] is not null
        if ($response['pdo'] !== null) {
            // Insert data into the test_users table
            $sql = "INSERT INTO test_users (vehicle_regno, rtsp_url, driver_name, driver_phoneno, username, password)
                    VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $response['pdo']->prepare($sql);

            // Bind parameters
            $stmt->bindParam(1, $vehicleRegNo);
            $stmt->bindParam(2, $rtspUrl);
            $stmt->bindParam(3, $driverName);
            $stmt->bindParam(4, $driverPhoneNo);
            $stmt->bindParam(5, $username);
            $stmt->bindParam(6, $password);

            // Execute the statement
            $stmt->execute();

            // Check if the insertion was successful
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Data inserted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to insert data.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: Database connection is null.']);
        }
    } else {
        // Connection failed
        echo json_encode(['success' => false, 'message' => $response['message']]);
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
