<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Customer extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', "text",
                array(
                    "label" => "First Name",
                )
            )
            ->add('lastName', "text",
                array(
                    "label" => "Last Name",
                )
            )
            ->add('address', "text",
                array(
                    "label" => "Address",
                )
            )
            ->add('phoneNumber', "text",
                array(
                    "label" => "Phone Number",
                )
            )
            ->add('save', 'submit', array('label' => 'Save'))
        ;
    }

    public function getName()
    {
        return 'customer';
    }
}