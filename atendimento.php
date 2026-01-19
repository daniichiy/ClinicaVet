<?php
require_once 'config/config.php';

$codAnimal = $_GET['cod'] ?? null;

$animalView = new AnimalView();
$tratamentoView = new TratamentoView();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar'])) {

    $prontuarioController = new ProntuarioController();

    $prontuarioController->SalvarProntuario(
        $_POST['animalCod'],
        $_POST['tratamento'] ?? null,
        $_POST['data-prontuario'] ?? null,
        $_POST['descricao-obs'] ?? null
    );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimento</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleAtendimento.css">
</head>

<body>
    <section id="area-titulo">
        <h1>Atendimento</h1>
        <a href="index.php" class="botao">Voltar</a>
    </section>

    <section id="area-tratamento">
        <h1>Registro de atendimento</h1>
        <form action="atendimento.php?cod=<?php echo $codAnimal; ?>" method="POST">
            <div class="item-form">
                <label>Nome do animal:</label>
                <input type="text" value="<?php echo $animalView->TrazerNome($codAnimal); ?>" disabled>
            </div>

            <div class="item-form">
                <label>Data:</label>
                <input name="data-prontuario" id="data-prontuario" type="datetime-local" required>
            </div>

            <div class="item-form">
                <label>Tratamento:</label>
                <select id="tratamento" name="tratamento" required>
                    <option selected disabled>Selecione o Tratamento</option>
                    <?php
                    $lista = $tratamentoView->ExibirTratamentos();
                    ?>
                </select>

            </div>

            <div class="item-form-bloco">
                <label>Descrição do Tratamento:</label>
                <textarea id="descricaoTratamento" name="descricaoTratamento" rows="2" disabled></textarea>
            </div>

            <div class="item-form-bloco">
                <label>Descrição do Atendimento:</label>
                <textarea name="descricao-obs" id="descricao-obs" rows="6"></textarea>
            </div>

            <button class="botao" type="submit" name="salvar">Salvar</button>
            <input type="hidden" name="animalCod" value="<?php echo $codAnimal; ?>">
        </form>
    </section>

    <section id="area-historico">
        <h1>Histórico</h1>
        <table>
            <thead>
                <th>Data</th>
                <th>Tratamento</th>
                <th>Descrição do Tratamento</th>
            </thead>
            <tbody>
                <?php $tratamentoView->ExibirHistorico($codAnimal); ?>
            </tbody>
        </table>
    </section>

    <script src="js/atendimento.js"></script>
</body>
</html>