<?php
$servername = "localhost";
$username = "root";
$password = "37689622Ee88";
$dbname = "test_db";

// Bağlantı oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$sql = "SELECT * FROM yorumlar ORDER BY tarih_saat DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="kutum">';
        echo '<div class="kutu1">';
        echo '<h5 id="isim">' . htmlspecialchars($row['user_name']) . '</h5>';
        echo '<h6 id="mail">' . htmlspecialchars($row['user_mail']) . '</h6>';
        echo '<p id="yorum">' . htmlspecialchars($row['yorum']) . '</p>';
        echo '<p class="sag">' . htmlspecialchars($row['tarih_saat']) . '</p>';
        echo '<div class="clear"></div>';
        echo '</div>';
        echo '<hr>';
        echo '</div>';
    }
} else {
    echo "Henüz yorum yok.";
}

$conn->close();
?>
