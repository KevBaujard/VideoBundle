<?php

namespace VideoBundle\Tests\Entity;

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
     * @dataProvider findVideoBetweenDateDataProvider
     */
    public function testFindVideoBetweenDate($from, $to, $expectedCount, $expectedObj)
    {
        $videos = $this->em
            ->getRepository('VideoBundle:Video')
            ->findVideoBetweenDate($from, $to);

        $this->assertCount($expectedCount, $videos);
        $this->assertEquals($expectedObj, $videos);
    }

    public function findVideoBetweenDateDataProvider()
    {
        $video = new Video();
        $video
            ->setId(1)
            ->setRealisator('David Simon')
            ->setTitle('The wire')
            ->setDate(new \DateTime('20150101'));

        return [
            [
                new \DateTime('20150101'),
                new \DateTime('20151231'),
                1,
                [$video]
            ],
            [
                new \DateTime('20160101'),
                new \DateTime('20161231'),
                0,
                []
            ]
        ];
    }

    /**
     * @dataProvider findVideoByRealisatorDataProvider
     */
    public function testFindVideoByRealisator($realisator, $expected)
    {
        $videos = $this->em
            ->getRepository('VideoBundle:Video')
            ->findVideoByRealisator($realisator);

        $this->assertEquals($expected,$videos);
    }

    public function findVideoByRealisatorDataProvider()
    {
        $video = new Video();
        $video
            ->setId(1)
            ->setRealisator('David Simon')
            ->setTitle('The wire')
            ->setDate(new \DateTime('20150101'));

        return [
            [
                'David',
                [$video]
            ],
            [
                'Fred',
                []
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
