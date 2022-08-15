<?php

# File created using Visual Studio Code: https://code.visualstudio.com/
# Created by Naisend





/**
 * Function helps us get the database column as array
 *
 * @param mixed $stmt
 * @param bool $buffer
 *
 * @return array
 *
 */
function fetch_assoc_stmt($stmt, $buffer = true): array
{
    try {
        if ($buffer) {
            $stmt->store_result();
        }
    } catch (Exception $e) {
    }
    $fields = $stmt->result_metadata()->fetch_fields();
    $args = array();
    foreach ($fields as $field) {
        $key = str_replace(' ', '_', $field->name); // space may be valid SQL, but not PHP
        $args[$key] = &$field->name; // this way the array key is also preserved
    }
    call_user_func_array(array($stmt, "bind_result"), array_values($args));
    $results = array();
    while ($stmt->fetch()) {
        $results[] = array_map("copy_value", $args);
    }
    if ($buffer) {
        $stmt->free_result();
    }
    return $results;
}


/**
 * Copy a variable by value
 *
 * @param mixed $v
 *
 * @return [type]
 *
 */
function copy_value($v)
{
    return $v;
}
