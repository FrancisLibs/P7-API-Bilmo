# BileMo API
<p>BileMo is the 7 project by Openclassrooms,for the "Application developer" course. 
Bilemo provide an API for resellers. 
The API exposes phones and clients.
</p>
## Requirements
````
1. Symfony 5.1
2. MySQL >= 8.0.18
3. Composer
````
## Installation
1. Clone the master branch of :
```bash
    <https://github.com/FrancisLibs/P7-API-Bilmo.git>
```
2. Install dependencies : 
```bash
	composer install
```
3. Edit the .env file to adapt it with your database access data
4. Generate the SSH keys with JWT passphrase in .env and add JWT keys path :
```bash
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```
5. Create database : 
```bash
	bin/console doctrine:schema:create
```
6. Load data fixtures bin/console doctrine:
```bash
	fixtures:load -n
```
7. Run PHP's built-in Web Server : 
```bash
	bin/console server:run
```
8. Navigate to localhost:8000
