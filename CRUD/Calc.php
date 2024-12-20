<?php

function calcularJurosCompostos($capitalInicial, $taxaJuros, $tempo, $periodicidade, $aporteMensal) {
  $jurosCompostos = $capitalInicial;
  for ($i = 0; $i < $tempo * $periodicidade; $i++) {
    $jurosCompostos = ($jurosCompostos + $aporteMensal) * (1 + ($taxaJuros / 100) / $periodicidade);
  }
  return $jurosCompostos;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculadora de Juros Compostos</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    .container {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: sticky;
    top: 0;
    }

  
  </style>
</head>
<body>
  <div class="container mt-n5">
    <div class="card sticky-top" style="max-width: 500px; height: 85vh;">
      <div class="card-header">
        <h2 class="text-center">Calculadora de Juros Compostos</h2>
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="capitalInicial">Capital Inicial:</label>
            <input type="number" id="capitalInicial" name="capitalInicial" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="taxaJuros">Taxa de Juros (%):</label>
            <input type="number" id="taxaJuros" name="taxaJuros" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tempo">Tempo (anos):</label>
            <input type="number" id="tempo" name="tempo" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="periodicidade">Periodicidade:</label>
            <select id="periodicidade" name="periodicidade" class="form-control">
              <option value="12">Mensal</option>
              <option value="4">Trimestral</option>
              <option value="2">Semestral</option>
              <option value="1">Anual</option>
            </select>
          </div>
          <div class="form-group">
            <label for="aporteMensal">Aporte Mensal:</label>
            <input type="number" id="aporteMensal" name="aporteMensal" class="form-control" required>
          </div>
          <button type="submit"  style="background-color: #8a13eb; color: #ffffff;" class="btn w-100 mb-2">Calcular Juros Compostos</button>
          <a type="submit" class="btn btn-secondary w-100" href="?page=home">Voltar</a>                        
        </form>

        <?php
        if (isset($_POST["capitalInicial"]) && isset($_POST["taxaJuros"]) && isset($_POST["tempo"]) && isset($_POST["periodicidade"]) && isset($_POST["aporteMensal"])) {
          $capitalInicial = $_POST["capitalInicial"];
          $taxaJuros = $_POST["taxaJuros"];
          $tempo = $_POST["tempo"];
          $periodicidade = $_POST["periodicidade"];
          $aporteMensal = $_POST["aporteMensal"];

          $jurosCompostos = calcularJurosCompostos($capitalInicial, $taxaJuros, $tempo, $periodicidade, $aporteMensal);

          echo "<script>alert('O valor final após $tempo anos é de R$ " . number_format($jurosCompostos, 2, ",", ".") . "');</script>";
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>