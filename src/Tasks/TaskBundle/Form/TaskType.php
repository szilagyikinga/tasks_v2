<?php

namespace Tasks\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateLimit', null)
            ->add('dateStart', 'date')
            ->add('dateEnd', 'date')
            ->add('title', 'text')
            ->add('content', 'textarea')//->add('inCharge', 'entity', array(
            //        'class'     =>'UserBundle:User',
            //        'property'  =>'username',
            //        'multiple'  =>false))
            //->add('status', 'entity', array(
            //        'class'     =>'TaskBundle:Status',
            //        'property'  =>'name',
            //        'multiple'  =>false))

        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tasks\TaskBundle\Entity\Task'
        ));
    }

    public function getName()
    {
        return 'tasks_taskbundle_tasktype';
    }
}
