<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('image')->setBasePath('uploads/')
                ->setUploadDir('public/Uploads')
                ->setUploadedFileNamePattern('[randomhash]. [extension]')
                ->setRequired(false),
            TextField::new('titre'),
            SlugField::new('slug')->setTargetFieldName('titre'),
            TextEditorField::new('description'),
            AssociationField::new('skills'),
            MoneyField::new('prix')->setCurrency('EUR'),
            ImageField::new('pdfFormation')->setBasePath('uploads/')
                ->setUploadDir('public/Uploads')
                ->setUploadedFileNamePattern('[titre]. [extension]')
                ->setRequired(false),

        ];
    }

}
