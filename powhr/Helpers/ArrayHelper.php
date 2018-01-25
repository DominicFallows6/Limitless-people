<?php

/**
 * Helper for grouping the data with the same key from a 2 dimensional array into a one dimensional array
 * @param $key
 * @param $resultSet
 * @return array
 */
function createOneDimension($key, $data)
{

    $flattenedData = [];

    foreach($data AS $dataKey=>$value) {
        $flattenedData[] = $value->$key;
    }

    return $flattenedData;

}