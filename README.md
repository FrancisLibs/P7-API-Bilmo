## BileMo API

**BileMo is the 7 project by Openclassrooms,for the "Application developer" course. 
Bilemo provide an API for resellers. 
The API exposes phones and clients.**

**Requirements**
•	Symfony 5.1
•	MySQL >= 8.0.18
•	Composer

**Installation** 
- Clone the master branch of :
	-  `<https://github.com/FrancisLibs/P7-API-Bilmo.git>`
- Install dependencies : 
	- composer install
- Edit the .env file to adapt it with your database access data
- Generate the SSH keys with JWT passphrase in .env and add JWT keys path :
  1.	mkdir -p config/jwt
  2.  openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
  3.  	openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
- Create database : 
	- bin/console doctrine:schema:create
- Load data fixtures bin/console doctrine:
	- fixtures:load -n
- Run PHP's built-in Web Server bin/console server:run
- Navigate to localhost:8000
