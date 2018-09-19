<?php
declare(strict_types = 1);
namespace RHo\StableSort;

class StableSort
{

    /**
     * Sort an array and maintain index association
     *
     * @link http://www.php.net/manual/en/function.asort.php
     */
    public static function asort(array &$array, int $sort_flags = SORT_REGULAR): void
    {
        self::decorateOriginalArray($array);
        uasort($array, function ($a, $b) use ($sort_flags) {
            if ($a[1] == $b[1])
                return $a[0] - $b[0];
            $arr = [
                - 1 => $a[1],
                1 => $b[1]
            ];
            asort($arr, $sort_flags);
            reset($arr);
            return key($arr);
        });
        self::undecorateSortedArray($array);
    }

    /**
     * Sort an array with a user-defined comparison function and maintain index association
     *
     * @link http://www.php.net/manual/en/function.uasort.php
     */
    public static function uasort(array &$array, callable $value_compare_func): void
    {
        self::decorateOriginalArray($array);
        uasort($array, function ($a, $b) use ($value_compare_func) {
            $result = call_user_func($value_compare_func, $a[1], $b[1]);
            return $result == 0 ? $a[0] - $b[0] : $result;
        });
        self::undecorateSortedArray($array);
    }

    /**
     * Sort an array by values using a user-defined comparison function
     *
     * @link http://www.php.net/manual/en/function.usort.php
     */
    public static function usort(array &$array, callable $value_compare_func): void
    {
        self::decorateOriginalArray($array);
        usort($array, function ($a, $b) use ($value_compare_func) {
            $result = call_user_func($value_compare_func, $a[1], $b[1]);
            return $result == 0 ? $a[0] - $b[0] : $result;
        });
        self::undecorateSortedArray($array);
    }

    private static function decorateOriginalArray(array &$array)
    {
        $index = 0;
        foreach ($array as &$item)
            $item = [
                ++ $index,
                $item
            ];
    }

    private static function undecorateSortedArray(array &$array)
    {
        foreach ($array as &$item)
            $item = $item[1];
    }
}
