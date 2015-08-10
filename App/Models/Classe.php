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

    public static function find($id)
    {
        $pdo = static::connect();
        $result = $pdo->prepare('SELECT cl.cnae_id as cl_id, cl.descricao as cl_descricao,
            gr.cnae_id as gr_id, gr.descricao as gr_descricao, dv.cnae_id as dv_id,
            dv.descricao as dv_descricao,sc.cnae_id as sc_id, sc.descricao as sc_descricao
            FROM classes cl inner join grupos gr on cl.grupo_id = gr.id
            inner join divisoes dv on gr.divisao_id = dv.id
            inner join secoes sc on dv.secao_id = sc.id where cl.id = :id');
        $result->bindValue(':id', $id);
        $result->execute();
        $result->setFetchMode(\PDO::FETCH_CLASS, get_class());
        return $result->fetch();
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
