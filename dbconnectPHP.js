$.ajax({
    url: "dbconnect.php", // Wstaw ścieżkę do pliku PHP
    type: "GET",
    dataType: "json",
    success: function (data) {
        // Tworzenie tabelki HTML
        var currentData = data;
        console.log(currentData); // Wyświetlenie danych w konsoli
        var table = "<table>";

        // Dodawanie nagłówków kolumn na podstawie kluczy z pierwszego rekordu danych
        table += "<tr id=\"table-header\">";
        for (var key in currentData[0]) {
            table += "<th>" + key + "</th>";
        }
        table += "</tr>";

        // Dodawanie wierszy z danymi
        for (var i = 0; i < currentData.length; i++) {
            table += "<tr>";

            // Iteracja przez klucze i dodawanie komórek z danymi
            for (var key in currentData[i]) {
                table += "<td>" + currentData[i][key] + "</td>";
            }
            table += "</tr>";
        }

        table += "</table>";

        // Wyświetlenie tabelki na stronie
        $("#table-container").html(table);
    },
    error: function () {
        console.error("Błąd pobierania danych z serwera.");
    }
});