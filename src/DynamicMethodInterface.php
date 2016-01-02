<?php

namespace \Fine\Std;

/**
 * Dynamic methods for object
 *
 * - @todo - only if method is not defied staticly in class code
 * - simple user prio > magic method __call
 *
 * Example - simple use:
 * $o = new (DynamicMethodInterface);
 * $o->defineMethod('sum', function ($object, $number1, $number2) {
 *     return $number1 + $number2;
 * });
 * $o->defineMethod('sum3', function ($object, $number1, $number2, $number3) {
 *     return $object->sum(
 *         $object->sum($number1, $number2),
 *         $number3
 *     );
 * });
 * echo $o->sum3(1, 2, 3);
 *
 *
 * Example - magic method __call:
 * $o = new (DynamicMethodInterface);
 * $o->defineMethod('__call', function ($object, $name, $args) {
 *     if ($name = 'multiplication') {
 *         return $args[0] * $args[1];
 *     }
 * });
 * echo $o->multiplication(1, 2);
 *
 *
 */
interface DynamicMethodInterface
{

    /**
     * Defines dynamic method
     *
     * @param string $name Method name
     * @param callable $callback called on dynamic method call, first argument is context object,
     *              next arguments are passed from dynamic method call
     * @return this
     */
    public function defineMethod($name, $callback);

    /**
     * Defines dynamic methods
     *
     * @param array $methods Methods where key is a method name, value is a callback
     * @return this
     */
    public function defineMethods($methods);

}
