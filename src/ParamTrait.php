<?php

namespace \Fine\Std;

trait ParamTrait
{

    /**
     * @var array Params
     */
    protected $_param = array();

    /* single */

    public function setParam($name, $value)
    {
        $this->_param[$name] = $value;
        return $this;
    }

    public function isParam($name)
    {
        return array_key_exists($name, $this->_param);
    }

    public function getParam($name)
    {
        return $this->_param[$name];
    }

    public function removeParam($name)
    {
        unset($this->_param);
    }

    /* multiple */

    public function setParams(array $params)
    {
        foreach ($params as $name => $value) {
            if (is_int($name)) {
                $this->_param[] = $name;
            } else {
                $this->_param[$name] = $value;
            }
        }
    }

    public function isParams(array $params)
    {
        foreach ($params as $name => $value) {
            if ($this->isParams($name, $value)) {
                continue;
            }
            return false;
        }

        return true;
    }

    public function getParams()
    {
        return $this->_param;
    }

    public function removeParams()
    {
        $this->_param = array();
        return $this;
    }

    /* helper */

    public function param($arg1 = null, $arg2 = null)
    {
        switch (func_num_args()) {

            case 0:
                return $this->getParams();

            case 1:
                if (is_array($arg1)) {
                    return $this->setParams($arg1);
                } else if (is_null($arg1)) {
                    return $this->removeParams();
                } else {
                    return $this->getParams($arg1);
                }

            case 2:
                $this->_param[$arg1] = $arg2;
                return $this;

        }        
    }

}
