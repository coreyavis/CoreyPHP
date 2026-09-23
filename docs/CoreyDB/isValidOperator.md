# isValidOperator

Determines if the provided comparison operator is a valid operator that can be used within the `where` clause.

## Usage

```
isValidOperator(?string $operator): bool
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

## Return Value

(bool)
: Returns `true` if valid and `false` if invalid.

## Examples

```
$db->isValidOperator('=') = true
$db->isValidOperator('>') = true
$db->isValidOperator('!') = false
```

## Debug Errors

- No debug errors.

## Related Methods

[getValidOperator](getValidOperator.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Validation](../CoreyDB.md#validation)
