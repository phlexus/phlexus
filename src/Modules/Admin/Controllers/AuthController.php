<?php declare(strict_types=1);

namespace Phlexus\Modules\Admin\Controllers;

use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Controller;

/**
 * Class AuthController
 *
 * @package Phlexus\Modules\Admin\Controllers
 */
class AuthController extends Controller
{
    /**
     * Login page
     *
     * @return void
     */
    public function loginAction(): void
    {
        $this->tag->setTitle('Phlexus CMS');
        $this->view->setMainView('auth/login');
    }

    /**
     * Login POST request handler
     *
     * @return ResponseInterface
     */
    public function doLoginAction(): ResponseInterface
    {
        $this->view->disable();

        if (!$this->request->isPost()) {
            return $this->response->redirect('admin/auth');
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $login = $this->auth->login([
            'email' => $email,
            'password' => $password,
        ]);
        if ($login === false) {
            return $this->response->redirect('admin/auth');
        }

        return $this->response->redirect('admin');
    }

    /**
     * Logout POST request handler
     *
     * @return ResponseInterface
     */
    public function logoutAction(): ResponseInterface
    {
        $this->view->disable();

        if ($this->auth->isLogged()) {
            $this->auth->logout();
        }

        return $this->response->redirect('admin/auth');
    }

    public function remindAction(): void
    {
        // TODO: implement
    }
}
