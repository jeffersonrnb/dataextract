<?php
class Conexao
{
    public static function connect()
    {
        return new \PDO('mysql:host=localhost;dbname=cnae', 'root', '');
    }

    public static function findById($object)
    {
        $pdo = static::connect();
        $result = $pdo->prepare('SELECT * FROM ' . static::$tabela . ' WHERE cnae_id = :cnae_id');
        $result->bindValue(':cnae_id', $object->cnae_id);
        $result->execute();
        $result->setFetchMode(\PDO::FETCH_CLASS, get_class($object));
        return $result->fetch();
    }

    public static function save($object)
    {
        if (static::exists($object)) {
            return static::update($object);
        } else {
            unset($object->id);
            return static::insert($object);
        }
    }

    public static function update($object)
    {
        $pdo = static::connect();
        $result = $pdo->prepare('UPDATE ' . static::$tabela
            . ' SET descricao = :descricao, atualizado_em = NOW() WHERE cnae_id = :cnae_id');
        $result->bindValue(':descricao', $object->descricao);
        $result->bindValue(':cnae_id', $object->cnae_id);
        $result->execute();
        return static::findById($object)->id;
    }

    public static function exists($object)
    {
        return !empty(static::findById($object));
    }
}
