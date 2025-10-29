<?php
require_once 'DeudaAmortizable.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $monto = floatval($_POST["monto"]);
    $tasa = floatval($_POST["tasa"]);
    $plazo = intval($_POST["plazo"]);

    $deuda = new DeudaAmortizable($monto, $tasa, $plazo);
    $tabla = $deuda->generarTablaAmortizacion();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Simulador de Tabla de Amortización</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #eee; }
        form { margin-bottom: 20px; }
        input, button { padding: 8px; margin: 5px 0; width: 200px; }
    </style>
</head>
<body>

<h2>Simulador de Tabla de Amortización</h2>

<form method="post" id="formAmortizacion" onsubmit="return validarFormulario()">
    <label>Monto de la Deuda:</label><br>
    <input type="number" step="0.01" name="monto" id="monto" required><br><br>

    <label>Tasa de Interés (% anual):</label><br>
    <input type="number" step="0.01" name="tasa" id="tasa" required><br><br>

    <label>Plazo (meses):</label><br>
    <input type="number" name="plazo" id="plazo" required><br><br>

    <button type="submit">Calcular</button>
</form>

<?php if (!empty($tabla)): ?>
    <h3>Tabla de Amortización</h3>
    <table>
        <tr>
            <th>Mes</th>
            <th>Cuota</th>
            <th>Interés</th>
            <th>Capital</th>
            <th>Saldo</th>
        </tr>
        <?php foreach ($tabla as $fila): ?>
        <tr>
            <td><?= $fila["mes"] ?></td>
            <td><?= number_format($fila["cuota"], 2) ?></td>
            <td><?= number_format($fila["interes"], 2) ?></td>
            <td><?= number_format($fila["capital"], 2) ?></td>
            <td><?= number_format($fila["saldo"], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<script>
function validarFormulario() {
    const monto = document.getElementById('monto').value;
    const tasa = document.getElementById('tasa').value;
    const plazo = document.getElementById('plazo').value;

    if (monto <= 0 || tasa <= 0 || plazo <= 0) {
        alert("Por favor, ingresa valores mayores a 0.");
        return false;
    }
    return true;
}
</script>

</body>
</html>
