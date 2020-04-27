<?php

class Delivery {

    //database connection and table name
    private $conn;
    private $table_name = "delivery";
    // object properties
    private $userid = "userid";
    private $firstname = "firstname";
    private $lastname = "lastname";
    private $phone = "phone";
    private $email = "email";
    private $address = "address";
    private $city = "city";
    private $country = "country";
    private $postcode = "postcode";

    public function __construct($db) {
        $this->conn = $db;
    }

    // insert data
    function insertDelivery($params) {
        $command = "CREATE TABLE IF NOT EXISTS $this->table_name (
            id INT(40) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            userid VARCHAR(40) NOT NULL,
            firstname VARCHAR(40) NOT NULL,
            lastname VARCHAR(40) NOT NULL,
            phone VARCHAR(40) NOT NULL,
            email VARCHAR(40) NOT NULL,
            address VARCHAR(1024) NOT NULL,
            city VARCHAR(1024) NOT NULL,
            country VARCHAR(1024) NOT NULL,
            postcode VARCHAR(1024) NOT NULL
            )";
        //use exec() cause no results returned
        $stmt = $this->conn->prepare($command);
        $stmt->execute();

        $command = "INSERT INTO $this->table_name(firstname,lastname,phone,email,"
                . "address,city,country,postcode,userid) "
                . "VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($command);
        $stmt->execute($params);
    }

    // read all orders
    function gerAllDelivery() {

        // select all orders query
        $query = "SELECT *
            FROM
                $this->table_name
            ORDER BY
                $this->id
                ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        // return values
        $deliveryList = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($deliveryList, $row);
        }

        return $deliveryList;
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
