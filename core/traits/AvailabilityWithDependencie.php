<?php

namespace app\traits;

trait AvailabilityWithDependencie
{
    protected array $dependencies = [];

    public function setDependencie(string $key, mixed $object)
    {
        $this->dependencies[$key] = $object;
    }

    public function getDependencie(string $key)
    {
        return (isset($this->dependencies[$key])) ? $this->dependencies[$key] : null;
    }
}
