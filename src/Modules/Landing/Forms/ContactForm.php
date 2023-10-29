<?php

/**
 * This file is part of the Phlexus CMS.
 *
 * (c) Phlexus CMS <cms@phlexus.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phlexus\Modules\Landing\Forms;

use Phlexus\Forms\CaptchaForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Check;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\Email as EmailValidator;

class ContactForm extends CaptchaForm
{
    /**
     * Initialize form
     */
    public function initialize()
    {   
        $translationForm = $this->translation->setPage()->setTypeForm();   

        $name = new Text('name', [
            'class'       => 'form-control',
            'placeholder' => $translationForm->_('field-name'),
            ' required'   => 'true'
        ]);

        $email = new Email('email', [
            'class'       => 'form-control',
            'placeholder' => $translationForm->_('field-email-address'),
            ' required'   => 'true'
        ]);

        $message = new Text('message', [
            'class'       => 'form-control',
            'placeholder' => $translationForm->_('field-message'),
            ' required'   => 'true'
        ]);

        $acceptTerms = new Check('accept_terms', [
            'value'       => '1',
            'placeholder' => $translationForm->_('field-accept-terms'),
            ' required'   => 'true'
        ]);

        $translationMessage = $this->translation->setTypeMessage();   

        $name->addValidator(new PresenceOf(['message' => $translationMessage->_('field-name-required')]));

        $email->addValidators([
            new PresenceOf(['message' => $translationMessage->_('field-email-required')]),
            new EmailValidator(['message' => $translationMessage->_('field-email-is-invalid')])
        ]);

        $message->addValidator(new PresenceOf(['message' => $translationMessage->_('field-message-required')]));
             
        $acceptTerms->addValidator(
            new PresenceOf([
                'message' => $translationMessage->_('terms-not-accepted')
            ])
        );

        $this->add($name);
        $this->add($email);
        $this->add($message);
        $this->add($acceptTerms);
    }
}
