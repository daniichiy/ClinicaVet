<?php

class AnimalView
{

    function ExibirTodosAnimais()
    {
        $animalController = new AnimalController();
        $listaTodosAnimais = $animalController->Listar();
        
        var_dump($listaTodosAnimais);

        for ($i = 0; $i < count($listaTodosAnimais); $i++) {
            echo "<div class='caixaAnimal'>
                    <a href='atendimento.php?cod={$listaTodosAnimais[$i]->Codigo}'>
                        <img src='images/{$listaTodosAnimais[$i]->Nome}.png'>
                        <div>
                            <h1>{$listaTodosAnimais[$i]->Nome}</h1>
                            <p>{$listaTodosAnimais[$i]->Especie->Nome}</p>
                        </div>
                    </a>
                </div>";
        }
    }

    function BuscarPeloNome($nome)
    {
        $animalController = new AnimalController();
        $listaAnimaisComNome = $animalController->BuscarPeloNome($nome);

        if (count($listaAnimaisComNome) == 0) {
            echo "<p>Animal não encontrado!</p>";
        } else {
            for ($i = 0; $i < count($listaAnimaisComNome); $i++) {
                echo "<div class='caixaAnimal'>
                    <a href='atendimento.php?cod={$listaAnimaisComNome[$i]->Codigo}'>
                        <img src='images/{$listaAnimaisComNome[$i]->Nome}.png'>
                        <div>
                            <h1>{$listaAnimaisComNome[$i]->Nome}</h1>
                            <p>{$listaAnimaisComNome[$i]->Especie->Nome}</p>
                        </div>
                    </a>
                </div>";
            }
        }
    }

    function TrazerNome($codigo){
        $animalController = new AnimalController;
        $nome = $animalController->BuscarNome($codigo);
        
        // if(!empty($nome)){
        //     echo "<div class='item-form'>
        //         <label>Nome do animal:</label>
        //         <input type='text' value='{$nome}' disabled>
        //     </div>";
        // }

        return $nome;
    }
}
