<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="VideoBundle\Entity\VideoRepository")
 * @ORM\Table(name="video")
 */
class Video
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Video
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Video
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $realisator;

    /**
     * @return mixed
     */
    public function getRealisator()
    {
        return $this->realisator;
    }

    /**
     * @param mixed $realisator
     * @return Video
     */
    public function setRealisator($realisator)
    {
        $this->realisator = $realisator;
        return $this;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return Video
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
}
