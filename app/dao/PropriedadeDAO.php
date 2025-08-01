<?php
namespace app\dao;

use app\model\Propriedade;

final class PropriedadeDAO extends DAO
{
   public function inserir(Propriedade $model) : ?Propriedade
   {
      $sql = "INSERT INTO Propriedade (fk_Usuario_id_usuario, nome_propriedade, area_total, localizacao) VALUES (?, ?, ?, ?)";

      //Prepara a query SQL para execução com os valores dos parâmetros passados
      $stmt = parent::$conexao->prepare($sql);

      $stmt->bindValue(1, $model->fk_Usuario_id_usuario);
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
}