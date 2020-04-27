<?php

class Product {

    //database connection and table name
    private $conn;
    private $table_name = "products";
    // object properties
    private $productid = "productid";
    private $name = "name";
    private $price = "price";
    private $description = "description";
    private $imgpath = "imgpath";

    public function __construct($db) {
        $this->conn = $db;
    }

    // load data
    public function loadProduct($params) {
        $command = "CREATE TABLE IF NOT EXISTS products (
            productid INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(450) NOT NULL,
            description VARCHAR(540) NOT NULL,
            price FLOAT(10),
            imgpath VARCHAR(1024) NOT NULL
            )";
        //use exec() cause no results returned
        $stmt = $this->conn->prepare($command);
        $stmt->execute();

        $command = "INSERT INTO products(productid,name,description,price,imgpath) "
                . "VALUES(?,?,?,?,?)";
        $stmt = $this->conn->prepare($command);
        $stmt->execute($params);
    }

    // read all products
    function read($from_record_num, $records_per_page) {

        // select all products query
        $query = "SELECT
            $this->productid , $this->name , $this->description , $this->price , $this->imgpath
            FROM
                $this->table_name
            ORDER BY
                $this->productid
            LIMIT
                ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind limit clause variables
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values
        return $stmt;
    }

    // read all products
    function gerAllProducts() {

        // select all products query
        $query = "SELECT *
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
        $productList = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($productList, $row);
        }

        return $productList;
    }

// used for paging products
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
