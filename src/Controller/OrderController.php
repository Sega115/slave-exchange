<?php


namespace App\Controller;


use App\AppService\OrderSumCalculatorInterface;
use App\Entity\Order;
use App\Entity\Slave;
use App\Form\OrderFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{

    /**
     * @Route("create-order/{slaveID}", name="create-order")
     * @ParamConverter("slave", options={"id" = "slaveID"})
     * @param Slave $slave
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param OrderSumCalculatorInterface $calculator
     * @return Response
     */
    public function createOrder(Slave $slave, Request $request, EntityManagerInterface $entityManager, OrderSumCalculatorInterface $calculator): Response
    {
        $order = new Order();
        $order->setSlave($slave);
        $form = $this->createForm(OrderFormType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $sum = $calculator->calculate($order);
            $order->setSum($sum);
            $entityManager->persist($order);
            $entityManager->flush();
            return $this->redirect('/info-order/'.$order->getId());
        }
        return $this->render('order/create.html.twig', [
            'order_form' => $form->createView(),
        ]);
    }


    /**
     * @Route("info-order/{orderID}", name="info-order")
     * @ParamConverter("order", options={"id" = "orderID"})
     * @param Order $order
     * @return Response
     */
    public function infoOrder(Order $order): Response
    {
        return $this->render('order/info.html.twig', [
            'order' => $order,
        ]);
    }
}