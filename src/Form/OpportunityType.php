<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\Opportunity;
use App\Entity\Pays;
use App\Entity\Client;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OpportunityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            
            ->add('Valeur_totale')
            ->add('valeur_nette')
            ->add('confiance')
            
            ->add('departement',EntityType::class,['class' => Departement::class,
            'choice_label' => 'nom',
            'label' => 'Departement'])
            ->add('client',EntityType::class,['class' => Client::class,
            'choice_label' => 'nom',
            'label' => 'Client'])
            ->add('pays',EntityType::class,['class' => Pays::class,
            'choice_label' => 'libelle',
            'label' => 'Pays'])
            ->add('accord');
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Opportunity::class,
        ]);
    }
}
