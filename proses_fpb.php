<?php
// Jika diakses langsung tanpa submit, redirect ke form
if (!isset($_POST['hitung'])) {
    header("Location: index.html");
    exit();
}

// Fungsi Algoritma Euclidean untuk menghitung FPB
function hitungFPB($a, $b) {
    // Pastikan angka positif
    $a = abs($a);
    $b = abs($b);
    
    // Algoritma Euclidean
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    
    return $a;
}

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hitung'])) {
    
    // Tangkap input dari form
    $angka1 = isset($_POST['angka1']) ? (int)$_POST['angka1'] : 0;
    $angka2 = isset($_POST['angka2']) ? (int)$_POST['angka2'] : 0;
    
    // Validasi input
    $error = "";
    if ($angka1 <= 0 || $angka2 <= 0) {
        $error = "Mohon masukkan angka positif yang lebih besar dari 0!";
    }
    
    // Hitung FPB jika tidak ada error
    if (empty($error)) {
        $fpb = hitungFPB($angka1, $angka2);
        
        // Tentukan status relatif prima
        if ($fpb == 1) {
            $status = "RELATIF PRIMA";
            $statusClass = "prima";
            $message = "Kedua angka $angka1 dan $angka2 adalah RELATIF PRIMA";
        } else {
            $status = "TIDAK RELATIF PRIMA";
            $statusClass = "tidak-prima";
            $message = "Kedua angka $angka1 dan $angka2 TIDAK RELATIF PRIMA";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan FPB</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .result-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .input-values {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .input-values p {
            font-size: 18px;
            color: #004085;
        }

        .input-values strong {
            font-size: 20px;
            color: #667eea;
        }

        .fpb-box {
            text-align: center;
            margin-bottom: 20px;
        }

        .fpb-label {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }

        .fpb-value {
            font-size: 48px;
            font-weight: bold;
            color: #667eea;
            margin: 10px 0;
        }

        .status {
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .prima {
            background: #d4edda;
            color: #155724;
            border: 2px solid #28a745;
        }

        .tidak-prima {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #dc3545;
        }

        .error {
            background: #fff3cd;
            color: #856404;
            border: 2px solid #ffc107;
        }

        .message {
            text-align: center;
            padding: 15px;
            background: #e9ecef;
            border-radius: 10px;
            color: #495057;
            font-size: 16px;
            margin-bottom: 25px;
        }

        .button-group {
            display: flex;
            gap: 15px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .algorithm-info {
            margin-top: 20px;
            padding: 15px;
            background: #f1f3f5;
            border-radius: 8px;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Hasil Perhitungan FPB</h1>
        
        <?php if (!empty($error)): ?>
            <div class="result-card">
                <div class="status error">
                    ⚠️ Error
                </div>
                <div class="message">
                    <?php echo $error; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="result-card">
                <div class="input-values">
                    <p>Bilangan yang dihitung:</p>
                    <p><strong><?php echo $angka1; ?></strong> dan <strong><?php echo $angka2; ?></strong></p>
                </div>

                <div class="fpb-box">
                    <div class="fpb-label">FPB (Faktor Persekutuan Terbesar)</div>
                    <div class="fpb-value"><?php echo $fpb; ?></div>
                </div>

                <div class="status <?php echo $statusClass; ?>">
                    <?php echo $status; ?>
                </div>

                <div class="message">
                    <?php echo $message; ?>
                </div>
            </div>

            <div class="algorithm-info">
                <strong>🔍 Informasi Algoritma Euclidean:</strong><br>
                Algoritma Euclidean menghitung FPB dengan cara:<br>
                <code>FPB(a,b) = FPB(b, a mod b)</code> sampai b = 0, maka FPB = a
            </div>
        <?php endif; ?>

        <div class="button-group">
            <a href="index.html" class="btn btn-primary">← Hitung Lagi</a>
            <button onclick="window.print()" class="btn btn-secondary">🖨️ Cetak Hasil</button>
        </div>
    </div>
</body>
</html>