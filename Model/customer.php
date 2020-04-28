<?php

class Customer {

    //database connection and table name
    private $conn;
    private $table_name = "customer";
    // object properties
    private $userid = "userid";
    private $firstname = "firstname";
    private $lastname = "lastname";
    private $password = "password";
    private $email = "email";

    public function __construct($db) {
        $this->conn = $db;
    }

    // insert data
    function insertCustomer($params) {
        $command = "CREATE TABLE IF NOT EXISTS $this->table_name (
            userid VARCHAR(40) NOT NULL PRIMARY KEY,
            password VARCHAR(200) NOT NULL,
            firstname VARCHAR(100) NOT NULL,
            lastname VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL
            )";
        //use exec() cause no results returned
        $stmt = $this->conn->prepare($command);
        $stmt->execute();

        $command = "INSERT INTO $this->table_name(userid,password,firstname,lastname,email) "
                . "VALUES(?,?,?,?,?)";
        $stmt = $this->conn->prepare($command);
        $stmt->execute($params);
    }

    // read all customers
    function getAllCustomers() {

        // select all orders query
        $query = "SELECT *
            FROM
                $this->table_name
            ORDER BY
                $this->userid
                ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        // return values
        $customerList = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($customerList, $row);
        }

        return $customerList;
    }

    function checkExistingCustomer($userid, $password) {
        $query = "SELECT 
                $this->userid, $this->password
            FROM
                $this->table_name
                ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $customerList = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($customerList, $row);
        }
        $isExistingCustomer = false;
        foreach ($customerList as $key => $value) {
            if ($userid == $value['userid'] && $password == $value['password']) {
                $isExistingCustomer = true;
            }
        }
        return $isExistingCustomer;
    }

    function checkDuplicateCustomer($userid, $email) {
        $query = "SELECT 
                $this->userid, $this->email
            FROM
                $this->table_name
                ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $customerList = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($customerList, $row);
        }
        $isDuplicateCustomer = false;
        $wrongmsg = "";
        foreach ($customerList as $key => $value) {
            if ($userid == $value['userid'] && $email == $value['email']) {
                $isDuplicateCustomer = true;
                $wrongmsg = "userid and email have been taken.";
            } elseif ($userid == $value['userid']) {
                $isDuplicateCustomer = true;
                $wrongmsg = "userid has been taken.";
            } elseif ($email == $value['email']) {
                $isDuplicateCustomer = true;
                $wrongmsg = "email has been taken.";
            }
        }
        return array($isDuplicateCustomer,$wrongmsg);
    }

// used for paging orders
    public function count() {

        // query to count all product records
        $query = "SELECT count(*) FROM $this->table_name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        // get row value
        $rows = $stmt->fetch(PDO::FETCH_NUM);

        // return count
        return $rows[0];
    }

    public function getColumnNames() {

        $query = "DESCRIBE $this->table_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $output = array();

        while ($row = $stmt->fetch()) {
            $output[] = $row[0];
        }
        return $output;
    }

}
