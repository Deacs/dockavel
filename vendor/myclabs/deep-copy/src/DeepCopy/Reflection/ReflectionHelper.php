<?php

namespace DeepCopy\Reflection;

class ReflectionHelper
{
    /**
     * Retrieves all properties (including private ones), from object and all its ancestors.
     *
     * Standard \ReflectionClass->getProperties() does not return private properties from ancestor classes.
     *
     * @author muratyaman@gmail.com
     * @see http://php.net/manual/en/reflectionclass.getproperties.php
     *
     * @param \ReflectionClass $ref
     * @return \ReflectionProperty[]
     */
    public static function getProperties(\ReflectionClass $ref)
    {
        $props = $ref->getProperties();
        $propsArr = array();

        foreach ($props as $prop) {
            $f = $prop->getName();
            $propsArr[$f] = $prop;
        }

        if ($parentClass = $ref->getParentClass()) {
            $parentPropsArr = self::getProperties($parentClass);
            foreach ($parentPropsArr as $property) {
                $propsArr[] = $property;
            }
        }
        return $propsArr;
    }
}
