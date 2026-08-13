# serialToObject

Safely converts a serialized string into a native PHP object while protecting against Object Injection attacks.

## Usage

```
serialToObject(string $serial): array|object
```

## Parameters

**serial** (string)
: The serialized string to decode and convert into an object.

## Return Value

Returns a PHP object (or array depending on structure) on success.

Returns an empty array (`[]`) or object if the input is malformed, corrupted, or decodes into a non-array scalar value.

> :pushpin: Chains `serialToArray` and `arrayToObject` to safely parse serialized input while preventing PHP Object Injection vulnerabilities.

## Examples

```
$cphp->serialToObject('a:3:{s:2:"id";i:10;s:4:"user";s:4:"name";s:6:"active";b:1;}');
// Result: ([id] => 10, [user] => "name", [active] => 1)

$cphp->serialToObject('a:invalid');
// Result: [] (Logs a warning)
```

## Debug Errors

- Triggers a warning via underlying `serialToArray` if there was an issue deserializing the string.

## Related Methods

[objectToSerial](objectToSerial.md) | [serialToArray](serialToArray.md) | [serialToJson](serialToJson.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
