
-- Query 1
INSERT INTO clients (clientId, clientLevel, clientFirstname, clientLastname, clientEmail, clientPassword, comment)
VALUES(DEFAULT, DEFAULT, "Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "\"I am the real Ironman\"");

-- Query 2
UPDATE clients
SET clientLevel = "3"
WHERE clientId = 1;

-- Query 3
UPDATE inventory
SET invDescription = REPLACE(invDescription, 'small interior', 'spacious interior')
WHERE invId = 12;

-- Query 4 (Disable Rollback)
SELECT invModel, classificationName
FROM inventory i
JOIN carclassification c
ON i.classificationId = c.classificationId
WHERE classificationName = "SUV";

-- Query 5
DELETE 
FROM inventory
WHERE invId = 1;

-- Query 6
UPDATE inventory
SET invImage = concat("/phpmotors", invImage), invThumbnail = concat("/phpmotors", invThumbnail);
