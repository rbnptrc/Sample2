<?php

namespace App\Controller;

use App\Entity\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route(path="/checkout/{coupon}", name="checkout",methods={"GET"},defaults={"coupon":""})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function checkout(Request $request)
    {
        try {
            $cart = new Cart();
            $session = $request->getSession();
            $mushrooms = $session->get('cart');

            return $this->render('cart/checkout.html.twig', [
                'mushrooms' => $mushrooms,
                'sub_total' => number_format($cart->getItemSubTotal($mushrooms), 2),

                'total' => number_format($cart->getItemTotal($mushrooms), 2),
            ]);
        } catch (\Exception $exception) {
            return $this->render('error.html.twig', [
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @Route(path="/gettotal/", name="gettotal",methods={"GET"},defaults={"coupon":""})
     */
    public function sendTotal(Request $request)
    {
        $cart = new Cart();
        $session = $request->getSession();
        $mushrooms = $session->get('cart');

        $total = number_format($cart->getItemTotal($mushrooms), 2);

        return $this->json($total);
    }

    /**
     * @Route(path="/remove-cart", name="remove-cart",methods={"GET"})
     */
    public function clearCart()
    {
        try {
            $session = new Session();
            $session->remove('cart');

            return $this->redirect('/');
        } catch (\Exception $exception) {
            return $this->render('error.html.twig', [
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @Route(path="/remove-item/{id}", name="remove-item",methods={"GET"})
     *
     * @param mixed $id
     */
    public function removeItem($id, Request $request)
    {
        $session = $request->getSession();
        $items = $session->get('cart');

        foreach ($items as $key => $item) {
            if ($item['id'] == $id) {
                unset($items[$key]);
            }
        }

        $session->set('cart', $items);

        try {
            $cart = new Cart();
            $session = $request->getSession();
            $items = $session->get('cart');

            foreach ($items as $key => $item) {
                if ($item['id'] == $id) {
                    unset($items[$key]);
                }
            }

            $session->set('cart', $items);

            $this->addFlash(
                'notice',
                'Item Removed from the Cart'
            );

            return $this->render('cart/checkout.html.twig', [
                'mushrooms' => $items,
                'sub_total' => number_format($cart->getItemSubTotal($items), 2),

                'total' => number_format($cart->getItemTotal($items), 2),
            ]);
        } catch (\Exception $exception) {
            return $this->render('error.html.twig', [
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
