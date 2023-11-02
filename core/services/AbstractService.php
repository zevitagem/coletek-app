<?php

namespace app\services;

use app\repositories\AbstractRepository;
use app\contracts\ConfiguratorContract;
use app\validators\AbstractValidator;
use app\exceptions\ValidatorException;
use app\handlers\AbstractHandler;
use app\traits\AvailabilityWithDependencie;

abstract class AbstractService implements ConfiguratorContract
{
    use AvailabilityWithDependencie;

    protected AbstractRepository $repository;
    protected AbstractValidator $validator;
    protected AbstractHandler $handler;
    private bool $configured = false;

    public function getRepository()
    {
        return $this->repository;
    }

    public function setRepository(AbstractRepository $repository)
    {
        $this->repository = $repository;
    }

    public function setValidator(AbstractValidator $validator)
    {
        $this->validator = $validator;
    }

    public function setHandler(AbstractHandler $handler)
    {
        $this->handler = $handler;
    }

    public function validate(array $data, string $method)
    {
        if (empty($this->validator)) {
            return;
        }

        $validator = $this->validator;
        $validator->setData($data);

        if ($validator->run($method) === false) {
            $exception = new ValidatorException($validator->translate());
            $exception->setValidator($validator);
            throw $exception;
        }

        return true;
    }

    public function handle(array &$data, string $method)
    {
        if (empty($this->handler)) {
            return;
        }

        $handler = $this->handler;
        $handler->setData($data);

        $handler->run($method);
    }

    public function isConfigured()
    {
        return ($this->configured == true);
    }

    public function configure()
    {
        $this->configured = true;
        return $this;
    }
}
