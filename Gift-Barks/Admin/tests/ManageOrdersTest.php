<?php

use PHPUnit\Framework\TestCase;

class ManageOrdersTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = mysqli_connect(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    }

    public function testFetchOrders()
    {
        // Insert a test order
        $sqlInsert = "INSERT INTO orders (Drinks, Amount, Name, Email, RoomNum, Cost) 
                      VALUES ('Test Drink', 1, 'Test User', 'test@example.com', '101', 10.00)";
        mysqli_query($this->conn, $sqlInsert);

        // Fetch all orders
        $sqlFetch = "SELECT * FROM orders";
        $result = mysqli_query($this->conn, $sqlFetch);

        $this->assertGreaterThan(0, mysqli_num_rows($result), "No orders found in the database.");

        // Clean up the test order
        $sqlDelete = "DELETE FROM orders WHERE Drinks = 'Test Drink'";
        mysqli_query($this->conn, $sqlDelete);
    }

    protected function tearDown(): void
    {
        mysqli_close($this->conn);
    }
}
