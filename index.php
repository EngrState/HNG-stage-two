<?php
    require('new/config.php');
    require('new/function.php');
?>
<?php
$segments = explode('/', $_SERVER['REQUEST_URI']);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      

    // Check if the URL path starts with '/api/' and if the HTTP request method is 'GET'
    if ($segments[1] === 'api' && isset($segments[2]) ) {
        // Get the user ID from the second segment of the URL path
        $user = $segments[2];
        $user_id = filter_var($user, FILTER_SANITIZE_NUMBER_INT);
      
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

        $details = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($details) {
            // Set HTTP 200 OK status code
            http_response_code(200);
            echo json_encode($details);
        } else {
            // Set HTTP 404 Not Found status code
            http_response_code(404);
            echo json_encode(["error" => "No user found"]);
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid data"]);
        return;
    }
    
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if ($data === null) {
        // Error in decoding JSON data
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid JSON data"]);
        return;
    }

    if (isset($data->name) && is_string($data->name)) {
        $name = filter_var($data->name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Check if the name already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $existingData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingData) {
            http_response_code(409); // Conflict
            echo json_encode(["error" => "Name already exists"]);
            return;
        } else {
            // Insert the new user
            $stmt = $conn->prepare("INSERT INTO users (name) VALUES (:name)");
            $stmt->bindParam(':name', $name);

            if ($stmt->execute()) {
               $user_id = $conn->lastInsertId();
               $date = date("Y-m-d H:i:s");
    
                http_response_code(200); // Created
                echo json_encode(["message" => "User created successfully", "user_id" => $user_id, "name" => $name, "date created"   => $date ]);
                return;
            } else {
                http_response_code(500); // Internal Server Error
                echo json_encode(["error" => "Error creating user"]);
                return;
            }
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid data"]);
        return;
    }
}elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"));
    if ($data === null) {
        // Error in decoding JSON data
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid JSON data"]);
        return;
    }
    if ($segments[1] === 'api' && isset($segments[2]) && !empty($data->name) && is_string($data->name)  ) {
        // Get the user ID from the second segment of the URL path
        $user = $segments[2];
        $user_id = filter_var($user, FILTER_SANITIZE_NUMBER_INT);
     
        
        $name = filter_var($data->name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   
       
        // Check if the new name already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $existingData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (!count($existingData) > 0){
            // Set HTTP 404 Not Found status code
            http_response_code(404);
            echo json_encode(["error" => "No user found"]);
            return;
        } else {
            // Update user's name in the database
            
            $stmtUpdate = $conn->prepare("UPDATE users SET name = :name WHERE id = :user_id");
            $stmtUpdate -> bindParam(':name', $name);
            $stmtUpdate->bindParam(':user_id', $user_id);
            
            
            if ($stmtUpdate->execute()) {
                // Set HTTP 200 OK status code
                
                http_response_code(200);
                $response = json_encode(['message'=> 'User updated successfully', 'New Name' =>$name]);
                echo $response;
                return;
            } else {
                // Set HTTP 500 Internal Server Error status code
                http_response_code(500);
                echo json_encode(["error" => "Error updating user"]);
                return;
            }
        }
    } else {
        // Set HTTP 400 Bad Request status code
        http_response_code(400);
        echo "Invalid data";
    }
}elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if ($segments[1] === 'api' && isset($segments[2])) {
            // Get the user ID from the second segment of the URL path
            $user = $segments[2];
            $user_id = filter_var($user, FILTER_SANITIZE_NUMBER_INT);
        // Check if the new name already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
      
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $existingData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (!count($existingData) > 0){
            // Set HTTP 404 Not Found status code
            http_response_code(404);
            echo json_encode(["error" => "No user found"]);
            return;
        } else {   
            //delete user 
            $stmtDelete = $conn->prepare("DELETE FROM users WHERE id = :user_id");
            $stmtDelete->bindParam(':user_id', $user_id);
            $details = $stmtDelete->execute();
            if ($details) {
                http_response_code(200); // Created
                echo json_encode(["message" => "User deleted successfully"]);
                return;
            } else {
                http_response_code(500); // Internal Server Error
                echo json_encode(["error" => "Error deleting user"]);
                return;
            }
        }
    } else {
        // Set HTTP 400 Bad Request status code
        http_response_code(400);
        echo json_encode(["error" => "Invalid data"]);
        return;
    }
}else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Invalid HTTP request method"]);
}

?>
