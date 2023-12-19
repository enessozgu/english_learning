<?php
include("baglanti.php");

// $soru değişkenini tanımla (örneğin, 1 olarak varsayalım)
$soru = 1;

$sql = "SELECT soru_metni FROM sorular WHERE sorular_id = ?";
$stmt = $baglan->prepare($sql);
$stmt->bind_param("i", $soru);
$stmt->execute();
$stmt->bind_result($soru_metni);
$stmt->fetch();
$stmt->close();


$sql = "SELECT cevap_a FROM sorular WHERE sorular_id = ?";
$stmt = $baglan->prepare($sql);
$stmt->bind_param("i", $soru);
$stmt->execute();
$stmt->bind_result($cevap_a);
$stmt->fetch();
$stmt->close();







$sql = "SELECT cevap_b FROM sorular WHERE sorular_id = ?";
$stmt = $baglan->prepare($sql);
$stmt->bind_param("i", $soru);
$stmt->execute();
$stmt->bind_result($cevap_b);
$stmt->fetch();
$stmt->close();






$sql = "SELECT cevap_c FROM sorular WHERE sorular_id = ?";
$stmt = $baglan->prepare($sql);
$stmt->bind_param("i", $soru);
$stmt->execute();
$stmt->bind_result($cevap_c);
$stmt->fetch();
$stmt->close();



$sql = "SELECT dogru_cevap FROM sorular WHERE sorular_id = ?";
$stmt = $baglan->prepare($sql);
$stmt->bind_param("i", $soru);
$stmt->execute();
$stmt->bind_result($dogru_cevap);
$stmt->fetch();
$stmt->close();





$as=$cevap_c;





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="u ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

<script>if(addEventListener==as) </script>


</script>

    <script src="quiz.js"></script>
    <!-- Veriyi ekrana yazdır -->

    <div id="soru">
        <h1>
            <?php echo $soru_metni; ?>
        </h1>

    </div>




    <div class="cevaplar">
        <button class="btn btn-outline-dark">
            <ul>A:
                <?php echo $cevap_a; ?>
            </ul>
        </button>


        <button class="btn btn-outline-dark">
            <ul>B:
                <?php echo $cevap_b; ?>
            </ul>
        </button>
        <button class="btn btn-outline-dark">
            <ul>C:
                <?php echo $cevap_c; ?>
            </ul>
        </button>
        <ul></ul>


<form method="POST">
<input class="btn btn-outline-dark" name="a" value="<?php echo $cevap_a; ?> " type="submit">
<input class="btn btn-outline-dark" name="b" value="<?php echo $cevap_b; ?> " type="submit">
<input class="btn btn-outline-dark"  value="<?php echo $cevap_c; ?> " type="submit">
</form>


        <p id="saniye"></p>
        <button onclick="zamanlayici = setInterval(sure,1000)">Çalıştır</button>


        <script>

            var sayac=0;
            
            function sure(){
                document.getElementById("saniye").innerHTML=10-sayac;
                sayac++;
                if(sayac==0)clearInterval(zamanlayici);
            }

        </script>












        <br><br>

        <button id="ileri" class="btn btn-outline-dark" style="display:none;">İleri</button>
    </div>





</body>

</html>