# getValidOperator *[Protected]*

This method validates if the provided comparison operator is valid; if not, it defaults to the equality operator (`'='`). This method accepts standard MySQL operators as well as user-friendly shorthands, which are automatically normalized to their proper SQL equivalents.

## Usage

```
getValidOperator(?string $operator, bool &$valid = false): string
```

## Parameters

**operator** (string)
: The comparison operator to validate.

| Valid Operators | Description |
| --- | --- |
| = or == | Equals |
| <> or != | Not equal to |
| < | Less than |
| > | Greater than |
| <= | Less than or equal to |
| >= | Greater than or equal to |
| <=> | Null-safe not equal |
| % | Search |
| %= | Ends with search |
| =% | Starts with search |

**valid** (bool)
: If valid is populated, then it returns `true` or `false` if the provided comparison operator is valid. *^(optional)^*

## Return Value

(string)
: Returns the **normalized MySQL operator** string (e.g., returns `'='` if `'=='` was provided, or `'<>'` if `'!='` was provided.) If the provided operator is invalid, then it defaults to `'='`.

## Examples

```
$db->getValidOperator() = '='
$db->getValidOperator('>') = '>'
$db->getValidOperator('!') = '='
```

## Debug Errors

- No debug errors.

## Related Methods

[isValidOperator](isValidOperator.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Helpers](../CoreyDB.md#helpers)
