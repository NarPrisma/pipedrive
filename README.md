## Installation

To install Crmbooster-Pipedrive package, you'll want to run this command:

```
composer require crmbooster/pipedrive
```

publish from vendor views and config

```
php artisan vendor:publish --provider="Pipedrive\Providers\PipedriveServiceProvider"
```

##### **you can find views and config in your app**

**for views** : _resources/views/vendor/pipedrive
<br>_
**for config**: _config/pipedrive.php_

Then, open up the `.env` and update the *APP_URL* to the URL of your application.
<br>
<ul>In Pipedrive Marketplace Manager you can find for you app
    <li> Client ID .</li>
    <li> Client Secret. </li>
    <li> PIPEDRIVE_ENDPOINT comprises you company domain and /api/v1. </li>
</ul>
<p align="center">
    <img class="center" src="https://i.imgur.com/Qp4bcRA.png" height=400px"/>
</p>

```bash
APP_URL = https://crmbooster.io

PIPEDRIVE_ID =
PIPEDRIVE_SECRET =
PIPEDRIVE_ENDPOINT = https://stoerkensgmbh-sandbox.pipedrive.com/api/v1

PIPEDRIVE_CUSTOM_UI_ENDPOINT = https://stoerkensgmbh-sandbox.pipedrive.com/api/v1

````

### 4. Run Migrations

We must migrate our database schema into our database, which we can accomplish by running the following command:
```php
php artisan migrate
```
<br>


🎉 And that's it! You will now be able to visit your URL and see your Pipedrive application up and running.






