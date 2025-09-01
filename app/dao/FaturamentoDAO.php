<?php

namespace app\dao;

use app\model\Faturamento;
use PDO;

class FaturamentoDAO extends DAO
{
    public function inserir(Faturamento $faturamento): ?Faturamento
    {
        $sql = "INSERT INTO Faturamento_Mes (usuario_id, mes, valor, descricao, safra_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = self::$conexao->prepare($sql);
        $ok = $stmt->execute([
            $faturamento->usuario_id,
            $faturamento->mes,
            $faturamento->valor,
            $faturamento->descricao,
            $faturamento->safra_id
        ]);
        if ($ok) {
            $faturamento->id_faturamento = self::$conexao->lastInsertId();
            return $faturamento;
        }
        return null;
    }

    public function atualizar(Faturamento $faturamento): ?Faturamento
    {
        $sql = "UPDATE Faturamento_Mes SET mes=?, valor=?, descricao=?, safra_id=? WHERE id_faturamento=? AND usuario_id=?";
        $stmt = self::$conexao->prepare($sql);
        $ok = $stmt->execute([
            $faturamento->mes,
            $faturamento->valor,
            $faturamento->descricao,
            $faturamento->safra_id,
            $faturamento->id_faturamento,
            $faturamento->usuario_id
        ]);
        return $ok ? $faturamento : null;
    }

    public function deletar(int $idFaturamento, ?int $usuarioId = null): bool
    {
        $sql = "DELETE FROM Faturamento_Mes WHERE id_faturamento=?";
        $params = [$idFaturamento];
        if ($usuarioId) {
            $sql .= " AND usuario_id=?";
            $params[] = $usuarioId;
        }
        $stmt = self::$conexao->prepare($sql);
        return $stmt->execute($params);
    }

    public function getBySafra(int $safraId, int $propriedadeId): array
    {
        $sql = "SELECT f.* FROM Faturamento_Mes f INNER JOIN Safra s ON f.safra_id = s.id_safra WHERE f.safra_id=? AND s.propriedade_id=? ORDER BY f.mes DESC";
        $stmt = self::$conexao->prepare($sql);
        $stmt->execute([$safraId, $propriedadeId]);
        $result = [];
        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Faturamento($dados);
        }
        return $result;
    }

    public function listarPorUsuario(int $usuarioId): array
    {
        $sql = "SELECT * FROM Faturamento_Mes WHERE usuario_id=? ORDER BY mes DESC";
        $stmt = self::$conexao->prepare($sql);
        $stmt->execute([$usuarioId]);
        $result = [];
        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Faturamento($dados);
        }
        return $result;
    }

    public function listarPorPropriedade(int $propriedadeId): array
    {
        $sql = "SELECT f.* FROM Faturamento_Mes f INNER JOIN Safra s ON f.safra_id = s.id_safra WHERE s.propriedade_id=? ORDER BY f.mes DESC";
        $stmt = self::$conexao->prepare($sql);
        $stmt->execute([$propriedadeId]);
        $result = [];
        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Faturamento($dados);
        }
        return $result;
    }

    public function receitaTotalPropriedade(int $propriedadeId): float
    {
        $sql = "SELECT SUM(fm.valor) as total FROM Faturamento_Mes fm INNER JOIN Safra s ON fm.safra_id = s.id_safra WHERE s.propriedade_id=?";
        $stmt = self::$conexao->prepare($sql);
        $stmt->execute([$propriedadeId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row && $row['total'] ? (float)$row['total'] : 0.0;
    }
}
