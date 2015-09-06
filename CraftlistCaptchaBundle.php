<?php

namespace Craftlist\Bundle\CaptchaBundle;

use Craftlist\Bundle\CaptchaBundle\DependencyInjection\CraftlistCaptchaExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CraftlistCaptchaBundle extends Bundle {
    /**
     * Returns the bundle's container extension.
     *
     * @return ExtensionInterface|null The container extension
     *
     * @throws \LogicException
     *
     * @api
     */
    public function getContainerExtension() {
        return new CraftlistCaptchaExtension();
    }

}
