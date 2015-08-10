<?php
class Classe extends Conexao
{
    public static $tabela = 'classes';

    public $id;
    public $grupo_id;
    public $cnae_id;
    public $descricao;

    public function __construct($dados = array())
    {
        if(!empty($dados)) {
            $this->cnae_id = $dados->item(28)->textContent;
            $this->descricao = $dados->item(29)->textContent;
        }
    }

    public static function insert($classe)
    {
        $pdo = static::connect();
        $result = $pdo->prepare('INSERT INTO classes (grupo_id, cnae_id, descricao, criado_em, atualizado_em)
            VALUES (:grupo_id, :cnae_id, :descricao, NOW(), NOW())');
        $result->execute((array)$classe);
        return $pdo->lastInsertId();
    }
}
