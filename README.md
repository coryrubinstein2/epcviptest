# epcviptest
EPCVIP Symfony Test

Steps to run:

1. Run composer install
	- For simplicity I've included the .pem files in github for jwt authentication
	- The passphrase is root

2. Run migrations

3. Generate some dummy data running the command:
	- <i>php app/console doctrine:fixtures:load</i>
	
4. Run pending products command:
	- <i>php bin/console epcvip:find:pending:products</i>
	- This command can be added to a cron job to run daily or weekly

5. Run the CRUD API's using Postman or another API development tool
