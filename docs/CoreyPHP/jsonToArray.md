# jsonToArray

Safely converts a valid JSON string into a native associative PHP array.

## Usage

```
jsonToArray(string $json): array
```

## Parameters

**json** (string)
: The JSON string to decode.

## Return Value

(array)
: Returns the decoded associative array on success.
: Returns an empty array (`[]`) if the JSON string is malformed or decodes into a non-array scalar value.

> :pushpin: Avoids throwing unhandled script exceptions on decode errors or non-array values, returning a safe `[]` fallback while logging a warning.

## Examples

```
$cphp->jsonToArray('{"id":10,"user":"name","active":true}');
// Result: ['id' => 10, 'user' => 'name', 'active' => true]

$cphp->jsonToArray('{bad_json}');
// Result: [] (Logs a warning)
```

## Debug Errors

- Triggers a warning if there was an issue decoding the JSON.

## Related Methods

[arrayToJson](arrayToJson.md) | [jsonToObject](jsonToObject.md) | [jsonToSerial](jsonToSerial.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
