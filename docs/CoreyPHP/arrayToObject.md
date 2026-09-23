# arrayToObject

Converts a PHP array into an object structure.

> This method dynamically handles different array types:
>
> - Associative Arrays: Directly converted into an object where keys become property names.
> - Indexed Arrays: The method iterates through the array to check if its subarrays are associative. If a nested array is associative, it is recursively converted into an object, preserving the multidimensional structure where appropriate.

## Usage

```
arrayToObject(array $array = []): array|object
```

## Parameters

**array** (array)
: The array to convert.

## Return Value

(array|object)
: Returns an object (or a mixed structure of arrays and objects) containing the converted data, depending on whether the top-level array was associtive or indexed.

## Examples

```
$cphp->arrayToObject(['id' => 10, 'user' => 'name', 'active' => true])
// Result: ([id] => 10, [user] => "name", [active] => 1)
```

## Debug Errors

- No debug errors.

## Related Methods

[arrayToJson](arrayToJson.md) | [arrayToSerial](arrayToSerial.md) | [objectToArray](objectToArray.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
