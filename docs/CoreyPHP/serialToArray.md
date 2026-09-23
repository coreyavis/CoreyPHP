# serialToArray

Safely converts a serialized string back into a native PHP array while preventing Object Injection attacks.

## Usage

```
serialToArray(string $serial): array
```

## Parameters

**serial** (string)
: The serialized string to decode.

## Return Value

(array)
: Returns the decoded array on success.
: Returns an empty array (`[]`) if the string is malformed, corrupted, or decodes into a non-array scalar value.

> :pushpin: Disables PHP class instantiation to prevent PHP Object Injection vulnerabilities, returning a safe `[]` fallback while logging a warning on failure.

## Examples

```
$cphp->serialToArray('a:3:{s:2:"id";i:10;s:4:"user";s:4:"name";s:6:"active";b:1;}');
// Result: ['id' => 10, 'user' => 'name', 'active' => true]

$cphp->serialToArray('a:invalid');
// Result: [] (Logs a warning)
```

## Debug Errors

- Triggers a warning if there was an issue deserializing the string.

## Related Methods

[arrayToSerial](arrayToSerial.md) | [serialToJson](serialToJson.md) | [serialToObject](serialToObject.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
