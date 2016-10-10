<?php

namespace VideoBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use VideoBundle\Entity\Video;

class VideoRepositoryTest extends KernelTestCase
{
    protected $em;

    public function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @dataProvider getVideoDataProvider
     */
    public function testGetVideo($params, $expectedCount, $expectedObj)
    {
        $videoServiceMock = $this->getMockBuilder('VideoBundle\Service\VideoService')
            ->setConstructorArgs([$this->em])
            ->setMethods(null)
            ->getMock();

        $videos = $videoServiceMock->getVideo($params);

        $this->assertCount($expectedCount, $videos);
        $this->assertEquals($expectedObj, $videos);
    }

    public function getVideoDataProvider()
    {
        $video = new Video();
        $video
            ->setId(1)
            ->setRealisator('David Simon')
            ->setTitle('The wire')
            ->setDate(new \DateTime('20150101'));

        return [
            [
                [
                    'realisator' => 'David'
                ],
                2,
                [
                    'videos' => [$video],
                    'count' => 1,
                ]
            ],
            [
                [
                    'realisator' => '',
                    'from' => '20160101',
                    'to' => '20161231',
                ],
                2,
                [
                    'videos' => [],
                    'count' => 0
                ]
            ]
        ];
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }
}
