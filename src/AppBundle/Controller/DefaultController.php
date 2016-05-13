<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'session_id' => $request->getSession()->getId(),
            'api_key' => $this->container->getParameter('fraudguard_apikey')
        ));
    }

    /**
     * @Route("/ok", name="ok")
     */
    public function okAction(Request $request)
    {
        $order = new \StdClass();

        $order->amount = 200;
        $order->id = 25;
        $order->user_id = 12;
        $order->email = 'user@example.com';
        $order->createdAt = new \DateTime();
        $order->shipping_method = 'standard';
        $order->currency = 'DKK';

        $order->firstname = 'Theodor';
        $order->lastname = 'Jacobsen';
        $order->address = 'Vesterbro 11';
        $order->zip = '8000';
        $order->city = 'Aarhus';
        $order->country = 'DK';

        $order->shipping = new \StdClass();
        $order->shipping->firstname = 'Theodor';
        $order->shipping->lastname = 'Jacobsen';
        $order->shipping->address = 'Vesterbro 11';
        $order->shipping->zip = '8000';
        $order->shipping->city = 'Aarhus';
        $order->shipping->country = 'DK';

        $order->items = array();

        $item = new \StdClass();
        $item->category = 'Tech';
        $item->product_id = 123;
        $item->unit_price = 12;
        $item->quantity = 1;
        $order->items[] = $item;

        $item = new \StdClass();
        $item->category = 'Bath';
        $item->product_id = '111';
        $item->unit_price = 33;
        $item->quantity = 3;
        $order->items[] = $item;

        return $this->render('default/ok.html.twig', array(
            'session_id' => $request->getSession()->getId(),
            'api_key' => $this->container->getParameter('fraudguard_apikey'),
            'ip' => $request->getClientIp(),
            'user_agent' => $request->server->get('HTTP_USER_AGENT'),
            'accept_language' => $request->server->get('HTTP_ACCEPT_LANGUAGE'),
            'shop_name' => 'FraudGuard Demo Shop',
            'order' => $order
        ));
    }

    /**
     * @Route("/callback", name="callback")
     */
    public function callbackAction(Request $request)
    {
        $res = new \StdClass();
        $res->score = $request->get('score');
        $res->transaction_id = $request->get('transaction_id');
        $res->status = 'ok';

        switch ($request->get('task')) {
        case 'accepted':
            // accept the order
            break;

        case 'hold':
            // put order on hold
            break;

        case 'rejected':
            // order should be rejected
            break;
        }

        return new JsonResponse($res);
    }
}
