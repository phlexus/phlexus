<?php

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
    public function validate(Validation $validator, $attribute)
    {
        $value = $validator->getValue($attribute);

        if (!filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)) {
            $message = $this->getOption('message');

            $validator->appendMessage(
                new Message($message, $attribute, 'Captcha')
            );

            return false;
        }

        return true;
    }
}