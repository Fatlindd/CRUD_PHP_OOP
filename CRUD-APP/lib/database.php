<?php
include_once 'config/config.php';

class Database
{
    private $host = HOST;
    private $user = USER;
    private $password = PASSWORD;
    private $database = DATABASE;

    private $link;
    private $error;

    public function __construct()
    {
        $this->dbConnect();
    }

    // Establishes a connection to the database.
    private function dbConnect()
    {
        // Attempt to connect to the database
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        // Check for connection errors
        if (!$this->link) {
            $this->error = "Database Connection Failed: " . mysqli_connect_error();
            throw new Exception($this->error);
        }
    }

    public function executeQuery($query)
    {
        // Execute the SQL query on the database using the mysqli_query function
        // $this->link is the database connection, and $query is the SQL query to be executed
        $result = mysqli_query($this->link, $query);

        // Check for query execution errors
        if (!$result) {
            $this->error = "Query Execution Failed: " . mysqli_error($this->link);
            throw new Exception($this->error);
        }

        return $result;
    }

    // Adds a new student record to the database.
    public function addStudent($query)
    {
        return $this->executeQuery($query);
    }

    // Selects student records from the database.
    public function selectStudents($query)
    {
        $result = $this->executeQuery($query);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        return false;
    }

    // Updates a student record in the database.
    public function updateStudent($query)
    {
        return $this->executeQuery($query);
    }  

    // Deletes a record from the database.
    public function deleteRecord($query)
    {
        return $this->executeQuery($query);
    }
}
?>
