# Reporting tool #
_Call a service and display all transactions converted to GBP currency_



## Installation ##
* Open a Terminal. Download the repo with `git clone https://github.com/lucianenache/task.git`
* `cd` into where you downloaded your repo and run `php composer.phar self-update`
* Now, run `php composer.phar install --dev`

Note: `php` refers to the location of your php executable, if its not on your system's path

## Run ##

* Once the composer installed all the dependencies,
* goto the script directory `cd /lib/Application/scripts`
* run the script like this `php report.php <uID>`  where uID is the userId, (1,2) for the mock

## Testing ##

* Open a Terminal
* `cd` to your project root
* Type `./vendor/bin/phpunit` and...magic! Tests (should) now be running!


