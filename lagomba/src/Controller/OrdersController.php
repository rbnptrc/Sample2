<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    /**
     * @Route("/orders", name="add_orders")
     */
    public function index(Request $request)
    {
        try {
            $session = $request->getSession();
            $user_id = $this->get('security.token_storage')->getToken()->getUser();

            $user_id = $user_id->getId();

            $user = new User();
            $user = $this->getDoctrine()->getRepository(User::class);

            $user = $user->find($user_id);

            $order = new Order();

            $cart = new Cart();

            $mushrooms = $session->get('cart');
            $total = number_format($cart->getItemTotal($mushrooms), 2);

            $order->setName($user->getName());
            $order->setItems($session->get('cart'));
            $order->setAddress($user->getAddress());
            $order->setCity($user->getCity());
            $order->setUserId($user->getId());
            $order->setZip($user->getZip());
            $order->setTotal($total);
            $order->setOrderTime(new \DateTime());

            $entityManage = $this->getDoctrine()->getManager();
            $entityManage->persist($order);
            $entityManage->flush();

            return $this->json(true);
        } catch (\Exception $exception) {
            return $this->render('error.html.twig', [
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @Route("/admin/orders", name="orders")
     */
    public function showOrders()
    {
        try {
            $orders = new Order();
            $orders = $this->getDoctrine()->getRepository(Order::class);

            $orders = $orders->findAll();

            return $this->render('orders/index.html.twig', [
                'orders' => $orders,
            ]);
        } catch (\Exception $exception) {
            return $this->render('error.html.twig', [
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @Route("/admin/remove-order/{id}", name="remove-order")
     *
     * @param mixed $id
     */
    public function removeOrder($id)
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository(Order::class)->find($id);

        if (!$order) {
            throw $this->createNotFoundException(
                'No record for the order with the id: '.$id
            );
        }

        $this->addFlash(
            'notice',
            'Order Deleted Successfully'
        );

        $em->remove($order);
        $em->flush();

        return $this->redirectToRoute('orders');
    }
}
