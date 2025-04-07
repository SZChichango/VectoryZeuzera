<?php
// filter.php

include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'filter') {

    $sizes = isset($_POST['sizes']) ? $_POST['sizes'] : array();
    $categories = isset($_POST['categories']) ? $_POST['categories'] : array();
    $from = isset($_POST['from']) ? $_POST['from'] : '';
    $to = isset($_POST['to']) ? $_POST['to'] : '';

    // Construct the SQL query based on the form data
    $query = "SELECT * FROM product WHERE status = '1'";

    // Check if $categories is not empty and is an array, or convert it to an array
    $categories = !empty($categories) && is_array($categories) ? $categories : [$categories];

    // Use implode only if $categories is not empty
    if (!empty($categories) && $categories[0] !== '') {
        $categoriesArray = explode(",", $_POST['categories']);
        $categories = array();
        foreach ($categoriesArray as $category) {
            $categories[] = $category;
        }

        $categoryFilter = implode("','", $categories);
        $query .= " AND category IN ('$categoryFilter')";
    }

    // Check if $sizes is not empty and is an array, or convert it to an array
    $sizes = !empty($sizes) && is_array($sizes) ? $sizes : [$sizes];

    // Assuming $sizes is an array of size names, e.g., ['Small', 'Medium']
    if (!empty($sizes) && $sizes[0] !== '') {
        $sizesArray = explode(",", $_POST['sizes']);
        $sizes = array();
        foreach ($sizesArray as $size) {
            $sizes[] = $size;
        }
        // Join the sizes table to get product sizes
        $sizesFilter = implode("','", $sizes);

        // Additional condition to check inventory for the selected sizes
        $sizeFilter = implode("','", $sizes);
        $query .= " AND product_id IN (
            SELECT DISTINCT product_id FROM product_sizes ps
            JOIN sizes s ON ps.size_id = s.size_id
            WHERE s.size IN ('$sizeFilter')
        )";

        $query .= " AND product_id IN (
    SELECT DISTINCT i.product_id
    FROM inventory i
    JOIN sizes s ON i.size_id = s.size_id
    WHERE i.quantity > 0
      AND s.size IN ('$sizeFilter')
)";
    }

    // Only show products in inventory
    $query .= " AND product_id IN (
        SELECT DISTINCT product_id
        FROM inventory
        WHERE quantity > 0
    )";

    if (!empty($from) && !empty($to) && $from !== 'null' && $to !== '') {
        $query .= " AND price BETWEEN $from AND $to";
    }

    // echo json_encode($query);
    // echo json_encode(var_dump($from));

    // // Execute the query
    $result = $con->query($query);

    // Check if there are results
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        // If there are no results, output a message
        $data = array('message' => 'No data to display');
        echo json_encode($data);
    }

    // Close the database connection
    $con->close();
} else {
    // If it's not an AJAX request, handle accordingly (optional)
    echo "Invalid request";
}
