<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Helpers;
use PHPMailer\PHPMailer\PHPMailer;

class EmailProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'email';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $configs = Helpers::phlexusConfig('email')->toArray();
        $this->di->setShared($this->providerName, function () use ($configs) {
            $mail = new PHPMailer();
            
            //Server settings
            $mail->isSMTP();
            $mail->Host       = $configs['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $configs['username'];
            $mail->Password   = $configs['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            return $mail;
        });
    }
}
