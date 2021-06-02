<?php

namespace Phlexus\Forms\Validators;

use Phalcon\Messages\Message;
use Phalcon\Validation;
use Phalcon\Validation\AbstractValidator;

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

        $response = $this->di->getShared('captcha')->verify($recaptchaResponse, $this->request->getClientAddress());

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