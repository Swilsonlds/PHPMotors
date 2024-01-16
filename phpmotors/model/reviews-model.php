<?php
// Model for performing CRUD operations on reviews

// Function to create review
function createReview($reviewText, $invId, $clientId){
    $db = createConnection();
    $sql = 'INSERT INTO reviews1 (reviewText, invId, clientId)
    VALUES(:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getReviewByInventoryItem($invId){
    $db = createConnection();
    $sql = 'SELECT *, clientFirstname, clientLastname FROM reviews1 JOIN clients ON reviews1.clientId = clients.clientId WHERE invId = :invId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $reviews; 
} 


function getReviewById($clientId){
    $db = createConnection();
    $sql = 'SELECT * FROM reviews1 JOIN clients ON reviews1.clientId = clients.clientId WHERE reviews1.clientId = :clientId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewInfo;
}

function getReviewByReviewId($reviewId){
    $db = createConnection();
    $sql = 'SELECT reviewText FROM reviews1 WHERE reviewId = :reviewId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetch(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $reviews; 
} 

function updateReview($reviewId, $reviewText){
    // Create a connection object using the phpmotors connection function
    $db = createConnection();
    // The SQL statement
    $sql = 'UPDATE reviews1 SET reviewText = :reviewText 
    WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function deleteReview($reviewId){
    // Create a connection object using the phpmotors connection function
    $db = createConnection();
    // The SQL statement
    $sql = 'DELETE FROM reviews1 WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}











?>