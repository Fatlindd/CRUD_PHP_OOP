<?php 

    include_once 'lib/database.php';

    class Student {

        public $db;

        public function __construct()
        {
            $this->db = new Database();
        }
        
        // This method is used to add new Student to the database 
        public function addStudent($data){
            $name = $data['name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $address = $data['address'];


            if (empty($name) || empty($email) || empty($phone) || empty($address)) {
                $msg = "Filds Must Not Be empty";
                return $msg;
            } else {
                $query = "INSERT INTO `students`(`name`, `email`, `phone`, `address`) VALUES ('$name', '$email', '$phone', '$address')";

                $result = $this->db->addStudent($query);
                
                if ($result) {
                    $msg = "Registration Susscessfull";
                } else {
                    $msg = "Registration Failed";
                }
                return $msg;
            }
        }

        // This method select all sudents from table students and order them by id column
        public function allStudent(){
            $query = "SELECT * FROM students ORDER BY id";
            $result = $this->db->selectStudents($query);
            return $result;
        }

        // This method is used to select data from students table based on id 
        // this method is usde in update.php file
        public function getStdById($id){
            $query = "SELECT * FROM students WHERE id = '$id'";
            $result = $this->db->selectStudents($query);
            return $result;
        }


        // //Update Student
        public function updateStudent($data, $id){
            $name = $data['name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $address = $data['address'];

            if (empty($name) || empty($email) || empty($phone) || empty($address)) {
                $msg = "Filds Must Not Be empty";
                return $msg;
            } else 
            {
                $query = "UPDATE students SET name='$name', email='$email', phone='$phone', address='$address' WHERE id = '$id'";

                $result = $this->db->addStudent($query);

                if ($result) {
                    $msg = "Student Update Susscessfull";
                } else {
                    $msg = "Update Failed";
                }
                return $msg;
            }  
        }

        //Delete Student
        public function delStudent($id){
            $del_query = "DELETE FROM students WHERE id = '$id'";
            $del = $this->db->deleteRecord($del_query);
            if ($del) {
                $msg = "Student Deleted Susscessfull";
                return $msg;
            } else {
                $msg = "Delete Failed";
                return $msg;
            }
        }
    }

?>