<?php

namespace \Fine\Std;

trait ConstructTrait
{

    public function __construct(array $config = array())
    {
        if ($config) {
            foreach ($config as $method => $arg) {
                $this->{$method}($arg);
            }
        }
    }

}
