<?php
namespace Plexo\Sdk;

class Registry
{

    /**
     * @var array Almacén para todos los objetos
     * @todo Evaluar uso de SplObjectStorage en lugar de array.
    */
    static private $_store = array();

    /**
    * Agrega un objeto al registro
    *
    * Si no se especifica un nombre, se usa el nombre de la clase
    *
    * @param mixed $object El objeto a guardar
    * @param string $name Nombre para recuperar el objeto
    * @return void
    * @throws Exception
    */
    static public function add($object, $name = null) {
        $name = ($name && is_string($name)) ? $name : get_class($object);
        if (isset(self::$_store[$name])) {
            throw new Exception\PlexoException(sprintf("Ya existe un objeto registrado bajo el nombre '%s'.", $name));
        }
        self::$_store[$name]= $object;
    }

    /**
    * Obtener un objeto desde el registro
    *
    * @param string $name Nombre del objeto
    * @return mixed
    * @throws Exception
    */
    static public function get($name) {
        if (!self::contains($name)) {
            throw new Exception\PlexoException("El objeto no existe en el registro.");
        }
        return self::$_store[$name];
    }

    /**
    * Comprueba si un objeto se encuentra en el registro
    *
    * @param string $name Object name, {@see self::set()}
    * @return bool
    */
    static public function contains($name) {
        if (array_key_exists($name, self::$_store) && self::$_store[$name]) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
    * Remover objeto del registro
    *
    * @param string $name Nombre del objeto
    * @returns void
    */
    static public function remove($name) {
        if(self::contains($name)) {
            unset(self::$_store[$name]);
        }
    }

    /**
     * Vacía el registro
     *
     */
    static public function clear() {
        foreach (self::$_store AS $obj) {
            unset(self::$_store[$obj]);
        }
    }
}
