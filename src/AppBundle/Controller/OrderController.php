<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity;
use AppBundle\Form;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * @Route("/order", name="order_page")
     */
    public function indexAction(Request $request)
    {
        $orderForm = $this->createForm(new Form\Type\Order(), new Entity\Pizza());
        if ($request->getMethod() == Request::METHOD_POST) {
            $orderForm->handleRequest($request);

            if ($orderForm->isValid()) {
                $order = $this->persistOrder($orderForm->getData());

                return $this->redirect(
                    $this->generateUrl('customer_order',
                        array(
                            'orderId' => $order->getOrderId()
                        )
                    )
                );
            }
        }

        return $this->render(
            'AppBundle:Order:order.html.twig',
            array(
                'form' => $orderForm->createView(),
            )
        );
    }

    /**
     * @param Entity\Pizza $order
     * @return Entity\Pizza
     */
    private function persistOrder(Entity\Pizza $order)
    {
        $order->setOrderId(com_create_guid());

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        return $order;
    }

    /**
     * @Route("/order/list/{cid}", name="order_list", defaults={"cid" = 0})
     */
    public function listAction($cid)
    {
         $repository = $this->getDoctrine()->getRepository('AppBundle:Pizza');

        if ($cid === 0 || !is_numeric($cid)) {
            $orders = $repository->findBy(array(), array('created' => 'DESC'));
        } else {
            $orders = $repository->findByCustomer($cid, array('created' => 'DESC'));
        }

        return $this->render(
            'AppBundle:Order:list.html.twig',
            array('orders' => $orders)
        );
    }
    

}
