<?php
header("Content-Type: application/json");

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Get JSON input data
$data = json_decode(file_get_contents('php://input'), true);
$response = [];

// Validate input data
if (is_array($data)) {
    foreach ($data as $student) {
        // Validate student data
        if (isset($student['name'], $student['surname'], $student['status'])) {
            $name = $conn->real_escape_string($student['name']);
            $surname = $conn->real_escape_string($student['surname']);
            $status = $conn->real_escape_string($student['status']);

            // Check if the student is registered
            $sql = "SELECT 1 FROM registered_students WHERE name='$name' AND surname='$surname'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Insert attendance record
                $sql = "INSERT INTO students (name, surname, status) VALUES ('$name', '$surname', '$status')";
                if ($conn->query($sql) === TRUE) {
                    $response[] = [
                        'name' => $name,
                        'surname' => $surname,
                        'status' => $status,
                        'timestamp' => date('Y-m-d H:i:s')
                    ];
                } else {
                    $response[] = ['error' => 'Error: ' . $conn->error];
                }
            } else {
                $response[] = ['error' => 'Student not registered'];
            }
        } else {
            $response[] = ['error' => 'Invalid student data'];
        }
    }
} else {
    $response[] = ['error' => 'Invalid input data'];
}

// Close connection
$conn->close();

// Return JSON response
echo json_encode($response);
?>
<?php
header("Content-Type: application/json");

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Get JSON input data
$data = json_decode(file_get_contents('php://input'), true);
$response = [];

// Validate input data
if (is_array($data)) {
    foreach ($data as $student) {
        // Validate student data
        if (isset($student['name'], $student['surname'], $student['status'])) {
            $name = $conn->real_escape_string($student['name']);
            $surname = $conn->real_escape_string($student['surname']);
            $status = $conn->real_escape_string($student['status']);

            // Check if the student is registered
            $sql = "SELECT 1 FROM registered_students WHERE name='$name' AND surname='$surname'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Insert attendance record
                $sql = "INSERT INTO students (name, surname, status) VALUES ('$name', '$surname', '$status')";
                if ($conn->query($sql) === TRUE) {
                    $response[] = [
                        'name' => $name,
                        'surname' => $surname,
                        'status' => $status,
                        'timestamp' => date('Y-m-d H:i:s')
                    ];
                } else {
                    $response[] = ['error' => 'Error: ' . $conn->error];
                }
            } else {
                $response[] = ['error' => 'Student not registered'];
            }
        } else {
            $response[] = ['error' => 'Invalid student data'];
        }
    }
} else {
    $response[] = ['error' => 'Invalid input data'];
}

// Close connection
$conn->close();

// Return JSON response
echo json_encode($response);
?>
