<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class VoitureCrudController extends AbstractCrudController {
    public static function getEntityFqcn(): string {
        return Voiture::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            TextField::new('marque')
                ->setColumns(6),
            TextField::new('modele')
                ->setColumns(6),

            ImageField::new('image')
                ->setUploadDir('public/uploads/voitures')
                ->setBasePath('uploads/voitures')
                ->setColumns(6),

            AssociationField::new('utilisateur')
                ->setColumns(6),

            IntegerField::new('km')->setColumns(12)

        ];
    }
}
