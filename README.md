# BileMo API

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/85d68edf55e94146abc94b81d7fd9caa)](https://app.codacy.com/gh/FrancisLibs/P7-API-Bilmo?utm_source=github.com&utm_medium=referral&utm_content=FrancisLibs/P7-API-Bilmo&utm_campaign=Badge_Grade)

<p><em>BileMo is the 7 project by Openclassrooms,for the "Application developer" course.<br>
Bilemo provide an API for resellers.<br>
	The API exposes phones and clients.</em></p>
<h2>Requirements*</h2>
<ol>
	<li>Symfony 5.1</li>
	<li>MySQL >= 8.0.18</li>
	<li>Composer</li>
</ol>

<h2>Installation</h2>
<ol>
	<li>Clone the master branch of : "https://github.com/FrancisLibs/P7-API-Bilmo.git"</li>
	<li>Install dependencies : composer install</li>
	<li>Edit the .env file to adapt it with your database access data</li>
	<li>Generate the SSH keys with JWT passphrase in .env and add JWT keys path :
		<ul>
			<li>mkdir -p config/jwt</li>
			<li>openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096<br></li>
			<li>openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout</li>
		</ul>
	</li>
	<li>Create database : bin/console doctrine: schema:create</li>
	<li>Load data fixtures bin/console doctrine: fixtures:load -n</li>
	<li>Run PHP's built-in Web Server : bin/console server:run</li>
	<li>Navigate to localhost:8000</li>
</ol>
