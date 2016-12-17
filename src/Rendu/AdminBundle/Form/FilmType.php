<?php
namespace Rendu\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre')
            ->add('Synopsis')
            ->add('date_de_sortie', DateType::class, array(
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day'
                )))
            ->add('Realisateur', EntityType::class, array(
                'class' => 'RenduCinemaBundle:Personne',
                'choice_value' => 'id',
            ))
            ->add('Genre', EntityType::class, array(
                'class' => 'RenduCinemaBundle:Genre',
                'choice_value' => 'id',
            ))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
        ;
    }
}