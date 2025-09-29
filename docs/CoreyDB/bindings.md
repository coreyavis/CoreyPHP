# bindings *[Protected]*

Dynamically generates the required data-type string for MySQLi prepared statements based on the native PHP types of the passed arguments.

## Usage

```
bindings(array $items): string
```

## Parameters

**items** (array)
: An indexed list of parameters that will be injected into the SQL statement.

## Return Value

Returns a string where each character represents the type of the corresponding item.

| Character | Type |
| --- | --- |
| i | int or bool |
| d | float |
| b | resource |
| s | string |

## Examples

```
$db->bindings(['name', 12, 'yellow', 3.14, true]) = 'sisdi'
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Helpers](../CoreyDB.md#helpers)
