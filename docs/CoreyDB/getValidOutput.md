# getValidOutput *[Protected]*

This method validates if the provided output data type is valid; if not, it defaults to the config default. This method accepts standard PHP types as well as shorthand aliases.

## Usage

```
getValidOutput(?string $output, bool &$valid = false): string
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

**valid** (bool)
: If valid is populated, then it returns `true` or `false` if the provided output data type is valid. *^(optional)^*

## Return Value

(string)
: Returns the **normalized** output data type string (e.g., returns `'integer'` even if `'int'` was provided). If the provided type is invalid, it returns the configuration default.

| Standard PHP type | Alias |
| --- | --- |
| integer | int |
| object | obj |
| string | str |

## Examples

```
$db->getValidOutput('array') = 'array'
$db->getValidOutput('string') = 'string'
$db->getValidOutput('number') = 'auto'
```

## Debug Errors

- No debug errors.

## Related Methods

[isValidOutput](isValidOutput.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Helpers](../CoreyDB.md#helpers)
