# whereGroup *[Protected]*

Compiles a nested array of conditions into a parenthesized SQL string, inverting the internal logical join to `OR` if the outer context is an `AND` block, or `AND` if the outer context is an `OR` block, and appends it to the query parts.

## Usage

```
whereGroup(array $array): static
```

## Parameters

**array** (array)
: A sequential list of condition definitions, where each item is an associative array containing `column`, `value`, and `op` keys; previously normalized by the `normalizeWhere` method.

## Return Value

Returns the current instance to allow for method chaining.

## Examples

```
private bool $orwhere = false;
$db->whereGroup([['column' => 'id', 'value' => 12, 'op' => '='], ['column' => 'user', 'value' => 'name', 'op' => '=']])
// Result: (`id` = 12 OR `user` = 'name')

private bool $orwhere = true;
$db->whereGroup([['column' => 'id', 'value' => 12, 'op' => '='], ['column' => 'user', 'value' => 'name', 'op' => '=']])
// Result: (`id` = 12 AND `user` = 'name')
```

> The $orwhere boolean is set by the `andWhere` and `orWhere` methods.

## Debug Errors

- No debug errors.

## Related Methods

[where](where.md) | [andWhere](andWhere.md) | [orWhere](orWhere.md) | [normalizeWhere](normalizeWhere.md) | [whereStr](whereStr.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Helpers](../CoreyDB.md#helpers)
