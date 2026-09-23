# serialToJson

Safely converts a serialized string into a JSON formatted string while protecting against Object Injection attacks.

## Usage

```
serialToJson(string $serial): string
```

## Parameters

**serial** (string)
: The serialized string to decode and convert into JSON.

## Return Value

(string)
: Returns a JSON formatted string representation of the deserialized data on success.
: Returns a JSON empty array string (`"[]"`) if the input is malformed, corrupted, or decodes into a non-array scalar value.

> :pushpin: Chains `serialToArray` and `arrayToJson` to safely handle serialized data without executing unexpected class instances or throwing uncaught exceptions.

## Examples

```
$cphp->serialToJson('a:3:{s:2:"id";i:10;s:4:"user";s:4:"name";s:6:"active";b:1;}');
// Result: {"id":10,"user":"name","active":true}

$cphp->serialToJson('a:invalid');
// Result: [] (Logs a warning)
```

## Debug Errors

- Triggers a warning via underlying `serialToArray` if there was an issue deserializing the string.

## Related Methods

[jsonToSerial](jsonToSerial.md) | [serialToArray](serialToArray.md) | [serialToObject](serialToObject.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
