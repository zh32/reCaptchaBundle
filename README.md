reCaptchaBundle
=====================
This is a Symfony2 Bundle prodviding a captcha form type


Installation
============

```
    "zh32/recaptcha-bundle": "dev-master"
```


```php
<?php
// app/appKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Craftlist\CaptchaBundle\CraftlistCaptchaBundle(),
    );
}
```

Configuration
=============

Add the following configuration to your `app/config/config.yml`:

    recaptcha:
        id:         <your recaptcha id>
        secret:     <your recaptcha secret>
        whitelist:     [ "127.0.0.1"]

Usage
=====

```php
<?php
    // ...
    $builder->add('captcha', 'captcha');
    // ...
```
