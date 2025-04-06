<?php

use PHPUnit\Framework\TestCase;

class AdminTest extends TestCase
{
    private $conn;

    // Set up the database connection before each test
    protected function setUp(): void
    {
        $this->conn = mysqli_connect(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    }

    // Test case to add an admin to the database
    public function testAddAdmin()
    {
        // Insert a test admin into the database
        $sqlInsert = "INSERT INTO admin (name, username, password) VALUES ('Test Admin', 'testuser', MD5('password123'))";
        $result = mysqli_query($this->conn, $sqlInsert);

        // Verify that the admin was added successfully
        $sqlCheck = "SELECT * FROM admin WHERE username = 'testuser'";
        $checkResult = mysqli_query($this->conn, $sqlCheck);

        // Assert that one row was found
        $this->assertEquals(1, mysqli_num_rows($checkResult), "Failed to add admin.");

        // Clean up the test admin from the database
        $sqlDelete = "DELETE FROM admin WHERE username = 'testuser'";
        mysqli_query($this->conn, $sqlDelete);
    }

    // Tear down the database connection after each test
    protected function tearDown(): void
    {
        mysqli_close($this->conn);
    }
}
