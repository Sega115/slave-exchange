<?php

namespace App\Controller\Admin;

use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WorkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Work::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            AssociationField::new('parent'),
        ];
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        return;
    }
}
