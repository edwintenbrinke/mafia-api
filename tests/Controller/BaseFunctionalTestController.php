<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BaseFunctionalTestController.
 *
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class BaseFunctionalTestController extends WebTestCase
{
    protected $token;

    protected $client;

    public function setUp()
    {
        // initiate both clients
        $this->client = self::getClient();

        //get authentication for token & cookie
        $token = $this->authenticateApp();
        $this->token = 'Bearer ' . $token['token'];

//        $this->authenticatePortal();
    }

    /**
     * @return \Symfony\Bundle\FrameworkBundle\KernelBrowser
     */
    private static function getClient()
    {
        return static::createClient(
            [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
            ]
        );
    }

    public function sendAuthorizedApiRequest(string $method, string $uri, array $parameters = [], array $files = [], array $server = [], string $content = null, bool $change_history = true)
    {
        $server['HTTP_AUTHORIZATION'] = $this->token;

        $this->sendApiRequest(
            $method,
            $uri,
            $parameters,
            $files,
            $server,
            $content,
            $change_history
        );
    }

    public function sendApiRequest(string $method, string $uri, array $parameters = [], array $files = [], array $server = [], string $content = null, bool $change_history = true)
    {
        $this->client->request(
            $method,
            $uri,
            $parameters,
            $files,
            $server,
            $content,
            $change_history
        );
    }

    public function authenticateApp()
    {
        $this->client->request(
            'POST',
            '/token/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['device' => 'test', 'password' => 'test'])
        );

        return json_decode($this->client->getResponse()->getContent(), true);
    }

    public function authenticatePortal()
    {
        $this->client->request(
            'POST',
            '/token/portal/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['username' => 'test', 'password' => 'test'])
        );
    }
}
