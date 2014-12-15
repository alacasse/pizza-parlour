<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Order extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('toppingOne', "checkbox",
                array(
                    "required" => false,
                    "label" => "Topping one",
                )
            )
            ->add('toppingTwo', "checkbox",
                array(
                    "required" => false,
                    "label" => "Topping two",
                )
            )
            ->add('toppingThree', "checkbox",
                array(
                    "required" => false,
                    "label" => "Topping three",
                )
            )
            ->add('save', 'submit', array('label' => 'Save'))
        ;
    }

    public function getName()
    {
        return 'order';
    }
}