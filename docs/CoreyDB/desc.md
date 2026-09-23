# desc

Appends the `DESC` (descending) modifier to the specified key. If a key passed to this method already exists in the query order queue (via a previous `order()` call), it applies the `DESC` modifier to it. If the key does not exist, it creates it with the `DESC` modifier.

> :pushpin: This modifier only applies to standard columns managed by `order()`. It has no effect on priority rules created via [orderByValue](orderByValue.md).

## Usage

```
desc(array|string ...$columns): static
```

## Parameters

**columns** (array|string)
: A list of column names or an array containing column names to sort the query by in ascending order. Existing keys will be modified to `ASC`; new keys will be created with the `ASC` modifier.

## Return Value

(static)
: Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->order('id')->desc('id')->execute();
// Result: SELECT * FROM `table` ORDER BY `id` DESC

$db->select()->desc('qty')->execute();
// Result: SELECT * FROM `table` ORDER BY `qty` DESC

$db->select()->order('name', 'qty')->desc('name')->execute();
// Result: SELECT * FROM `table` ORDER BY `name` DESC, `qty`

$db->select()->order('name')->desc('qty')->execute();
// Result: SELECT * FROM `table` ORDER BY `name`, `qty` DESC
```

## Debug Errors

- No debug errors.

## Related Methods

[order](order.md) | [orderByValue](orderByValue.md) | [asc](asc.md) | [compileOrder](compileOrder.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)
