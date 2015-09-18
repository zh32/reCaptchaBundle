<?php
/**
 * author: zh32
 */

namespace Craftlist\Bundle\CaptchaBundle\Service;


class Whitelist {

    /**
     * @var array
     */
    private $whitelist;

    /**
     * Whitelist constructor.
     * @param array $whitelist
     */
    public function __construct(array $whitelist) {
        $this->whitelist = $whitelist;
    }

    /**
     * @param $host
     * @return bool
     */
    public function isWhitelisted($host) {
        return in_array($host, $this->whitelist);
    }
}