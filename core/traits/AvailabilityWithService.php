<?php

namespace app\traits;

trait AvailabilityWithService
{
    protected object $service;

    protected function setService(object $service)
    {
        $this->service = $service;
    }

    public function getService()
    {
        return $this->service;
    }
}
