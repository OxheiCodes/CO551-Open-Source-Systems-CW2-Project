<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");
require_once 'vendor/autoload.php';

use Faker\Factory;

// Checks whether we're logged in
if (isset($_SESSION['id'])) {
    // Initialize Faker
    $faker = Factory::create();

    // Prepare SQL insert statement
    $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    for ($i = 0; $i < 5; $i++) {
        $student = [
            $faker->unique()->numberBetween(20000001, 29999999),
            $faker->password,
            $faker->date($format = 'Y-m-d', $max = '2003-12-31'),
            $faker->firstName,
            $faker->lastName,
            $faker->streetAddress,
            $faker->city,
            $faker->state,
            $faker->country,
            $faker->postcode
        ];

        // Assuming $conn is your database connection variable from dbconnect.inc
        $stmt = $conn->prepare($sql);
        $stmt->execute($student);
    }

    echo "Students inserted successfully.";
}

?>


