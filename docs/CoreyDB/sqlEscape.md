# sqlEscape

Sanitizes a string for safe use in a MySQL query by escaping special characters. Depending on the parameters, it automatically wraps the value in single quotes for standard assignments or applies SQL wildcard characters (`%`) for `LIKE` clauses, ensuring both security and proper syntax formatting in one step.

## Usage

```
sqlEscape(mixed $esc = null, bool $search = false): string
```

## Parameters

**esc** (mixed)
: The value to escape.

**search** (bool)
: If set to `true`, then the value is wrapped in wildcards (`%`). *^(optional)^*

## Return Value

Returns the escaped value.

## Examples

```
$db->sqlEscape('value') = 'value'
$db->sqlEscape('term', true) = '%term%'
```

## Debug Errors

- No debug errors.

## Related Methods

[sqlWrap](sqlWrap.md) | [searchStr](searchStr.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Utilities](../CoreyDB.md#utilities)
