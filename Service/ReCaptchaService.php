<?php
/**
 * author: zh32
 */

namespace Craftlist\Bundle\CaptchaBundle\Service;


use ReCaptcha\ReCaptcha;
use ReCaptcha\RequestMethod;

class ReCaptchaService extends ReCaptcha {

    private $id;
    /**
     * Create a configured instance to use the reCAPTCHA service.
     *
     * @param string $secret shared secret between site and reCAPTCHA server.
     * @param RequestMethod $requestMethod method used to send the request. Defaults to POST.
     */
    public function __construct($secret, $id, RequestMethod $requestMethod = null)
    {
        parent::__construct($secret, $requestMethod);
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
}