$(document).ready(function () {
    $("#login-container").submit(function (e) {
        e.preventDefault(); // Zatrzymaj domyślne zachowanie formularza

        // Pobierz dane z formularza
        var usernameOrEmail = $("#username").val();
        var password = $("#password").val();

        // Wyślij dane na serwer do weryfikacji
        $.ajax({
            url: "login.php", // Ścieżka do pliku PHP obsługującego logowanie
            type: "POST",
            data: {
                usernameOrEmail: usernameOrEmail,
                password: password
            },
            dataType: "json",
            success: function (response) {
                // Odpowiedź z serwera
                if (response.success) {
                    // Zalogowano pomyślnie, zmień tekst labela na informację o udanym logowaniu
                    $("#info").text("Zalogowano pomyślnie.");
                    $("#info").css("color", "green");
                    // Przekieruj na stronę główną lub wykonaj inne akcje
                    window.location.href = "strona-glowna.html";
                } else {
                    // Wyświetl komunikat o błędzie logowania
                    $("#info").text(response.message);
                    $("#info").css("color", "red");
                }
            },
            error: function () {
                // Błąd AJAX
                alert("Błąd podczas logowania. Spróbuj ponownie.");
            }
        });
    });
});