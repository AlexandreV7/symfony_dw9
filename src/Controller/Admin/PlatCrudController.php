<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class PlatCrudController extends AbstractCrudController {
    public static function getEntityFqcn(): string {
        return Plat::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            TextField::new('nom')->setColumns(12),

            ImageField::new('image')
                ->setUploadDir('public/uploads/plats')
                ->setBasePath('uploads/plats')
                ->setColumns(6),

            AssociationField::new('utilisateur')
                ->setColumns(6)
        ];
    }
}
