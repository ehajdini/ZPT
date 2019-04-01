<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-06-11
 * Time: 12.07.PD
 */

class vacancy
{

    private $nipt;
    private $position;
    private $places;
    private $announced_date;

    /**
     * vacancy constructor.
     * @param $nipt
     * @param $position
     * @param $places
     * @param $announced_date
     */
    public function __construct($nipt, $position, $places, $announced_date)
    {
        $this->nipt = $nipt;
        $this->position = $position;
        $this->places = $places;
        $this->announced_date = $announced_date;
    }

    /**
     * @return mixed
     */
    public function getNipt()
    {
        return $this->nipt;
    }

    /**
     * @param mixed $nipt
     */
    public function setNipt($nipt)
    {
        $this->nipt = $nipt;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * @param mixed $places
     */
    public function setPlaces($places)
    {
        $this->places = $places;
    }

    /**
     * @return mixed
     */
    public function getAnnouncedDate()
    {
        return $this->announced_date;
    }

    /**
     * @param mixed $announced_date
     */
    public function setAnnouncedDate($announced_date)
    {
        $this->announced_date = $announced_date;
    }


}