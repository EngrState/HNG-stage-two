                        CLASS DIAGRAM

+-------------------------------+---------------------------+
|      PERSON                   |      CONTROLLER           |
+-------------------------------+---------------------------+
|   id: int                     |    - conn: PDO            |
|   name: str                   |                           |
|   date: timestamp             |                           |
+-------------------------------+---------------------------+
| + getUser(data)               | + show(request)           |
| + createUser(data)            | + store(request)          |
| + updateUser(data)            | + update(request)         |
| + deleteUser(data)            | + destroy(request)        |
+-------------------------------+---------------------------+
