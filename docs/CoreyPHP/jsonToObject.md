# jsonToObject

Safely converts a valid JSON string into a native PHP object.

## Usage

```
jsonToObject(string $json): array|object
```

## Parameters

**json** (string)
: The JSON string to decode and convert into an object.

## Return Value

Returns a PHP object (or array depending on the structure) on success.

Returns an empty array (`[]`) if the JSON string is malformed or decodes into a non-array scalar value.

> :pushpin: Chains `jsonToArray` and `arrayToObject` to safely handle invalid JSON payloads without throwing uncaught exceptions.

## Examples

```
$cphp->jsonToObject('{"id":10,"user":"name","active":true}');
// Result: ([id] => 10, [user] => "name", [active] => 1)

$cphp->jsonToObject('{bad_json}');
// Result: [] (Logs a warning)
```

## Debug Errors

- Triggers a warning via underlying `jsonToArray` if there was an issue decoding the JSON.

## Related Methods

[jsonToArray](jsonToArray.md) | [jsonToSerial](jsonToSerial.md) | [objectToJson](objectToJson.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
