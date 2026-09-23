# arrayToJson

Converts a given PHP array into a JSON-formatted string. This is ideal for preparing data to be sent to API responses, JavaScript frontends, or for storage.

## Usage

```
arrayToJson(array $array = []): string
```

## Parameters

**array** (array)
: The array to convert.

## Return Value

(string)
: Returns the JSON-encoded string representation of the array.

## Examples

```
$cphp->arrayToJson(['id' => 10, 'user' => 'name', 'active' => true]);
// Result: {"id":10,"user":"name","active":true}
```

## Debug Errors

- Triggers a warning if there was an issue encoding the data.

## Related Methods

[arrayToObject](arrayToObject.md) | [arrayToSerial](arrayToSerial.md) | [jsonToArray](jsonToArray.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Conversion](../CoreyPHP.md#conversion)
