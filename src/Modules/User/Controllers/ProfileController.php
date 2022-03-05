<?php
declare(strict_types=1);

namespace Phlexus\Modules\User\Controllers;

use Phlexus\Forms\CaptchaForm;
use Phlexus\Modules\BaseUser\Models\User;
use Phlexus\Modules\BaseUser\Form\ProfileForm;
use Phlexus\Modules\BaseUser\Controllers\AbstractController;
use Phlexus\Libraries\File\Handler as FileHandler;
use Phlexus\Libraries\File\Models\Media;
use Phlexus\Libraries\File\Models\MediaDestiny;

/**
 * Class Profile
 *
 * @package Phlexus\Modules\User\Controllers
 */
final class ProfileController extends AbstractController
{
    /**
     * Initialize
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->tag->setTitle('Profile');
    }

    /**
     * Edit page
     *
     * @return mixed ResponseInterface or void
     */
    public function editAction()
    {
        $profileForm = new ProfileForm();

        $user = User::getUser();

        if ($user === null) {
            return $this->response->redirect('/home');
        }

        $user->password = '';
        $user->repeat_password = '';

        $profileForm->setEntity($user);

        $this->view->setVar('defaultRoute', $this->request->getHttpReferer());
        $this->view->setVar('form', $profileForm);
    }


    /**
     * Edit page
     *
     * @return mixed ResponseInterface or void
     */
    public function saveAction()
    {
        $profileForm = new ProfileForm(false);

        $user = User::getUser();

        if ($user === null) {
            return $this->response->redirect('/home');
        }

        $post = $this->request->getPost();

        if (!$post) {
            return $this->response->redirect('/profile');
        }

        $authorized = [
            'password',
            'repeat_password',
            'profile_image',
            'csrf',
            CaptchaForm::CAPTCHA_NAME
        ];

        $authorizedKeys = array_flip($authorized);

        if (isset($post['password']) && empty($post['password'])) {
            $post['password'] = $user->password;
        }

        $profileForm->bind(array_intersect_key($post, $authorizedKeys), $user);

        if (!$profileForm->isValid()) {
            foreach ($profileForm->getMessages() as $message) {
                $this->flash->error($message->getMessage());
            }

            return $this->response->redirect('/profile');
        }

        // Remove csrf content, repeat_password and profile_image
        $user->csrf = null;
        $user->repeat_password = null;
        $user->profile_image = null;

        $media = $this->processUploadImage();
        if ($media === false) {
            $this->flash->error('Unable to save image!');

            return $this->response->redirect('/profile');
        } elseif ($media instanceof Media) {
            $user->imageID = $media->id;
        }

        if (!$user->save()) {
            $this->flash->error('Unable to save record!');

            return $this->response->redirect('/profile');
        }

        $this->flash->success('Record saved sucessfully!');

        return $this->response->redirect('/profile');
    }

    /**
     * Process Upload Image
     *
     * @return mixed null if no file, Media if success or false if fails
     */
    private function processUploadImage() {
        if ($this->request->hasFiles() !== true) {
            return null;
        }

        $files = $this->request->getUploadedFiles(true, true);
            
        if (isset($files['profile_image'])) {
            $handler = new FileHandler($files['profile_image']);
            
            if (!$handler->setFileDestiny(MediaDestiny::DESTINY_USER)->uploadFile()) {
                return false;
            }

            $media = Media::createMedia(
                $handler->getUploadName(),
                $handler->getFileType(),
                $handler->getFileDestiny()
            );

            if (!$media) {
                return false;
            }

            return $media;
        }
    }
}
