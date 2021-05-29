<?php

namespace App\Controller\Admin;

use App\Entity\Slave;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SlaveCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slave::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            ChoiceField::new('gender')->setChoices(['man' => 'man', 'woman' => 'woman']),
            IntegerField::new('age'),
            IntegerField::new('weight'),
            TextField::new('color_skin'),
            TextField::new('location'),
            TextareaField::new('description'),
            NumberField::new('wage_rate'),
            NumberField::new('price'),
            AssociationField::new('works'),
        ];
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        return;
    }
}
