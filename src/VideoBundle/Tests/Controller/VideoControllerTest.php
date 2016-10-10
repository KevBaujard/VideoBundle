<?php

namespace VideoBundle\Tests\Controller;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class VideoControllerTest extends TestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/api/'
        ]);
    }

    public function testGetVideoAction()
    {
        $response = $this->client->get('videos');
        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody());
        $this->assertArrayHasKey('videos', get_object_vars($data));
        $this->assertArrayHasKey('count', get_object_vars($data));
    }

    public function testGetVideoByIdAction()
    {
        $response = $this->client->get('video/1');

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody());
        $this->assertArrayHasKey('video', get_object_vars($data));
    }
}
