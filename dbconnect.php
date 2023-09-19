<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firma_energia";

// Połączenie z bazą danych MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Zapytanie SQL do pobrania danych
$sql = "SELECT * FROM klienci";
$result = $conn->query($sql);

// Pobranie danych i przekazanie ich do frontendu
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Zamiana danych na format JSON (opcjonalne)
echo json_encode($data);

$conn->close();
?>