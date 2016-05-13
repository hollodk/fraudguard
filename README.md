FraudGuard Example
==================

- Start by creating an account at https://tools.snorestopper.eu/fraudguard/web
- Add an API key in FraudGuard
- Clone this repository git clone https://github.com/hollodk/fraudguard.git
- Add key in app/config/parameters.yml
- Make var/ writeable to everyone
- Now continue to the [Tests] section to see how things are working

Tests
-----

When you want to generate page views, use this url http://localhost/fraudguard/web/.

When you want to generate a new order, use this url http://localhost/fraudguard/web/ok.

In the callback code you can access data like this http://localhost/fraudguard/web/callback.


FraudGuard Interface
--------------------

Now check the FraudGuard interface too see your results, check out the Develop -> Api Log to see all the requests.

To test the callback, try and add a new action and just and the url for your callback, and click [Test], now you can see the response in the web interface response panel.


About This Module
-----------------

All the custom php code for this example project is located in src/AppBundle/Controller/DefaultController.php.

All the custom javascript and html is located in app/Resources/view/default/.

That is basically everything you need to know to get started, here you can see how to use this module for your own project.


Explanation of response
-----------------------

In the callback you will get one of three responses:

- accepted, means the order seems good.
- hold, means we advise you to check up on this order, there seems to be some fishy in the order.
- rejected, means it seems like a frauded order.
