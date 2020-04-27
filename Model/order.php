<?php

class Order {

    //database connection and table name
    private $conn;
    private $table_name = "orders";
    // object properties
    private $orderid = "orderid";
    private $productid = "productid";
    private $userid = "userid";
    private $productname = "productname";
    private $price = "price";
    private $quantity = "quantity";
    private $totalprice = "totalprice";
    private $billing = "billing";
    private $delivery = "delivery";
    private $imgpath = "imgpath";

    public function __construct($db) {
        $this->conn = $db;
    }

   // load data
    function insertOrder($params) {
        $command = "CREATE TABLE IF NOT EXISTS orders (
            id INT(40) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            orderid VARCHAR(40) NOT NULL,
            productid INT(10) NOT NULL,
            productname VARCHAR(50) NOT NULL,
            userid VARCHAR(40) NOT NULL,
            price FLOAT(10),
            quantity INT(10),
            totalprice FLOAT(20),
            imgpath VARCHAR(512) NOT NULL,
            billing VARCHAR(1024) NOT NULL,
            delivery VARCHAR(1024) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
        //use exec() cause no results returned
        $stmt = $this->conn->prepare($command);
        $stmt->execute();

        $command = "INSERT INTO orders(productid,productname,price,quantity,totalprice,imgpath,orderid,userid,billing,delivery) "
                . "VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($command);
        $stmt->execute($params);
    }

    // read all orders
    function gerAllOrders() {

        // select all orders query
        $query = "SELECT
            *
            FROM
                $this->table_name
            ORDER BY
                $this->productid
                ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        // return values
        $orderList = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($orderList, $row);
        }

        return $orderList;
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
