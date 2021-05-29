<?php


namespace App\AppService;
use Doctrine\ORM\EntityManagerInterface;
use IteratorAggregate;

class TreeMenuBuilder implements TreeMenuInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function build(): array
    {
        $works = $this->getWorks();
        return $this->buildTree($works);
    }


    private function getWorks(): array
    {
        $stmt = $this->entityManager->getConnection()->executeQuery('
            SELECT id , parent_id, title , CONCAT("") as children FROM `work`');
        return $stmt->fetchAllAssociative();
    }

    private function buildTree(array &$elements, $parentId = 0)
    {
        $result = array();
        foreach ($elements as &$element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $result[$element['id']] = $element;
                unset($element);
            }
        }
        return $result;
    }
}