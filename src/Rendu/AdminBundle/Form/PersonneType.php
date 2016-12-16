<?php
namespace Rendu\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Date_de_Naissance')
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
        ;
    }
}