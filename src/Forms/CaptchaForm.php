<?php

namespace Phlexus\Modules\Generic\Forms;

use Phlexus\Form\FormBase;

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
    public function __construct($gerenateCsrf = true)
    {
        parent::__construct();
        
        $this->assignCaptcha();
    }

    /**
     * Assign Csrf
     * 
     * @return void
     */
    private function assignCsrf($gerenateCsrf) {
        $csrf = new Hidden(self::CAPTCHA_NAME);

        if($gerenateCsrf) {
            $csrf->setDefault($this->security->getToken());
        }

        $csrf->addValidator(new Identical(array(
            'value' => $this->security->getSessionToken(),
            'message' => 'Invalid Form'
        )));

        $this->add($csrf);
    }
}
