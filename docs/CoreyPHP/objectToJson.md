# objectToJson

Converts a PHP object or array containing nested objects directly into a JSON formatted string.

## Usage

```
objectToJson(array|object $object): string
```

## Parameters

**object** (array|object)
: The object (or array containing objects) to convert.

## Return Value

Returns a JSON formatted string representation of the object's properties and values.

> :pushpin: Chains `objectToArray` and `arrayToJson` to recursively flatten nested object structures before encoding them into JSON.

## Examples

```
$cphp->objectToJson([id] => 10, [user] => "name", [active] => 1);
// Result: {"id":10,"user":"name","active":true}
```

## Debug Errors

- Triggers a warning via underlying `arrayToJson` if JSON encoding fails.

## Related Methods

[jsonToObject](jsonToObject.md) | [objectToArray](objectToArray.md) | [objectToSerial](objectToSerial.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
