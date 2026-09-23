# whereStr *[Protected]*

Dynamically builds the `where` clause string for a SQL query based on provided arguments.

## Usage

```
whereStr(string $column, mixed $value = null, string $op = '='): string
```

## Parameters

**column** (string)
: The column (or field) within the database.

**value** (mixed)
: The value of the column. If value is not provided or is `null`, then the method will dynamically generate the appropriate `IS NULL` or `IS NOT NULL` syntax to ensure correct SQL evaluation. Value can also be a boolean (`true`|`false`) which will generate the appropriate `IS TRUE`, `IS FALSE`, `IS NOT TRUE` or `IS NOT FALSE` syntax. Value also supports advanced search operators to simplify `LIKE` clause generation. *^(optional)^*

**op** (string)
: The comparison operator. (*default*: '=') *^(optional)^*

| Operators | Description |
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

(string)
: Returns the `where` SQL statement.

## Examples

See the examples in the [where method](where.md) documentation.

## Debug Errors

- No debug errors.

## Related Methods

[where](where.md) | [andWhere](andWhere.md) | [orWhere](orWhere.md) | [normalizeWhere](normalizeWhere.md) | [whereGroup](whereGroup.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Helpers](../CoreyDB.md#helpers)
