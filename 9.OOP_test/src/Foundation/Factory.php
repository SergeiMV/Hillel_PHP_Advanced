<?php

namespace Autobots\Foundation;

use Exception;

class Factory
{

    public array $types;

    public function getTypes(): array
    {
        return $this->types;
    }

    public function addType(object $class)
    {
        $path = get_class($class);

        if (strripos($path, "\\") !== false) {
            $mass = explode("\\", $path);
            $name = $mass[count($mass) - 1];
        } elseif (stripos($path, "/") !== false) {
            $mass = explode("/", $path);
            $name = $mass[count($mass) - 1];
        }

        $this->types[$name] = $class;
    }

    public function __call($name, $count)
    {
        if (strripos($name, "create") !== false) {
            $name = str_replace("create", "", $name);
            if (isset($this->types[$name]) && ($count > 0)) {
                $this->types[$name]->name = $name;
                for ($x = 0; $x < current($count); $x++) {
                    $army[] = clone $this->types[$name];
                }
                return $army;
            } else {
                throw new Exception('Invalid transformer type');
            }
        }
    }
}
