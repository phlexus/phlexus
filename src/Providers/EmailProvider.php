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
    protected string $providerName = 'email';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     *
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $communications = Helpers::phlexusConfig('communications')->toArray();

        if (!isset($communications[$this->providerName])) {
            return;
        }

        $configs = $communications[$this->providerName];

        $this->di->setShared($this->providerName, function () use ($configs) {
            $mail = new PHPMailer();

            $config = $configs['config'];
            
            //Server settings
            $mail->isSMTP();
	        $mail->isHTML(true);
            $mail->Host       = $config['host'];
            $mail->Username   = $config['username'];
            $mail->Password   = $config['password'];
            $mail->Port       = $config['port'];

            if ($config['is_smtp']) {
                $mail->SMTPAuth   = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            }

            $mail->setFrom($config['username'], $config['name']);

            return $mail;
        });
    }
}
