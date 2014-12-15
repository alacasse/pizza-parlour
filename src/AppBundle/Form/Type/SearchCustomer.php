<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchCustomer extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $orderId = 0;
        if (isset($options['data'])) {
            $orderId = $options['data']['orderId'];
        }

        $action = '';
        if (isset($options['action'])) {
            $action = $options['action'];
        }

        $builder
            ->setAction($action)
            ->add('orderId', 'hidden', array('data' => $orderId))
            ->add('customer', 'text', array('label' => 'Customer Phone Number'))
            ->add('save', 'submit', array('label' => 'Search'))
        ;
    }

    public function getName()
    {
        return 'search_customer';
    }
}