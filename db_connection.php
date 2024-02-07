<?php
// Database configuration
$host = 'geoserver-dev.c1klpvhwpuls.us-east-1.rds.amazonaws.com';
$dbname = 'geoserver';
$user = 'postgres';
$password = 'GeoServer3456';
$schema = 'public';

// Initialize response array
$response = ['success' => false, 'message' => '', 'pdo' => null];

// Connect to PostgreSQL
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET search_path TO $schema"); // Set the schema name

    // Connection successful
    $response['success'] = true;
    // $response['message'] = 'Database connection successful';
    $response['pdo'] = $pdo;
} catch (PDOException $e) {
    // Connection failed
    $response['message'] = 'Connection failed: ' . $e->getMessage();
}

// Return the response
echo json_encode($response);
