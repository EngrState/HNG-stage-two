## API Documentation

### 1. GET User Details

**Endpoint**: `https://statehng.topdatanig.com/api/{user_id}`

### Description
This endpoint allows you to retrieve user details from the `users` table in your database.

### HTTP Method
`GET`

### Path Parameters
- `user_id`: The ID of the user you want to retrieve. This should be an integer.

### Request Body
None

### Responses

#### Success Response
- **Code**: 200 OK
- **Content**: 
```json
{
    "id": "{user_id}",
    "name": "{name}",
    "date": "{date}"
  
}
```
- **Description**: The user details were successfully retrieved from the database.

#### Error Responses
- **Code**: 400 Bad Request
- **Content**: 
```json
{
    "error": "Invalid data"
}
```
- **Description**: The request was malformed. This usually means that the `user_id` was not provided in the URL.

- **Code**: 404 Not Found
- **Content**: 
```json
{
    "error": "No user found"
}
```
- **Description**: No user with the provided `user_id` was found in the database.
  

### 2. Create User

**Endpoint**: `https://statehng.topdatanig.com/api`

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

**Endpoint**: `https://statehng.topdatanig.com/api/{user_id}`

### HTTP Method
`PUT`

### Path Parameters
- `user_id`: The ID of the user you want to update. This should be an integer.

### Request Body
The request body should be a JSON object with the following properties:
- `name`: The new name for the user. This should be a string.

Example:
```json
{
    "name": "New Name"
}
```

### Responses

#### Success Response
- **Code**: 200 OK
- **Content**: 
```json
{
    "message": "User updated successfully",
    "New Name": "New Name"
}
```
- **Description**: The user's name was successfully updated in the database.

#### Error Responses
- **Code**: 400 Bad Request
- **Content**: `"Invalid data"`
- **Description**: The request was malformed. This usually means that the `user_id` was not provided in the URL or the `name` was not provided in the request body.

- **Code**: 404 Not Found
- **Content**: 
```json
{
    "error": "No user found"
}
```
- **Description**: No user with the provided `user_id` was found in the database.

- **Code**: 500 Internal Server Error
- **Content**: 
```json
{
    "error": "Error updating user"
}
```
- **Description**: An error occurred on the server while trying to update the user's name.


### Delete User

**Endpoint**: `https://statehng.topdatanig.com/api/{user_id}`

### HTTP Method
`DELETE`

### Path Parameters
- `user_id`: The ID of the user you want to delete. This should be an integer.

### Request Body
None

### Responses

#### Success Response
- **Code**: 200 OK
- **Content**: 
```json
{
    "message": "User deleted successfully"
}
```
- **Description**: The user was successfully deleted from the database.

#### Error Responses
- **Code**: 400 Bad Request
- **Content**: 
```json
{
    "error": "Invalid data"
}
```
- **Description**: The request was malformed. This usually means that the `user_id` was not provided in the URL.

- **Code**: 404 Not Found
- **Content**: 
```json
{
    "error": "No user found"
}
```
- **Description**: No user with the provided `user_id` was found in the database.

- **Code**: 500 Internal Server Error
- **Content**: 
```json
{
    "error": "Error deleting user"
}
```
- **Description**: An error occurred on the server while trying to delete the user.

- **Code**: 405 Method Not Allowed
- **Content**: 
```json
{
    "error": "Invalid HTTP request method"
}
```
- **Description**: The HTTP method used in the request is not supported by this endpoint. 
