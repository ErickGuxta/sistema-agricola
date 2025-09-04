<?php
namespace app\dao;

use app\model\Propriedade;

final class PropriedadeDAO extends DAO
{
   public function inserir(Propriedade $model) : ?Propriedade
   {
      $sql = "INSERT INTO Propriedade (usuario_id, nome_propriedade, area_total, localizacao) VALUES (?, ?, ?, ?)";

      //Prepara a query SQL para execução com os valores dos parâmetros passados
      $stmt = parent::$conexao->prepare($sql);

      $stmt->bindValue(1, $model->usuario_id);
      $stmt->bindValue(2, $model->nome_propriedade);
      $stmt->bindValue(3, $model->area_total);
      $stmt->bindValue(4, $model->localizacao);

      //Inserir os valores dos parâmetros na query
      if($stmt->execute())
      {
         $model->id_propriedade = parent::$conexao->lastInsertId();
         return $model;
      }

      return null;
   }

   public function buscarPorUsuario(int $usuarioId) : ?Propriedade
   {
      $sql = "SELECT * FROM Propriedade WHERE usuario_id = ? LIMIT 1";
      
      $stmt = parent::$conexao->prepare($sql);
      $stmt->bindValue(1, $usuarioId);
      $stmt->execute();
      
      $linha = $stmt->fetch(\PDO::FETCH_ASSOC);
      if (!$linha) {
         return null;
      }
      
      $propriedade = new Propriedade();
      $propriedade->id_propriedade    = (int) $linha['id_propriedade'];
      $propriedade->usuario_id        = (int) $linha['usuario_id'];
      $propriedade->nome_propriedade  = $linha['nome_propriedade'];
      $propriedade->area_total        = $linha['area_total'];
      $propriedade->localizacao       = $linha['localizacao'];
      
      return $propriedade;
   }
}