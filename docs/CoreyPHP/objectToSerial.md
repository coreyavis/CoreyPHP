# objectToSerial

Converts a PHP object or array containing nested objects directly into a PHP serialized string.

## Usage

```
objectToSerial(array|object $object): string
```

## Parameters

**object** (array|object)
: The object (or array containing objects) to convert.

## Return Value

Returns a PHP serialized string representation of the converted data structure.

> :pushpin: Chains `objectToArray` and `arrayToSerial` to ensure all nested objects are recursively transformed into associative arrays before serialization.

## Examples

```
$cphp->objectToSerial([id] => 10, [user] => "name", [active] => 1);
// Result: a:3:{s:2:"id";i:10;s:4:"user";s:4:"name";s:6:"active";b:1;}
```

## Debug Errors

- No debug errors.

## Related Methods

[objectToArray](objectToArray.md) | [objectToJson](objectToJson.md) | [serialToObject](serialToObject.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
