<?php
/**
 * author: zh32
 */

namespace Craftlist\Bundle\CaptchaBundle\Type;

use Craftlist\Bundle\CaptchaBundle\Service\ReCaptchaService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaptchaType extends AbstractType {

    const PARAMETER_NAME = "g-recaptcha-response";
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var ReCaptchaService
     */
    private $captchaService;

    /**
     * CaptchaType constructor.
     * @param RequestStack $requestStack
     * @param ReCaptchaService $captchaService
     */
    public function __construct(RequestStack $requestStack, ReCaptchaService $captchaService) {
        $this->requestStack = $requestStack;
        $this->captchaService = $captchaService;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $validator = function (FormEvent $event) {
            $request = $this->requestStack->getCurrentRequest();
            $response = $request->request->get(self::PARAMETER_NAME);
            if (!empty($response)) {
                $remoteIp = $request->getClientIp();
                if ($this->captchaService->verify($response, $remoteIp)->isSuccess()) {
                    return;
                }
            }
            $event->getForm()->getRoot()->get("captcha")->addError(new FormError("captcha failed"));
        };
        $builder->addEventListener(FormEvents::POST_SUBMIT, $validator);
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options) {
        $view->vars["id"] = $this->captchaService->getId();
    }


    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefault("mapped", false);
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName() {
        return "captcha";
    }
}