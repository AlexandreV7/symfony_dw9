<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController {
    public static function getEntityFqcn(): string {
        return User::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            EmailField::new('email')->setColumns(6),
            IntegerField::new('age')->setLabel('Âge')->setColumns(6),
            TextField::new('prenom')->setLabel('Prénom')->setColumns(6),
            TextField::new('nom')->setColumns(6),
            BooleanField::new('isVerified')->setLabel('Vérifié ?'),

            AssociationField::new('voitures'),
            AssociationField::new('plats'),
        ];
    }
}
