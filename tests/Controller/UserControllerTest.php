<?php

namespace App\Tests\Controller;

/**
 * Class UserControllerTest.
 *
 * @covers \App\Controller\UserController
 *
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class UserControllerTest extends BaseFunctionalTestController
{
    /** @var \Doctrine\ORM\EntityManagerInterface */
    private $em;

    // setUp is initiated for each function in this class
    public function setUp()
    {
        parent::setUp();
        $this->em = $this->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    // initiate the user
    public function testUserProfile()
    {
        $this->sendAuthorizedApiRequest(
            'GET',
            '/user/profile'
        );

        $raw_response = $this->client->getResponse()->getContent();
        $response = json_decode($this->client->getResponse()->getContent(), true);
        dump($response); die;
        $this->assertNotNull($response, $raw_response);
        $this->assertTrue(isset($response['message']), $raw_response);
        $this->assertContains('Successfully', $response['message'], $raw_response);
        self::$uuid = $response['user_uuid'];
    }

    public function tearDown(): void
    {
        $this->em->close();
        $this->em = null;
    }
}
