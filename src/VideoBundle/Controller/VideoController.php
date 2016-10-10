<?php

namespace VideoBundle\Controller;

use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class VideoController extends Controller
{
    /**
     * @QueryParam(name="realisator", description="Name of the realisator")
     * @QueryParam(name="from", requirements="\d+", description="Type of the pony.")
     * @QueryParam(name="to", requirements="\d+", description="Type of the pony.")
     */
    public function getVideoAction(ParamFetcher $paramFetcher)
    {
        return $this->get('video_service')->getVideo(
            [
                'realisator' => $paramFetcher->get('realisator'),
                'from' => $paramFetcher->get('from'),
                'to' => $paramFetcher->get('to'),
            ]
        );
    }

    public function getVideoByIdAction($id)
    {
        return ['video' => $this->get('video_service')->getRepository()->findOneById($id)];
    }
}
