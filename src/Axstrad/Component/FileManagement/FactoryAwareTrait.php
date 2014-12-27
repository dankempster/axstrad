<?php
namespace Axstrad\Component\FileManagement;

/**
 * Axstrad\Component\FileManagement\FactoryAwareTrait
 */
trait FactoryAwareTrait
{
    private $factory;

    public function getFactory()
    {
        if ($this->factory === null) {
            $this->factory = new Factory();
        }
        return $this->factory;
    }

    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
        return $this;
    }
}
