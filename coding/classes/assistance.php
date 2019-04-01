<?php

/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-06-10
 * Time: 8.49.PD
 */
class assistance
{

    private $id;
    private $jobseeker_id;
    private $assistance_confirmation;
    private $assistance_request;
    private $assistance;
    private $date;

    /**
     * assistance constructor.
     * @param $jobseeker_id
     * @param $assistance
     */
    public function __construct($jobseeker_id, $assistance)
    {
        $this->jobseeker_id = $jobseeker_id;
        $this->assistance = $assistance;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getJobseekerId()
    {
        return $this->jobseeker_id;
    }

    /**
     * @param mixed $jobseeker_id
     */
    public function setJobseekerId($jobseeker_id)
    {
        $this->jobseeker_id = $jobseeker_id;
    }

    /**
     * @return mixed
     */
    public function getAssistanceConfirmation()
    {
        return $this->assistance_confirmation;
    }

    /**
     * @param mixed $assistance_confirmation
     */
    public function setAssistanceConfirmation($assistance_confirmation)
    {
        $this->assistance_confirmation = $assistance_confirmation;
    }

    /**
     * @return mixed
     */
    public function getAssistanceRequest()
    {
        return $this->assistance_request;
    }

    /**
     * @param mixed $assistance_request
     */
    public function setAssistanceRequest($assistance_request)
    {
        $this->assistance_request = $assistance_request;
    }

    /**
     * @return mixed
     */
    public function getAssistance()
    {
        return $this->assistance;
    }

    /**
     * @param mixed $assistance
     */
    public function setAssistance($assistance)
    {
        $this->assistance = $assistance;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}