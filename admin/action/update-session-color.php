<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Parse the JSON data
  $data = json_decode(file_get_contents('php://input'));

  // Update the session variable
  $_SESSION['color-admin'] = $data->color;

  // Respond with a success message
  header('Content-Type: application/json');
  echo json_encode(['message' => 'Session color updated successfully']);
} else {
  // Handle invalid requests
  header('HTTP/1.1 400 Bad Request');
  echo json_encode(['error' => 'Invalid request']);
}
