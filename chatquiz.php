<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}

// Soruları veritabanından çek
$sql = "SELECT * FROM sorular";
$result = $conn->query($sql);

// Kullanıcının cevapları saklamak için bir dizi oluştur
$kullaniciCevaplari = array();

// Form gönderildiyse kullanıcının cevaplarını kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    while ($row = $result->fetch_assoc()) {
        $soruID = $row["sorular_id"];
        $dogruCevap = $row["dogru_cevap"];
        $kullaniciCevap = $_POST[$soruID];

        echo "<p>" . $row["soru_metni"] . "</p>";

        // Kullanıcının cevabını kontrol et
        if ($kullaniciCevap == $dogruCevap) {
            echo "Cevabınız Doğru!";
        } else {
            echo  "<p>". "Cevabınız Yanlış. Doğru Cevap: ". "</p>" . $dogruCevap;
        }
        echo "<br>";
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Uygulaması</title>
</head>

<body>
    <form method="post" action="chatquiz.php">
        <?php
        if ($result->num_rows > 0) {
            $result->data_seek(0); // Soruları tekrar başa al
            while ($row = $result->fetch_assoc()) {
                $soruID = $row["sorular_id"];
                echo '<p>' . $row["soru_metni"] . '</p>';
                echo '<label><input type="radio" name="' . $soruID . '" value="A">' . $row["cevap_a"] . '</label><br>';
                echo '<label><input type="radio" name="' . $soruID . '" value="B">' . $row["cevap_b"] . '</label><br>';
                echo '<label><input type="radio" name="' . $soruID . '" value="C">' . $row["cevap_c"] . '</label><br>';
            
            }
            echo '<br><input type="submit" value="Cevapları Gönder">';
        } else {
            echo "Veritabanında soru bulunamadı.";
        }
        ?>
    </form>
</body>

</html>
