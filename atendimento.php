<?php
    require_once('config/config.php');
    $cod = $_GET['cod'] ?? '';


    $animalView = new AnimalView();
    $tratamentoView = new TratamentoView();
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
        <form action="<?php  //echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="item-form">
                <label>Nome do animal:</label>
                <input type="text" value="<?php echo $animalView->TrazerNome($cod);?>" disabled>
            </div>
            <?php //echo $animalView->TrazerNome($cod); ?>

            <div class="item-form">
                <label>Data:</label>
                <input type="date">
            </div>

            <div class="item-form">
                <label>Tratamento:</label>
                <select>
                    <option selected disabled>Selecione o Tratamento</option>
                    <?php  $tratamentoView->ExibirTratamentos();?>
                    <!-- add os options aqui -->
                </select>
            </div>


            <div class="item-form-bloco">
                <label>Descrição do Tratamento:</label>
                <textarea rows="2" disabled>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere ducimus saepe eum ea id, ex, deleniti non repellendus impedit provident laborum perferendis excepturi voluptate voluptatum magnam dolor rerum, laudantium velit?</textarea>
                <!-- trazer a descrição do tratamento selecionado aqui -->
            </div>

            <div class="item-form-bloco">
                <label>Descrição do Atendimento:</label>
                <textarea rows="6"></textarea>
            </div>

            <button class="botao">Salvar</button>
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
                <?php $tratamentoView->ExibirHistorico($cod); ?>
            </tbody>
        </table>

        
    </section>
</body>
</html>