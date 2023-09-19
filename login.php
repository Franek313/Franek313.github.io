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

// Odbierz dane POST z formularza
$usernameOrEmail = $_POST["usernameOrEmail"];
$password = $_POST["password"];

// Sprawdź, czy istnieje użytkownik o podanej nazwie użytkownika lub email
$sql = "SELECT * FROM uzytkownicy WHERE username = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Użytkownik istnieje, sprawdź hasło
    $row = $result->fetch_assoc();
    $storedPasswordHash = $row["password"];

    if (password_verify($password, $storedPasswordHash)) {
        // Hasło jest poprawne, zalogowano pomyślnie
        $response = array("success" => true, "message" => "Zalogowano pomyślnie.");
    } else {
        // Błędne hasło
        $response = array("success" => false, "message" => "Błąd logowania: Nieprawidłowe hasło.");
    }
} else {
    // Użytkownik nie istnieje
    $response = array("success" => false, "message" => "Błąd logowania: Użytkownik nie istnieje.");
}

// Zamień odpowiedź na format JSON i wyślij ją
header("Content-Type: application/json");
echo json_encode($response);

$conn->close();
?>