<?php

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = mysqli_connect(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    }

    public function testUpdateOrder()
    {
        // Insert a test order
        $sqlInsert = "INSERT INTO orders (Drinks, Amount, Name, Email, RoomNum, Cost) 
                      VALUES ('Test Drink', 1, 'Test User', 'test@example.com', '101', 10.00)";
        mysqli_query($this->conn, $sqlInsert);

        // Get the ID of the inserted order
        $orderId = mysqli_insert_id($this->conn);

        // Update the test order
        $sqlUpdate = "UPDATE orders SET Drinks = 'Updated Drink', Amount = 4, Name = 'Updated User', 
                      Email = 'updated@example.com', RoomNum = '102', Cost = 40.00 WHERE ID = $orderId";
        $updateResult = mysqli_query($this->conn, $sqlUpdate);

        // Verify the order was updated
        $sqlCheck = "SELECT * FROM orders WHERE ID = $orderId AND Drinks = 'Updated Drink' AND Amount = 4
                     AND Name = 'Updated User' AND Email = 'updated@example.com' AND RoomNum = '102' AND Cost = 40.00";
        $checkResult = mysqli_query($this->conn, $sqlCheck);

        $this->assertEquals(1, mysqli_num_rows($checkResult), "Failed to update the order.");

        // Clean up the test order
        $sqlDelete = "DELETE FROM orders WHERE ID = $orderId";
        mysqli_query($this->conn, $sqlDelete);
    }

    protected function tearDown(): void
    {
        mysqli_close($this->conn);
    }
}
