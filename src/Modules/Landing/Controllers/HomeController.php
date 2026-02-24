<?php
declare(strict_types=1);

namespace Phlexus\Modules\Landing\Controllers;

use Phlexus\Modules\Landing\Forms\ContactForm;
use Phlexus\PhlexusHelpers\Emails;
use Phlexus\Helpers as PhlexusHelpers;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Controller;
use Phalcon\Tag;

/**
 * Class Home
 *
 * @package Phlexus\Modules\Landing\Controllers
 */
final class HomeController extends Controller
{
    /**
     * Index Action
     *
     * @return void
     */
    public function indexAction(): void
    {
        $title = $this->translation->setTypePage()->_('title-home');

        Tag::setTitle($title);

        $this->view->form = new ContactForm();
    }

    /**
     * Contact request handler
     *
     * @return ResponseInterface
     */
    public function doContactAction(): ResponseInterface
    {
        $this->view->disable();

        $translationMessage = $this->translation->setTypeMessage();

        if (!$this->request->isPost()) {
            $this->flash->error($translationMessage->_('invalid-data-sent'));

            return $this->response->redirect('/');
        }

        $form = new ContactForm(false);

        $post = $this->request->getPost();

        if (!$form->isValid($post)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message->getMessage());
            }

            return $this->response->redirect('/');
        }

        if (
            !$this->sendContactEmail(
                $post['name'],
                $post['email'],
                $post['message']
            )
        ) {
            $this->flash->error($translationMessage->_('email-not-sent'));

            return $this->response->redirect('/');
        }

        $this->flash->success($translationMessage->_('email-sent-successfully'));

        return $this->response->redirect('/');
    }

    /**
     * Send Contact Email
     * 
     * @param string $name    Name
     * @param string $email   Email
     * @param string $message Message
     *
     * @return bool
     */
    private function sendContactEmail(string $name, string $email, string $message): bool
    {
        try {
            $body = Emails::renderEmail($this->view, 'landing', 'contact_us', [
                    'name'    => $name,
                    'email'   => $email,
                    'message' => $message,
                ]
            );
        } catch(\Exception $e) {
            return false;
        }

        $company = PhlexusHelpers::phlexusConfig('company')->toArray();
        $serverEmail = $company['email'] ?? null;

        if (empty($serverEmail)) {
            return false;
        }
        
        return Emails::sendEmail($serverEmail, 'Contact Received', $body);
    }
}