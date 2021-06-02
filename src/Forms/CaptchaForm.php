<?php

namespace Phlexus\Modules\Generic\Forms;

use Phlexus\Form\FormBase;
use Phlexus\Forms\Validators\CaptchaValidator;


/**
 * @property Security $security
 */
abstract class CaptchaForm extends FormBase
{

    // CAPTCHA name
    const CAPTCHA_NAME = 'captcha';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->assignCaptcha();
    }

    /**
     * Assign Captcha
     * 
     * @return void
     */
    private function assignCaptcha() {
        $captcha = new Hidden(self::CAPTCHA_NAME);

        $captcha->addValidator(new CaptchaValidator());

        $this->add($captcha);
    }
}
