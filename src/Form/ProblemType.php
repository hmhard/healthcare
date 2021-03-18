<?php

namespace App\Form;

use App\Entity\Problem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProblemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siteHistory')
            ->add('regionalProblem')
            ->add('frequency',null,[
			"label"=>"Frequency(How Many times does this happened?)",
			"attr"=>[
			
			"min"=>0
			]
			])
            ->add('solutionsTaken')
            ->add('isFixed')
            ->add('department')
			  ->add('currentProblem')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Problem::class,
        ]);
    }
}
