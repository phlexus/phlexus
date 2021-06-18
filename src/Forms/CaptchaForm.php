<?php

namespace Phlexus\Forms;

use Phlexus\Helpers;
use Phlexus\Form\FormBase;
use Phlexus\Forms\Elements\CaptchaElement;
use Phlexus\Forms\Validators\CaptchaValidator;


/**
 * @property Security $security
 */
abstract class CaptchaForm extends FormBase
{

    // CAPTCHA name
    const CAPTCHA_NAME = 'g-recaptcha-response';

    /**
     * Constructor
     */
    public function __construct($initialize = true)
    {
        parent::__construct($initialize);

        $configs = Helpers::phlexusConfig('captcha')->toArray();

        $this->assignCaptcha($configs['options']['site-key']);
    }

    /**
     * Assign Captcha
     * 
     * @param string $data_site_key Captcha Site Key 
     * 
     * @return void
     */
    private function assignCaptcha($data_site_key) {
        $captcha = new CaptchaElement(self::CAPTCHA_NAME, [
            'class' => 'g-recaptcha',
            'data-sitekey' => $data_site_key
        ]);

        $captcha->addValidator(new CaptchaValidator());

        $this->add($captcha);
    }
}
