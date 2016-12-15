<?php
namespace Rendu\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre')
            ->add('Synopsis')
            ->add('date de sortie')
            ->add('Réalisateur')
            ->add('Genre')
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
        ;
    }
}