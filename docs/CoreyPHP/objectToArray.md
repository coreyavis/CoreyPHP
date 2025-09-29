# objectToArray

Converts a PHP object or multi-dimensional object structure into an associative array.

> This method dynamically handles nested data structures:
>
> - Objects: Object properties are extracted and converted into associative array keys and values.
> - Nested Structures: Iterates recursively through properties and array elements, converting any nested objects into arrays while preserving multi-dimensional array structures.

## Usage

```
objectToArray(array|object $object): array
```

## Parameters

**object** (array|object)
: The object (or array containing objects) to convert.

## Return Value

Returns a fully converted associative array (or multi-dimensional array) containing the extracted object properties and values.

## Examples

```
$cphp->objectToArray([id] => 10, [user] => "name", [active] => 1);
// Result: ['id' => 10, 'user' => 'name', 'active' => 1]
```

## Debug Errors

- No debug errors.

## Related Methods

[arrayToObject](arrayToObject.md) | [objectToJson](objectToJson.md) | [objectToSerial](objectToSerial.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
