<?php

namespace \Fine\Std;

class DynamicFacade
{

    /**
     * @var array Podmioty
     */
    protected $_subject;

    /**
     * @var array<DynamicFacade> Podpodmioty
     * Kluczem jest nazwa wlasciowosci obiekty, wartoscia DynamicFacade z podmiotami
     */
    protected $_sub = array();

    public function __construct($config)
    {
        $this->subject = $config['subject'];
    }

    public function __call($name, $args)
    {
        foreach ($this->_subject as $subject) {
            if (!method_exists($subject, $name)) {
                continue;
            }
            call_user_func_array(array($subject, $name), $args);
        }

        return $this;
    }

    public function __get($name)
    {
        if (!isset($this->_sub[$name])) {
            $sub = array();
            foreach ($this->_subject as $subject) {
                if (!isset($subject->$name)) {
                    continue;
                }
                $sub[]  = $subject->$name;
            }
            $this->_sub[$name] = new \Fine\Std\DynamicFacade(array('subject' => $sub));;
        }

        return $this->_sub[$name];
    }

}
