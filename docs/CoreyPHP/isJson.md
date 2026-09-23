# isJson

Validates whether a given input is a string containing valid, array-like JSON (specifically JSON objects `{}` or JSON arrays `[]`). This method automatically uses PHP 8.3's highly efficient native `json_validate()` function if available, or falls back to parsing the string via `json_decode()`.

## Usage

```
isJson(mixed $string): bool
```

## Parameters

**string** (mixed)
: The test string to evaluate for valid JSON structure.

## Return Value

(bool)
: Returns `true` if the input is a valid JSON string representing an array or object.
: Returns `false` for scalar JSON values (e.g., `"dark"`, `"123"`, `"true"`), non-string values, or malformed JSON.

## Examples

Valid JSON Input

```
$cphp->isJson('{"user": "Alice", "role": "admin"}');
// Result: true
```

Invalid JSON Output

```
$cphp->isJson('["user" => "Alice" , "role" => "admin"]');
// Result: false
```

## Debug Errors

- No debug errors.

## Related Methods

[isAssoc](isAssoc.md) | [isSerial](isSerial.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Validation](../CoreyPHP.md#validation)
