<?php

namespace app\controller;

use app\model\ItemEstoque;
use app\model\Categoria;
use app\model\MovimentacaoEstoque;
use app\dao\ItemEstoqueDAO;
use app\dao\CategoriaDAO;

final class ItemEstoqueController
{
    public static function index()
    {

        $erro = "";
        $usuarioId = $_SESSION['usuario_id'];
        // Buscar propriedade do usuário
        $propriedadeDAO = new \app\dao\PropriedadeDAO();
        $propriedade = $propriedadeDAO->buscarPorUsuario($usuarioId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // verificar se o usuario vinculou o produto a uma safra
            if (!$propriedade) {
                $erro = 'Você precisa cadastrar uma propriedade antes de cadastrar novos itens. <a href="/sistema-agricola/app/registro-propriedade">Clique aqui para cadastrar</a>.';
            } else {
                $nome           = trim($_POST['nome']           ?? '');
                $categoria      = trim($_POST['categoria']      ?? '');
                $estoque_atual  = trim($_POST['estoque_atual']  ?? '');
                $estoque_minimo = trim($_POST['estoque_minimo'] ?? '');
                $validade       = trim($_POST['validade']       ?? '');
                $valor_unitario = trim($_POST['valor_unitario'] ?? '');
                $safra_id = isset($_POST['safra_id']) ? intval($_POST['safra_id']) : null;


                if ($nome === '' || $estoque_minimo === '' || $validade === '' || !$safra_id) {
                    $erro = 'Preencha os campos obrigatórios, incluindo a safra.';
                } else {
                    $categoriaDAO   = new CategoriaDAO();
                    $categorias     = $categoriaDAO->listarTodos();
                    $categoria_id   = null;
                    foreach ($categorias as $cat) {
                        if (strtolower($cat->nome) === strtolower($categoria)) {
                            $categoria_id = $cat->id_categoria;
                            break;
                        }
                    }
                    if ($categoria_id === null) {
                        $erro = 'Categoria inválida.';
                    } else {
                        $model = new ItemEstoque();
                        $model->usuario_id     = $usuarioId;
                        $model->nome           = $nome;
                        $model->categoria      = $categoria;
                        $model->categoria_id   = $categoria_id;
                        $model->estoque_atual  = $estoque_atual;
                        $model->estoque_minimo = $estoque_minimo;
                        $model->validade       = $validade;
                        $model->valor_unitario = $valor_unitario;
                        $model->safra_id       = $safra_id;

                        $itemRegistrado = $model->registrar();
                        if ($itemRegistrado !== null) {
                            header("Location: /sistema-agricola/app/estoque");
                            exit;
                        } else {
                            $erro = 'Erro ao cadastrar item. Tente novamente.';
                        }
                    }
                }
            }
        }

        // Buscar categorias para o select
        $categoriaDAO = new CategoriaDAO();
        $categorias = $categoriaDAO->listarTodos();

        // Buscar safras para o select
        $safraDAO = new \app\dao\SafraDAO();
        $safras = $safraDAO->listarPorUsuario($usuarioId);

        // Busca por nome, categoria e safra
        $filtro_nome = isset($_GET['busca']) ? trim($_GET['busca']) : '';
        $filtro_categoria = isset($_GET['categoria']) ? trim($_GET['categoria']) : '';
        $filtro_safra = isset($_GET['safra_id']) ? intval($_GET['safra_id']) : null;

        // Dados para listagem na view
        $itens = [];
        $alertas_baixo = 0;
        $proximos_validade = 0;
        $valor_total_estoque = 0.0;
        if ($propriedade) {
            $dao = new ItemEstoqueDAO();
            if ($filtro_safra) {
                $itens = \app\model\ItemEstoque::listarTodosPorSafra($usuarioId, $filtro_safra);
            } elseif ($filtro_nome !== '' || $filtro_categoria !== '') {
                $itens = $dao->buscarPorUsuarioNomeCategoria($usuarioId, $filtro_nome, $filtro_categoria);
            } else {
                $itens = ItemEstoqueDAO::listarTodosPorUsuario($usuarioId);
            }

            // Calcular métricas
            $hojeTs = strtotime(date('Y-m-d'));
            $limiteTs = strtotime('+30 days', $hojeTs);
            foreach ($itens as $it) {
                $qtd = (float) $it->estoque_atual;
                $min = (float) $it->estoque_minimo;
                if ($qtd <= $min) {
                    $alertas_baixo++;
                }

                if (!empty($it->validade)) {
                    $valTs = strtotime($it->validade);
                    if ($valTs !== false && $valTs >= $hojeTs && $valTs <= $limiteTs) {
                        $proximos_validade++;
                    }
                }

                $preco = (float) ($it->valor_unitario ?? 0);
                $valor_total_estoque += $qtd * $preco;
            }
        }

        include VIEWS . '/estoque/estoque.php';
    }

    public static function buscar() : void
    {

    }
    public static function atualizar() : void
    {
        $erro = "";
        $usuarioId = $_SESSION['usuario_id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_item        = $_POST['id']                  ?? null;
            $nome           = trim($_POST['nome']           ?? '');
            $categoria      = trim($_POST['categoria']      ?? '');
            $estoque_atual  = trim($_POST['estoque_atual']  ?? '');
            $estoque_minimo = trim($_POST['estoque_minimo'] ?? '');
            $validade       = trim($_POST['validade']       ?? '');
            $valor_unitario = trim($_POST['valor_unitario'] ?? '');

            // Buscar categoria_id
            $categoriaDAO = new \app\dao\CategoriaDAO();
            $categorias = $categoriaDAO->listarTodos();
            $categoria_id = null;
            foreach ($categorias as $cat) {
                if (strtolower($cat->nome) === strtolower($categoria)) {
                    $categoria_id = $cat->id_categoria;
                    break;
                }
            }
            if ($categoria_id === null) {
                $erro = 'Categoria inválida.';
            } else {
                $model = new \app\model\ItemEstoque();
                $model->id_item        = $id_item;
                $model->usuario_id     = $usuarioId;
                $model->nome           = $nome;
                $model->categoria      = $categoria;
                $model->categoria_id   = $categoria_id;
                $model->estoque_atual  = $estoque_atual;
                $model->estoque_minimo = $estoque_minimo;
                $model->validade       = $validade;
                $model->valor_unitario = $valor_unitario;
                $model->atualizar();
                header("Location: /sistema-agricola/app/estoque");
                exit;
            }
        }
        header("Location: /sistema-agricola/app/estoque");
        exit;
    }

    public static function deletar() : void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_item = $_POST['id'] ?? null;
            if ($id_item) {
                \app\model\ItemEstoque::deletar($id_item);
            }
        }
        header("Location: /sistema-agricola/app/estoque");
        exit;
    }

    public static function movimentacao() : void
    {
        $usuarioId = $_SESSION['usuario_id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item_id     = $_POST['produto_id']          ?? null;
            $tipo        = $_POST['tipo']                ?? null;
            $quantidade  = floatval($_POST['quantidade'] ?? 0);
            $motivo      = trim($_POST['motivo']         ?? '');
            
            if ($item_id && $tipo && $quantidade > 0) {
                // Buscar item
                $item = \app\model\ItemEstoque::getById((int)$item_id);
                if ($item) {
                    $estoqueAtual = (float)$item->estoque_atual;
                    if ($tipo === 'saida' && $quantidade > $estoqueAtual) {
                        $_SESSION['erro_movimentacao'] = 'Saída maior que o estoque disponível.';
                        header("Location: /sistema-agricola/app/estoque");
                        exit;
                    }

                    $novo_estoque = $estoqueAtual;
                    if ($tipo === 'entrada') {
                        $novo_estoque += $quantidade;
                    } elseif ($tipo === 'saida') {
                        $novo_estoque -= $quantidade;
                    }
                    // Atualizar estoque do item diretamente no DAO
                    \app\model\ItemEstoque::atualizarEstoque((int)$item_id, $novo_estoque);
                    // Registrar movimentação
                    $mov = new \app\model\MovimentacaoEstoque();
                    $mov->item_id           = (int)$item_id;
                    $mov->usuario_id        = $usuarioId;
                    $mov->tipo_movimentacao = strtoupper($tipo);
                    $mov->quantidade        = $quantidade;
                    $mov->observacao        = $motivo;
                    $mov->registrar();
                }
            }
        }
        header("Location: /sistema-agricola/app/estoque");
        exit;
    }


}
