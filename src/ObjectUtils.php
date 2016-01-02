<?php

namespace \Fine\Std;

class ObjectUtils
{

    /**
     * Revives dead object
     *
     * @param mixed $mDeadObject
     * @return \Object
     */
    public static function revive($mDeadObject)
    {
        if (is_string($mDeadObject)) {
            return new $mDeadObject;
        }

        if (is_array($mDeadObject)) {
            $class = array_shift($mDeadObject);
            return new $class($mDeadObject);
        }

        if ($mDeadObject instanceof Closure) {
            return $mDeadObject();
        }
        
        if (is_object($mDeadObject)) {
            return $mDeadObject;
        }

        throw LogicException(''); /** @todo */
    }

}
