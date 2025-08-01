<?php

namespace app\controller;

use app\model\Propriedade;
use app\model\PropriedadeDAO;

final class PropriedadeController
{
    public static function index() : void
    {
        $model = new Propriedade();

        $erro = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Validar se os campos estão preenchidos
            if(empty($_POST['nome_propriedade']) || empty($_POST['area_total']) || empty($_POST['estado']) || empty($_POST['cidade'])) 
            {
                $erro = "Todos os campos são obrigatórios";
            } else{
                $model->nome_propriedade = $_POST['nome_propriedade'];
                $model->area_total = $_POST['area_total'];
                $model->localizacao = $_POST['estado'] . ' - ' . $_POST['cidade'];

                $model->fk_Usuario_id_usuario = 13; // Temporário - deve vir da sessão

                $propriedadeRegistrado = $model->registrar();

                if ($propriedadeRegistrado !== null) {
                    // Redirecionar para página de cadastro de propriedade
                    header("Location: /sistema-agricola/app/view/dashboard/home.php");
                    exit;
                } else{
                    $erro = "Erro ao cadastrar propriedade. Tente novamente.";

                }

            }
        }
        include VIEWS . '/propriedade/cadastro_propriedade.php';

    }
}
