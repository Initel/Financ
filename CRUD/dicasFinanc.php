<?php
$perfil = "";
$dicas = "";
$acoes = [];

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $risco = isset($_POST['risco']) ? $_POST['risco'] : null;
    $horizonte = isset($_POST['horizonte']) ? $_POST['horizonte'] : null;

    // Lógica para determinar o perfil do investidor
    if ($risco == 'baixo' && $horizonte == 'curto') {
        $perfil = 'Conservador';
    } elseif ($risco == 'moderado' || $horizonte == 'medio') {
        $perfil = 'Moderado';
    } else {
        $perfil = 'Agressivo';
    }

    // Integração com a API da Alpha Vantage
    $apiKey = '6UA9B8FDDTO6DBXM'; // Sua chave de API

    // Array para armazenar ações de acordo com o perfil
    $acoesPerfil = [];
    if ($perfil == 'Conservador') {
        $acoesPerfil = ['AAPL', 'MSFT', 'GOOGL']; // Exemplos de ações conservadoras
    } elseif ($perfil == 'Moderado') {
        $acoesPerfil = ['TSLA', 'AMZN', 'NFLX']; // Exemplos de ações moderadas
    } else {
        $acoesPerfil = ['NVDA', 'AMD', 'PYPL']; // Exemplos de ações agressivas
    }

    // Obtendo os dados de cada ação
    foreach ($acoesPerfil as $acao) {
        $url = "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=$acao&interval=5min&apikey=$apiKey";
        $response = file_get_contents($url);
        
        // Debug: Mostra a resposta da API
        $data = json_decode($response, true);
        if (!$data) {
            $acoes[] = "$acao: Dados não disponíveis (sem resposta da API).";
            continue;
        }

        // Verifica se obteve dados válidos
        if (isset($data['Time Series (5min)'])) {
            $latestTime = array_key_first($data['Time Series (5min)']);
            $latestData = $data['Time Series (5min)'][$latestTime];
            $acoes[] = $acao . ": " . $latestData['1. open'] . " (Aberto)";
        } else {
            $acoes[] = "$acao: Dados não disponíveis.";
        }
    }

    // Dicas baseadas no perfil
    if ($perfil == 'Conservador') {
        $dicas = "Invista em títulos de renda fixa e fundos de baixo risco.";
    } elseif ($perfil == 'Moderado') {
        $dicas = "Diversifique com ações e renda fixa. Veja as tendências atuais no mercado.";
    } else {
        $dicas = "Ações de crescimento e fundos de alto risco são boas opções. Acompanhe as tendências atuais.";
    }

    // Gera o script para exibir os resultados em um alerta
    echo "<script type='text/javascript'>
            alert('Seu perfil de investidor é: {$perfil}\\n\\nDicas: {$dicas}\\n\\nPrincipais ações do dia: " . implode(', ', $acoes) . "');
          </script>";
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dicas Financeiras</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container">
  <div class="card" style="width: 400px; margin: 0 auto;">
    <div class="card-body text-center">
      <h1>Descubra seu Perfil de Investidor</h1>
      <form method="POST" action="" class="form-horizontal">
        <div class="form-group">
          <label for="risco" class="col-sm-12 control-label">Tolerância ao Risco</label>
          <div class="col-sm-12">
            <label><input type="radio" name="risco" value="baixo" required> Baixa</label><br>
            <label><input type="radio" name="risco" value="moderado"> Moderada</label><br>
            <label><input type="radio" name="risco" value="alto"> Alta</label>
          </div>
        </div>

        <div class="form-group">
          <label for="horizonte" class="col-sm-12 control-label">Horizonte de Investimento</label>
          <div class="col-sm-12">
            <label><input type="radio" name="horizonte" value="curto" required> Curto Prazo</label><br>
            <label><input type="radio" name="horizonte" value="medio"> Médio Prazo</label><br>
            <label><input type="radio" name="horizonte" value="largo"> Longo Prazo</label>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-12">
            <button type="submit"  style="background-color: #8a13eb; color: #ffffff;" class="btn">Descobrir Perfil</button>
            <a type="submit" class="btn btn-secondary" href="?page=home">Voltar</a>              
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

    <!-- <div class="container">
        <h1 class="text-center">Descubra seu Perfil de Investidor</h1>

        <form method="POST" action="" class="form-horizontal">
            <div class="form-group">
                <label for="risco" class="col-sm-2 control-label">Tolerância ao Risco</label>
                <div class="col-sm-10">
                    <label><input type="radio" name="risco" value="baixo" required> Baixa</label><br>
                    <label><input type="radio" name="risco" value="moderado"> Moderada</label><br>
                    <label><input type="radio" name="risco" value="alto"> Alta</label>
                </div>
            </div>

            <div class="form-group">
                <label for="horizonte" class="col-sm-2 control-label">Horizonte de Investimento</label>
                <div class="col-sm-10">
                    <label><input type="radio" name="horizonte" value="curto" required> Curto Prazo</label><br>
                    <label><input type="radio" name="horizonte" value="medio"> Médio Prazo</label><br>
                    <label><input type="radio" name="horizonte" value="largo"> Longo Prazo</label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Descobrir Perfil</button>
                    <a type="submit" class="btn btn-secondary w-100" href="?page=home">Voltar</a>             
                </div>
            </div>
        </form>
    </div> -->
</body>
</html>