<?php

namespace VideoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use VideoBundle\Entity\Video;

class CreateVideoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('video:create')
            ->setDescription('Add a new video')
            ->setHelp("This command will persist a new video in the database")
            ->addArgument('title', InputArgument::REQUIRED, 'Title of the video')
            ->addArgument('realisator', InputArgument::REQUIRED, 'Realisator of the video')
            ->addArgument('date', InputArgument::REQUIRED, 'Date of the video');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!is_numeric($input->getArgument('date'))) {
            throw new InvalidArgumentException('The date arguments must be numerical');
        }

        $video = new Video();
        $video->setRealisator($input->getArgument('realisator'))
            ->setTitle($input->getArgument('title'))
            ->setDate(new \DateTime($input->getArgument('date')));

        $gameService = $this->getContainer()->get('video_service');
        $gameService->save($video);
    }
}
