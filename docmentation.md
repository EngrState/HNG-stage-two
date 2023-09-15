## API Documentation

### 1. GET User Details

**Endpoint**: `https://statehng.topdatanig.com/api/`

**Method**: `GET`

**Data Params**: JSON object in the request body with the following structure:
```json
{
    "user_id": "[integer]"
}
```

**Success Response**:
- **Code**: `200 OK`
- **Content**: `{ "name": "John Doe", ... }` (Additional fields depend on your database structure)

**Error Responses**:
- If the JSON data is invalid:
    - **Code**: `400 BAD REQUEST`
    - **Content**: `{ "error": "Invalid JSON data" }`
- If the 'name' field is missing or not a string:
    - **Code**: `400 BAD REQUEST`
    - **Content**: `{ "error": "Invalid data" }`
- If no user is found with the provided name:
    - **Code**: `404 NOT FOUND`
    - **Content**: `{ "error": "No user found" }`

### 2. Create User

**Endpoint**: `https://statehng.topdatanig.com/api/`

**Method**: `POST`

**Data Params**: JSON object in the request body with the following structure:
```json
{
    "name": "[string]"
}
```

**Success Response**:
- **Code**: `200 OK`
- **Content**: `{ "message": "User created successfully" }`

**Error Responses**:
- If the JSON data is invalid:
    - **Code**: `400 BAD REQUEST`
    - **Content**: `{ "error": "Invalid JSON data" }`
- If the 'name' field is missing or not a string:
    - **Code**: `400 BAD REQUEST`
    - **Content**: `{ "error": "Invalid data" }`
- If a user with the same name already exists:
    - **Code**: `409 CONFLICT`
    - **Content**: `{ "error": "Name already exists" }`
- If there was an error creating the user:
    - **Code**: `500 INTERNAL SERVER ERROR`
    - **Content**: `{ "error": "Error creating user" }`


### Update User Name

**Endpoint**: `https://statehng.topdatanig.com/api/`

**Method**: `PUT`

**Data Params**: JSON object in the request body with the following structure:
```json
{
    "name": "[string]",
    "user_id": "[integer]"
}
```

**Success Response**:
- **Code**: `200 OK`
- **Content**: `{ "message": "User updated successfully", "New Name": "John Doe" }`

**Error Responses**:
- If the JSON data is invalid:
    - **Code**: `400 BAD REQUEST`
    - **Content**: `{ "error": "Invalid JSON data" }`
- If the 'name' or 'user_id' field is missing or not a string:
    - **Code**: `400 BAD REQUEST`
    - **Content**: `"Invalid data"`
- If no user is found with the provided user_id:
    - **Code**: `404 NOT FOUND`
    - **Content**: `{ "error": "No user found" }`
- If there was an error updating the user:
    - **Code**: `500 INTERNAL SERVER ERROR`
    - **Content**: `{ "error": "Error updating user" }`



### Delete User

**Endpoint**: `https://statehng.topdatanig.com/api/`

**Method**: `DELETE`

**Data Params**: JSON object in the request body with the following structure:
```json
{
    "user_id": "[integer]"
}
```

**Success Response**:
- **Code**: `200 OK`
- **Content**: `{ "message": "User deleted successfully" }`

**Error Responses**:
- If the JSON data is invalid:
    - **Code**: `400 BAD REQUEST`
    - **Content**: `{ "error": "Invalid JSON data" }`
- If the 'user_id' field is missing:
    - **Code**: `400 BAD REQUEST`
    - **Content**: `{ "error": "Invalid data" }`
- If no user is found with the provided user_id:
    - **Code**: `404 NOT FOUND`
    - **Content**: `{ "error": "No user found" }`
- If there was an error deleting the user:
    - **Code**: `500 INTERNAL SERVER ERROR`
    - **Content**: `{ "error": "Error deleting user" }`
