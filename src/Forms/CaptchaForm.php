<?php
declare(strict_types=1);

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
    /**
     * Captha Form Name
     */
    public const CAPTCHA_NAME = 'g-recaptcha-response';

    /**
     * Constructor
     */
    public function __construct($initialize = true)
    {
        parent::__construct($initialize);

        $configs = Helpers::phlexusConfig('security')->toArray();

        if (!isset($configs['captcha'])) {
            return;
        }

        $this->assignCaptcha($configs['captcha']['config']['site-key']);
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
