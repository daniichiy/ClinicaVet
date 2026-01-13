<?php

class AnimalView
{

    function ExibirTodosAnimais()
    {
        $animalController = new AnimalController();
        $listaTodosAnimais = $animalController->Listar();

        for ($i = 0; $i < count($listaTodosAnimais); $i++) {
            echo "<div class='caixaAnimal'>
                    <a href='atendimento.html'>
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
                    <a href='atendimento.html'>
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
}
