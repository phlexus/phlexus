<?php
declare(strict_types=1);

namespace Phlexus\Forms\Validators;

use Phalcon\Di\Di;
use Phalcon\Messages\Message;
use Phalcon\Filter\Validation;
use Phalcon\Filter\Validation\AbstractValidator;
use Phalcon\Http\Request;

class CaptchaValidator extends AbstractValidator
{
    /**
     * Executes the validation
     *
     * @param Validation $validator
     * @param string     $attribute
     *
     * @return boolean
     */
    public function validate(Validation $validator, $attribute): bool
    {
        $recaptchaResponse = $validator->getValue($attribute);

        $response = Di::getDefault()
            ->getShared('captcha')
            ->verify($recaptchaResponse, (new Request())->getClientAddress());

        if (!$response->isSuccess()) {
            $message = $this->getOption('message');

            if (!$message) {
                $message = 'The Captcha is not valid';
            }

            $validator->appendMessage(
                new Message($message, $attribute, 'Captcha')
            );

            return false;
        }

        return true;
    }
}