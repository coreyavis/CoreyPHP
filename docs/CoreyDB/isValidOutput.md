# isValidOutput

Determines if the provided output data type is valid.

## Usage

```
isValidOutput(?string $output): bool
```

## Parameters

**output** (string)
: The output data type to validate.

| Valid Output Types | Description | Example |
| --- | --- | --- |
| auto | Will try to auto select best output type. | N/A |
| array | An ordered list with indexes. | [0 => 5, 1 => 'Name', 2 => true] |
| assoc | An array with keys. | ['id' => 5, 'user' => 'Name', 'isAdmin' => true] |
| integer or int | A whole number | 5 |
| json | Javascript Object Notation | [{"id":5, "user":"Name","isAdmin":true}] |
| object or obj | An unordered list with keys and properties. | ([id] => 5, [user] => "Name", [isAdmin] => 1) |
| serial | Formatted text string. | a:3:{s:2:"id";i:5;s:4:"user";s:4:"Name";s:7:"isAdmin";b:1;} |
| string or str | Text | 'Name' |

## Return Value

(bool)
: Returns `true` if valid and `false` if invalid.

## Examples

```
$db->isValidOutput('array') = true
$db->isValidOutput('string') = true
$db->isValidOutput('number') = false
```

## Debug Errors

- No debug errors.

## Related Methods

[getValidOutput](getValidOutput.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Validation](../CoreyDB.md#validation)
