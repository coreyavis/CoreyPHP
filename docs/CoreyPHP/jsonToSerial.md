# jsonToSerial

Safely converts a valid JSON string directly into a PHP serialized string.

## Usage

```
jsonToSerial(string $json): string
```

## Parameters

**json** (string)
: The JSON string to decode and serialize.

## Return Value

(string)
: Returns a PHP serialized string representation of the decoded data structure on success.
: Returns a serialized empty array (`a:0:{}`) if the JSON string is malformed or decodes into a non-array scalar value.

> :pushpin: Chains `jsonToArray` and `arrayToSerial` to safely normalize input data prior to serialization.

## Examples

```
$cphp->jsonToSerial('{"id":10,"user":"name","active":true}');
// Result: a:3:{s:2:"id";i:10;s:4:"user";s:4:"name";s:6:"active";b:1;}

$cphp->jsonToSerial('{bad_json}');
// Result: a:0:{} (Logs a warning)
```

## Debug Errors

- Triggers a warning via underlying `jsonToArray` if there was an issue decoding the JSON.

## Related Methods

[jsonToArray](jsonToArray.md) | [jsonToObject](jsonToObject.md) | [serialToJson](serialToJson.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
