<?php
namespace Plexo\Sdk\Utilities\functions;

function array_filter_recursive($input, $canonize = false)
{
    foreach ($input as &$value) {
        if ($value instanceof \Plexo\Sdk\Models\PlexoModelInterface) {
            $value = $value->toArray($canonize);
        }
        if (is_array($value)) {
            $value = array_filter_recursive($value, $canonize);
        }
    }
    return array_filter($input, function ($v) {
        return !is_null($v);
    });
}

function ksortRecursive(&$array)
{
    if (!is_array($array)) {
        return false;
    }
    if (key($array) !== 0) {
        ksort($array, SORT_REGULAR);
    }
    foreach ($array as &$arr) {
        ksortRecursive($arr);
    }
    return true;
}
