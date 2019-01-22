<?php

namespace App\Transformer;

use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;

abstract class JsonToObjectTransformer
{
    protected $em;

    public function __construct(EntityManagerInterface $em = null)
    {
        $this->em = $em;
    }

    /**
     * @param object &$object
     * @param array $relationships
     * @return void
     */
    abstract protected function applyRelationships(object &$object, array $relationships);

    /**
     * @param object &$object
     * @param array $attributes
     * @return void
     */
    abstract protected function applyAttributes(object &$object, array $attributes);

    /**
     * @param object &$object
     * @param int $id
     * @return void
     */
    abstract protected function applyId(object &$object, int $id);

    /**
     * @param object &$object
     * @param array $data
     * @return void
     */
    abstract protected function transform(object &$object, array $data);

    /**
     * @param string $content
     * @return void
     */
    abstract public function transformSingle(string $content);

    /**
     * @param string $content
     * @return object
     */
    abstract public function transformMany(string $content);

    /**
     * @param array $json
     * @return array
     */
    protected function getData(array $json)
    {
        $data = [];

        if(key_exists('data', $json))
        {
            $data = $json['data'];
        }

        return $data;
    }

    /**
     * @param array $data
     * @return int
     */
    protected function getId(array $data)
    {
        $id = 0;

        if(key_exists('id', $data))
        {
            $id = $data['id'];
        }

        return $id;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getIds(array $data)
    {
        $ids = [];

        foreach ($data as $datum)
        {
            if(key_exists('id', $datum))
            {
                $ids[] = $datum['id'];
            }
        }

        return $ids;
    }

    /**
     * @param array $data
     * @return string
     */
    protected function getType(array $data)
    {
        $type = '';

        if(key_exists('type', $data))
        {
            $type .= $data['type'];
        }

        return $type;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getAttributes(array $data)
    {
        $attributes = [];

        if(key_exists('attributes', $data))
        {
            $attributes = $data['attributes'];
        }

        return $attributes;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getRelationships(array $data)
    {
        $relationships = [];

        if(key_exists('relationships', $data))
        {
            $relationships = $data['relationships'];
        }

        return $relationships;
    }
}