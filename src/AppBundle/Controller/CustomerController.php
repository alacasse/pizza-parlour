<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity;
use AppBundle\Form;
use Symfony\Component\HttpFoundation\Request;

class CustomerController extends Controller
{

    /**
     * @Route("/customer/list", name="customer_list")
     */
    public function indexAction()
    {
        $customers = $this->getDoctrine()
            ->getRepository('AppBundle:Customer')
             ->findBy(array(), array('created' => 'DESC'));

        return $this->render(
            'AppBundle:Customer:list.html.twig',
            array('customers' => $customers)
        );
    }
    
    /**
     * @Route("/customer/{id}", name="customer", defaults={"id" = 0})
     */
    public function newOrEditAction(Request $request, $id)
    {
        $customerForm = $this->createForm(new Form\Type\Customer(), $this->getCustomer($id));

        if ($request->getMethod() == Request::METHOD_POST) {
            $customerForm->handleRequest($request);

            if ($customerForm->isValid()) {
                $customer = $customerForm->getData();
                $this->persistCustomer($customer);

                return $this->redirect($this->generateUrl('customer_list'));
            }
        }

        return $this->render(
            'AppBundle:Customer:new.html.twig',
            array(
                'form' => $customerForm->createView(),
                'mode' => is_null($customerForm->getData()->getId()) ? 'create' : 'edit',
            )
        );
    }

    /**
     * @Route("/customer-order/{orderId}", name="customer_order")
     */
    public function customerOrderAction(Request $request, $orderId)
    {
        $customer = new Entity\Customer();
        $customerForm = $this->createForm(new Form\Type\Customer(), $customer);

        if ($request->getMethod() == Request::METHOD_POST) {
            $customerForm->handleRequest($request);

            if ($customerForm->isValid()) {
                $customer = $this->persistCustomer($customerForm->getData());

                $orders = $this->getDoctrine()->getRepository('AppBundle:Pizza')->findByOrderId($orderId);
                foreach ($orders as $order) {
                    $order->setCustomer($customer);
                    $this->persistOrder($order);
                }

                return $this->redirect($this->generateUrl('order_list'));
            }
        }

        $searchCustomerForm = $this->getSearchCustomerForm($orderId);

        return $this->render(
            'AppBundle:Customer:new.html.twig',
            array(
                'form' => $customerForm->createView(),
                'searchForm' => $searchCustomerForm->createView(),
                'mode' => 'create',
            )
        );
    }

    private function getSearchCustomerForm($orderId)
    {
        $searchCustomerForm = $this->createForm(
            new Form\Type\SearchCustomer(),
            null,
            array(
                'action' => $this->generateUrl('customer_search'),
                'data' => array('orderId' => $orderId)
            )
        );

        return $searchCustomerForm;
    }

    /**
     * @param Entity\Customer $customer
     * @return Entity\Customer
     */
    private function persistCustomer(Entity\Customer $customer)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($customer);
        $em->flush();

        return $customer;
    }

    /**
     * @Route("/customer-search", name="customer_search")
     *
     * @param Request $request
     */
    public function customerSearch(Request $request)
    {
        $searchCustomerForm = $this->createForm(
            new Form\Type\SearchCustomer()
        );

        $searchCustomerForm->handleRequest($request);
        $data = $searchCustomerForm->getData();
        $customers = $this->getDoctrine()->getRepository('AppBundle:Customer')->findByPhoneNumber($data['customer']);

        return $this->render(
            'AppBundle:Customer:search.html.twig',
            array(
                'customers' => $customers,
                'orderId' => $data['orderId'],
            )
        );
    }

    /**
     * @Route("/customer-found/{cid}/{orderId}", name="customer_found")
     *
     * @param $cid
     * @param $orderId
     */
    public function customerFound($cid, $orderId)
    {
        $customer = $this->getDoctrine()->getRepository('AppBundle:Customer')->findOneById($cid);
        $orders = $this->getDoctrine()->getRepository('AppBundle:Pizza')->findByOrderId($orderId);
        foreach ($orders as $order) {
            $order->setCustomer($customer);
            $this->persistOrder($order);
        }

        return $this->redirect($this->generateUrl('order_list'));
    }

    /**
     * @param Entity\Pizza $order
     * @return Entity\Pizza
     */
    private function persistOrder(Entity\Pizza $order)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        return $order;
    }

    /**
     * @param $id
     * @return Entity\Customer|object
     */
    private function getCustomer($id)
    {
        if ($id === 0 || !is_numeric($id)) {
            $customer = new Entity\Customer();
        } else {
            $customer = $this->getDoctrine()->getRepository('AppBundle:Customer')->find($id);
        }

        return $customer;
    }
}
