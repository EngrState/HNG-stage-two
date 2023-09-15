                        CLASS DIAGRAM

+-------------------------------+---------------------------+
|      PERSON                   |      CONTROLLER           |
+-------------------------------+---------------------------+
|   id: int                     |    - conn: PDO            |
|   name: str                   |                           |
|   date: timestamp             |                           |
+-------------------------------+---------------------------+
| + getUser(name: str)          | + show(request)           |
| + createUser(name: str)       | + store(request)          |
| + updateUser(data: array)     | + update(request)         |
| + deleteUser(data: array )    | + destroy(request)        |
+-------------------------------+---------------------------+
