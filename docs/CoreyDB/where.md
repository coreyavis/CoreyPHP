# where

Appends a condition to the current SQL query. This method facilitates the filtering of records by mapping column names to specific values, automatically handling parameter binding to prevent SQL injection.

> Multiple `where` clauses can be chained, defaulting to a logical `AND` join.

## Usage

```
where(?string $column = null, mixed $value = null, string $op = '='): static
where(?string $column = null, array $value = null, string $op = '='): static
```

## Parameters

**column** (?string)
: The column (or field) within the database. If column is not provided or is `null`, then `WHERE` defaults to `WHERE 1`. *^(optional)^*

**value** (mixed)
: The value of the column. If value is not provided or is `null`, then the method will dynamically generate the appropriate `IS NULL` or `IS NOT NULL` syntax to ensure correct SQL evaluation. Value can also be a boolean (`true`|`false`) which will generate the appropriate `IS TRUE`, `IS FALSE`, `IS NOT TRUE` or `IS NOT FALSE` syntax. Value also supports advanced search operators to simplify `LIKE` clause generation. *^(optional)^*

: Array Support: If an array is passed, the method will generate multiple conditions for the same column and operator, automatically separated by a logical `OR` operator. *^(optional)^*

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

Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->where()->execute();
// Result: SELECT * FROM `table` WHERE 1

$db->select()->where('user')->execute();
// Result: SELECT * FROM `table` WHERE `user` IS NULL

$db->select()->where('user', 'name')->execute();
// Result: SELECT * FROM `table` WHERE `user` = 'name'

$db->select()->where('user', 'name')->where('qty', 10, '>')->execute();
// Result: SELECT * FROM `table` WHERE `user` = 'name' AND `qty` > 10

$db->select()->where('qty', [5, 15])->execute();
// Result: SELECT * FROM `table` WHERE `qty` = 5 OR `qty` = 15
```

### Output Examples

| Code | Output |
| --- | --- |
| $db->select()->where('user', 'name', '<>') | ``SELECT * FROM `table` WHERE `user` <> 'name'`` |
| $db->select()->where('qty', 10, '<') | ``SELECT * FROM `table` WHERE `qty` < 10`` |
| $db->select()->where('qty', 10, '>') | ``SELECT * FROM `table` WHERE `qty` > 10`` |
| $db->select()->where('qty', 10, '<=') | ``SELECT * FROM `table` WHERE `qty` <= 10`` |
| $db->select()->where('qty', 10, '>=') | ``SELECT * FROM `table` WHERE `qty` >= 10`` |
| $db->select()->where('user', 'name', '<=>') | ``SELECT * FROM `table` WHERE `user` <=> 'name'`` |
| $db->select()->where('user', 'name', '%') | ``SELECT * FROM `table` WHERE `user` LIKE '%name%'`` |
| $db->select()->where('user', 'name', '%=') | ``SELECT * FROM `table` WHERE `user` LIKE '%name'`` |
| $db->select()->where('user', 'name', '=%') | ``SELECT * FROM `table` WHERE `user` LIKE 'name%'`` |
| $db->select()->where('statis', ['active', 'pending']) | ``SELECT * FROM `table` WHERE `status` = 'active' OR `status` = 'pending'`` |

## Debug Errors

- No debug errors.

## Related Methods

[andWhere](andWhere.md) | [orWhere](orWhere.md) | [normalizeWhere](normalizeWhere.md) | [whereGroup](whereGroup.md) | [whereStr](whereStr.md) | [compileWhere](compileWhere.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)
