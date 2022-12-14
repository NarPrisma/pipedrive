## Installation

To install Crmbooster-Pipedrive package, you'll need to run this command:

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
<ul>In Pipedrive Marketplace Manager in your app you can find
    <li> Client ID .</li>
    <li> Client Secret. </li>
    <li> PIPEDRIVE_ENDPOINT comprises you company domain and /api/v1. </li>
</ul>

```bash
APP_URL = https://crmbooster.io

PIPEDRIVE_ID =
PIPEDRIVE_SECRET =
PIPEDRIVE_ENDPOINT =

PIPEDRIVE_CUSTOM_UI_ENDPOINT =

````
<p align="center">
    <img class="center" src="https://i.imgur.com/Qp4bcRA.png" height=400px"/>
</p>

For use **Custom UI** extensions in pipedrive you need to set  PIPEDRIVE_CUSTOM_UI_ENDPOINT
<br>
_It can be the same if you use the same company domain_. 

#### Config custom UI 

<p align="center">
    <img class="center" src="https://imgur.com/0VfOS0A.png" height=400px"/>
</p>

####  Set current Iframe URL.

<br>
Go to your app’s edit page in Marketplace Manager and scroll to App extensions > Custom UI extensions > Custom panel. Click on “+ Custom panel” and fill in the following fields:
<br>

Go to your app’s edit page in Marketplace Manager and scroll to App extensions > Custom UI extensions > Custom panel. Click on “+ Custom panel” and fill in the following fields:

<p align="center">
    <img class="center" src="https://i.imgur.com/t3yrbwM.png" height=400px"/>
</p>
Iframe URL must end in pipedrive/modal

`https://you company domain-sandbox.pipedrive.com/api/v1`

_like picture below_

<p align="center">
    <img class="center" src="https://i.imgur.com/hogIXfA.png" height=400px"/>
</p>

#### Run Migrations

We must migrate our database schema into our database, which we can accomplish by running the following command:
```php
php artisan migrate
```
<br>


🎉 And that's it! You will now be able to visit your URL and see your Pipedrive application up and running.






