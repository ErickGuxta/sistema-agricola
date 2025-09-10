<?php

namespace app\controller;

use app\model\Usuario;
use app\dao\UsuarioDAO;
use app\dao\PropriedadeDAO;

final class UsuarioController
{
    // Declarar propriedades ou métodos de uma classe como estáticos faz deles acessíveis sem a necessidade de instanciar a classe
    public static function index() : void
    {
        $model = new Usuario();
        $erro = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            // Validar se os campos estão preenchidos
            if (empty($_POST['nome_produtor']) || empty($_POST['email']) || empty($_POST['senha'])) {
                $erro = "Todos os campos são obrigatórios";
            } else {
                // Verificar se o email já existe
                $usuarioDAO  = new UsuarioDAO();
                $emailExiste = $usuarioDAO->verificarEmail($_POST['email']);
                
                if ($emailExiste) {
                    $erro = "Este email já está cadastrado";
                } else {
                    $model->nome_produtor = $_POST['nome_produtor'];
                    $model->email         = $_POST['email'];
                    $model->senha         = $_POST['senha'];

                    // Upload da foto de perfil
                    $foto_perfil = '/sistema-agricola/app/view/img/image5.png'; // Caminho padrão
                    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                        $ext = strtolower($ext);
                        $permitidas = ['jpg', 'jpeg', 'png'];
                        if (in_array($ext, $permitidas)) {
                            $dir = __DIR__ . '/../view/uploads/perfil/';
                            if (!is_dir($dir)) {
                                mkdir($dir, 0777, true);
                            }
                            $nome_arquivo = uniqid('perfil_') . '.' . $ext;
                            $destino = $dir . $nome_arquivo;
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $destino)) {
                                $foto_perfil = '/sistema-agricola/app/view/uploads/perfil/' . $nome_arquivo;
                            }
                        }
                    }
                    $model->foto_perfil = $foto_perfil;
                    
                    $usuarioRegistrado = $model-> registrar();

                    if($usuarioRegistrado !== null)
                    {
                        // CRIAR SESSÃO DO USUÁRIO
                        $_SESSION['usuario_id']     = $usuarioRegistrado->id_usuario;
                        $_SESSION['usuario_nome']   = $usuarioRegistrado->nome_produtor;
                        $_SESSION['usuario_email']  = $usuarioRegistrado->email;
                        $_SESSION['usuario_foto']   = $usuarioRegistrado->foto_perfil;
                        $_SESSION['logado']         = true;
                        $_SESSION['ultimo_acesso']  = time();
                        
                        // Redirecionar para página de cadastro de propriedade
                        header("Location: /sistema-agricola/app/registro-propriedade");
                        exit;
                    } else {
                        $erro = "Erro ao cadastrar usuário. Tente novamente.";
                    }
                }
            }
        }

        // Passar as variáveis para a view
        include VIEWS . '/login/cadastro_user.php';

    }

    public static function logout() : void
    {
        session_destroy();
        header("Location: /sistema-agricola/app/login");
        exit;
    }

    public static function login() : void
    {
        $erro = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            if (empty($email) || empty($senha)) {
                $erro = "Todos os campos são obrigatórios";
            } else {
                $usuarioDAO = new UsuarioDAO();
                $usuario = $usuarioDAO->verificarLogin($email, $senha);
                
                if ($usuario) {
                    // Criar sessão do usuário
                    $_SESSION['usuario_id']    = $usuario-> id_usuario;
                    $_SESSION['usuario_nome']  = $usuario-> nome_produtor;
                    $_SESSION['usuario_email'] = $usuario-> email;
                    $_SESSION['logado']        = true;
                    $_SESSION['ultimo_acesso'] = time();
                    
                    // Verificar se o usuário já tem propriedade cadastrada
                    $propriedadeDAO = new PropriedadeDAO();
                    $propriedade = $propriedadeDAO-> buscarPorUsuario($usuario->id_usuario);
                    
                    if ($propriedade) {
                        // Se tem propriedade, salvar na sessão e ir para dashboard
                        $_SESSION['propriedade_id']  = $propriedade->id_propriedade;
                        $_SESSION['propriedade_nome'] = $propriedade->nome_propriedade;

                        header("Location: /sistema-agricola/app/dashboard");
                    } else {
                        // Se não tem propriedade, ir para cadastro de propriedade
                        header("Location: /sistema-agricola/app/registro-propriedade");
                    }
                    exit;
                } else {
                    $erro = "Email ou senha incorretos";
                }
            }
        }

        // Passar as variáveis para a view
        include VIEWS . '/login/login.php';
    }

    public static function atualizar() : void
    {
        session_start();
        $erro = "";
        $usuarioDAO = new UsuarioDAO();
        $id_usuario = $_SESSION['usuario_id'];
        $usuario = $usuarioDAO->verificarEmail($_SESSION['usuario_email']);
        if (!$usuario) {
            $erro = "Usuário não encontrado.";
            header("Location: /sistema-agricola/app/dashboard?erro=1");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome_produtor'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');
            $foto_perfil = $usuario->foto_perfil;
            // Upload de nova foto
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $ext = strtolower($ext);
                $permitidas = ['jpg', 'jpeg', 'png'];
                if (in_array($ext, $permitidas)) {
                    $dir = __DIR__ . '/../view/uploads/perfil/';
                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                    }
                    $nome_arquivo = uniqid('perfil_') . '.' . $ext;
                    $destino = $dir . $nome_arquivo;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $destino)) {
                        $foto_perfil = '/sistema-agricola/app/view/uploads/perfil/' . $nome_arquivo;
                    }
                }
            }
            // Atualizar dados
            $usuario->nome_produtor = $nome;
            $usuario->email = $email;
            $usuario->foto_perfil = $foto_perfil;
            if (!empty($senha)) {
                $usuario->senha = $senha;
            } else {
                $usuario->senha = null;
            }
            $atualizado = $usuarioDAO->atualizar($usuario);
            if ($atualizado) {
                $_SESSION['usuario_nome'] = $usuario->nome_produtor;
                $_SESSION['usuario_email'] = $usuario->email;
                $_SESSION['usuario_foto'] = $usuario->foto_perfil;
                header("Location: /sistema-agricola/app/dashboard?sucesso=1");
                exit;
            } else {
                $erro = "Erro ao atualizar perfil.";
                header("Location: /sistema-agricola/app/dashboard?erro=1");
                exit;
            }
        }
    }

    public static function deletar() : void
    {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-agricola/app/login");
            exit;
        }
        $usuarioId = $_SESSION['usuario_id'];
        $usuarioDAO = new \app\dao\UsuarioDAO();
        $ok = $usuarioDAO->deletarCascata($usuarioId);
        session_destroy();
        if ($ok) {
            header("Location: /sistema-agricola/app/view/login/cadastro_user.php?msg=Conta+excluida+com+sucesso");
        } else {
            header("Location: /sistema-agricola/app/dashboard?erro=Erro+ao+deletar+conta");
        }
        exit;
    }
}