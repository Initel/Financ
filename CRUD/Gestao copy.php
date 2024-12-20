<?php

//Registro da entrada e saida no BD
function registro($tipo, $descricao, $valor){
    global $conn;
    $sql = "INSERT INTO $tipo (descricao, valor) VALUES ('$descricao', '$valor')";    
    if ($conn->query($sql) === TRUE){
        echo "<script>alert('Registro da $tipo feita com sucesso!');</script>";
    }else{
        echo "<script>alert('Erro ao registrar a $tipo: " . $conn->error . "');</script>";          
    }
}

// Formulário para registrar entrada
if (isset($_POST["registrar_entrada"])) {    
    registro($tipo = 'entradas', $descricao = $_POST["descricao"], $valor = $_POST["valor"]);    
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
}
// Formulário para registrar saida
if (isset($_POST["registrar_saida"])) {    
    registro($tipo = 'saidas', $descricao = $_POST["descricao"], $valor = $_POST["valor"]);
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
}

function listar_entradas_saidas() {
    global $conn;
    $sql = "SELECT *, 'Entrada' AS tipo FROM entradas UNION ALL SELECT *, 'Saída' AS tipo FROM saidas ORDER BY created_at DESC";
    $result = $conn->query($sql);

    echo "<h2 class='text-center'>Entradas e Saídas</h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>Data</th><th>Descrição</th><th>Valor</th><th>Tipo</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . date("d/m/Y H:i:s", strtotime($row["created_at"])) . "</td>";
        echo "<td>" . $row["descricao"] . "</td>";
        if ($row["tipo"] == 'Entrada') {
            echo "<td style='color: green'>+ R$ " . number_format($row["valor"], 2, ",", ".") . "</td>";
            echo "<td style='color: green'>" . $row["tipo"] . "</td>";
        } else {
            echo "<td style='color: red'>- R$ " . number_format($row["valor"], 2, ",", ".") . "</td>";
            echo "<td style='color: red'>" . $row["tipo"] . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";

    function calcular_totais() {
        global $conn;
        $sql_entradas = "SELECT SUM(valor) as total FROM entradas";
        $sql_saidas = "SELECT SUM(valor) as total FROM saidas";
    
        $result_entradas = $conn->query($sql_entradas);
        $result_saidas = $conn->query($sql_saidas);
    
        $total_entradas = $result_entradas->fetch_assoc()['total'] ?? 0;
        $total_saidas = $result_saidas->fetch_assoc()['total'] ?? 0;
    
        return [$total_entradas, $total_saidas];
    }
    
    list($total_entradas, $total_saidas) = calcular_totais();

}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Entradas e Saídas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="height: 70vh;">
        <div class="row">
            <div class="col-md-9"> <!-- Exibição -->
                <div class="card">
                    <div class="card-body" style="height: 465px; overflow-y: auto;">
                        <?php listar_entradas_saidas(); ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3"> 
                <div class="card mx-auto"> 
                    <div class="card-body text-center"> 
                    <h2>Registrar Entradas e Saídas</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" required>
                        </div>
                    <div class="form-group">
                        <label for="valor">Valor:</label>
                        <input type="number" class="form-control" id="valor" name="valor" required>
                    </div>
                        <button type="submit" name="registrar_entrada" class="btn btn-success w-100 mb-2">Registrar Entrada</button>
                        <button type="submit" name="registrar_saida" class="btn btn-danger w-100 mb-2">Registrar Saída</button>
                        <a type="submit" class="btn btn-secondary w-100 mb-2" href="?page=calculadora">Calculadora de juros</a>                        
                        <a type="submit" style="background-color: #8a13eb; color: #ffffff;" class="btn w-100" href="?page=dF">Dicas Financeiras</a>                        
                    </form>
                </div>
                </div>
                </div>
            </div>       
        </div>
    </div>
</body>
</html>


