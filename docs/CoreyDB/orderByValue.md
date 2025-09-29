# orderByValue

Prioritizes rows containing a specific value (or `NULL` values) in a column by forcing them to the **absolute top** of the result set, no matter where this method is placed in your method chain (even if called after a standard `order()` method), its priority sorting rules are automatically compiled first in the final SQL statement. This method automatically handles parameter binding to prevent SQL injection.

This is a conditional sort. Under the hood, it evaluates the condition as a boolean expression (`1` for a match, `0` for no match). Because of this, it defaults to `DESC` (Descending) order to ensure the matching records (`1`) float to the top.

> :pushpin: While the standard `order()` method can be modified by trailing calls to `asc()` or `desc()`, `orderByValue()` completely ignores them.

## Usage

```
orderByValue(string $column, mixed $value = null, bool $desc = true): static
```

## Parameters

**column** (string)
: The name of the database column to evaluate.

**value** (mixed)
: The target value you want to prioritize. If passed as `NULL` (or omitted), it dynamically switches from an `=` comparison to an `IS NULL` condition. (*default*: `null`) *^(optional)^*

**desc** (bool)
: If set to `false`, matches will be pushed to the bottom instead of the top. (*default*: `true`) *^(optional)^*

## Return Value

Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->orderByValue('qty', 5)->execute();
// Result: SELECT * FROM `table` ORDER BY (`qty` = 5) DESC

$db->select()->orderByValue('status', 'urgent')->execute();
// Result: SELECT * FROM `table` ORDER BY (`status` = 'urgent') DESC

$db->select()->orderByValue('status', 'urgent', false)->execute();
// Result: SELECT * FROM `table` ORDER BY (`status` = 'urgent') ASC

$db->select()->orderByValue('status')->execute();
// Result: SELECT * FROM `table` ORDER BY (`status` IS NULL) DESC

$db->select()->order('id')->orderByValue('status', 'urgent')->execute();
// Result: SELECT * FROM `table` ORDER BY (`status` = 'urgent') DESC, `id`
```

## Debug Errors

- No debug errors.

## Related Methods

[order](order.md) | [asc](asc.md) | [desc](desc.md) | [compileOrder](compileOrder.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)
