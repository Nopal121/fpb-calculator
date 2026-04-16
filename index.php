<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kalkulator FPB</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            background: #667eea;
            color: white;
            border: none;
            cursor: pointer;
        }

        .hasil {
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
        }

        .prima {
            background: #d4edda;
        }

        .tidak {
            background: #f8d7da;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Kalkulator FPB</h2>

    <form method="POST">
        <label>Angka 1</label>
        <input type="number" name="a" required>

        <label>Angka 2</label>
        <input type="number" name="b" required>

        <button type="submit" name="hitung">Hitung FPB</button>
    </form>

    <?php
    // Fungsi Euclidean
    function hitungFPB($a, $b) {
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a;
    }

    if (isset($_POST['hitung'])) {
        $a = $_POST['a'];
        $b = $_POST['b'];

        $fpb = hitungFPB($a, $b);

        if ($fpb == 1) {
            echo "<div class='hasil prima'>";
            echo "<h3>Hasil FPB: $fpb</h3>";
            echo "<p><b>Kedua angka RELATIF PRIMA</b></p>";
            echo "</div>";
        } else {
            echo "<div class='hasil tidak'>";
            echo "<h3>Hasil FPB: $fpb</h3>";
            echo "<p><b>TIDAK RELATIF PRIMA</b></p>";
            echo "</div>";
        }
    }
    ?>
</div>

</body>
</html>