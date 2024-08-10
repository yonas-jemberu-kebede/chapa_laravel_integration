# chapa_laravel_integration
In today’s digital age, providing a seamless payment experience is crucial for any online business. Whether you are running an e-commerce store, a subscription-based service, or any other online venture that requires payment processing, integrating a reliable payment gateway is essential. Chapa, an emerging payment gateway, offers a robust and secure solution for processing payments in Ethiopia. Integrating Chapa with Laravel, one of the most popular PHP frameworks, can significantly enhance your application's payment processing capabilities. This article will guide you through integrating Chapa into your Laravel application, ensuring a smooth and efficient payment experience for your users.
Prerequisites
Before you begin, make sure you have the following:
A Laravel application set up on your local development environment.
A Chapa account. You can sign up on Chapa’s website if you don't have one. 
Chapa API credentials (public key and secret key).

 What are public and secret keys in Chapa?
The public key is typically used on the client side to initiate payment requests securely. Since it's safe to expose, the public key can be embedded in your front-end code without risking security.
The secret key is used for secure, server-side communications with the Chapa API. It should never be exposed or embedded in client-side code.
Step-by-Step Guide to Integrate Chapa in Laravel
Step 1: Install Laravel
composer require laravel/laravel:^10.0 chapa_payment_integration_check

//laravel:^10.0 ==>indicates that I am using Laravel version 10, cause if we didn't specify the actual version we need, the composer will install the latest version of Laravel by default which is 11.9 currently

Navigate to your project directory:
 cd chapa_payment_integration_check
Step 2: Install the package

composer require chapa/chapa-laravel

step 3:publish the vendor file

php artisan vendor:publish --provider="Chapa\Chapa\ChapaServiceProvider"


step 4:Open your .env file and add your public key, and secret key

CHAPA_SECRET_KEY = YOUR_API_KEY
CHAPA_PUBLIC_KEY = YOUR_API_KEY

CHAPA_WEBHOOK_SECRET = YOUR_API_KEY

We get these keys from our chapa account, so we need to create a chapa account before getting started.

The webhook secret key is optional in my case because, with my current understanding webhook URLs are an endpoint in our server that is used for receiving notifications when changes are made in external services(i.e in our case if the payment process in Chapa server is completed/failed then our server(the server our web app is running) gets the notification("completed/failed") through webhook URL, so if we decide to use webhook url then:-
 First, we have to expose our server to the internet(the largest wide area network), because currently, our web server is running on LAN(local area network), so to access it remotely and to send a notification, the server has to be reached from everywhere so placing it in the internet is the best solution.
So to expose it, we can download ngrok and install it on our local machine/PC.
 ngrok will act as a bridge between our local server and Chapa
 After installing ngrok,it will open a kind of cmd so by writing the following code we can make our local server accessible from everywhere.
 this is the code "ngrok http 8000", and 8000 stands for the port number which our server is running
after doing that, we get a unique forwarding code, like this:-
  Forwarding  https://032e-196-191-61-36.ngrok-free.app -> http://localhost:8000 
then by taking only " https://032e-196-191-61-36.ngrok-free.app" we can add this in both webhook url sections of chapa and the .env file of our web application...after doing this we can get notifications clearly
Step 5: The next steps are defining routes and controllers, so easy! you can check my GitHub Account 

https://github.com/yonas-jemberu-kebede/chapa_laravel_integration

Step 6:the issues I encountered, when I tried it for the first time

Email,first_name, and last_name should be exactly similar within our Chapa account (i.e they are case sensitive especially when it comes to first and last name)

 public function initialize()
{
 //This generates a payment reference
 $reference = $this->reference;
 

 // Enter the details of the payment
 $data = [
 
 'amount' => 100,
 'email' => 'jemberuyonas045@gmail.com',
 'tx_ref' => $reference,
 'currency' => "ETB",
 'callback_url' => route('callback',[$reference]),
 'first_name' => "yonas",
  'last_name' => "jemberu",
 "customization" => [
 "title" => 'Chapa Test',
 "description" => "I amma testing this"
]
];

Step 7: if everything is ok, we will get a URL to  continue processing our payment process with options of mobile number or card    
step 8:- give it a star if you liked it 😁😁
