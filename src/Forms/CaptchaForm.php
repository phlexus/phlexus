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
    public function __construct(bool $initialize = true)
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
     * @param string $dataSiteKey Captcha Site Key 
     * 
     * @return void
     */
    private function assignCaptcha(string $dataSiteKey) {
        $captcha = new CaptchaElement(self::CAPTCHA_NAME, [
            'class' => 'g-recaptcha',
            'data-sitekey' => $dataSiteKey
        ]);

        $captcha->addValidator(new CaptchaValidator());

        $this->add($captcha);
    }
}
