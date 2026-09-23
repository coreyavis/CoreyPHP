# orWhere

Processes a structured array of conditions, defaulting to a logical `OR` join followed by a logical `AND` join for nested groups.

> This method is needed for creating `OR` joins, and for building complex `OR` based queries with nested `AND` logic.

## Usage

```
orWhere(array $array = []): static
```

## Parameters

**array** (array)
: A multi-dimensional array. Each element in the primary array represents a single query condition or a grouped set of conditions for the nested `AND` join.

> Each element must follow one of the three supported structures, and you can mix and match them within the same cell.
>
>> :one: Key-Value Pair: An associative array where the key is the `column` and the value is the `value`. Uses the default `=` operator. (ex. ``['user' => 'name']``)
>
>> :two: Indexed Array: A numerically indexed array representing `column`, `value` and `op` (in that order). The 3rd value is optional and defaults to `=`. (ex. ``['qty', 10, '>']`` or ``['user', 'name']``)
>
>> :three: Full Associative Array: A formal array using explicit `column`, `value`, and `op` keys. (ex. ``['column' => 'user', 'value' => 'name', 'op' => '<>']``)
>
> To create a logical group (parentheses), simply wrap multiple elements inside their own sub-array. (ex. ``[['qty', 20, '>'], ['qty', 40, '<']]``)

## Return Value

(static)
: Returns the current instance to allow for method chaining.

## Examples

```
$data = [
    'user' => 'name',
    ['qty', 20, '>']
];
$db->select()->andWhere($data)->execute();
// Result: SELECT * FROM `table` WHERE `user` = 'name' OR `qty` > 20

$data2 = [
    'user' => 'name',
    [
        ['qty', 20, '>'],
        ['qty', 40, '<']
    ]
];
$db->select()->andWhere($data2)->execute();
// Result: SELECT * FROM `table` WHERE `user` = 'name' OR (`qty` > 20 AND `qty` < 40)

$data3 = [
    ['column' => 'color', 'value' => 'yellow', 'op' => '<>'],
    'item' => 'cars'
];
$db->select()->andWhere($data3)->execute();
// Result: SELECT * FROM `table` WHERE `color` <> 'yellow' OR `item` = 'cars'
```

## Debug Errors

- Triggers a warning if the argument is empty.
- Throws an exception if a logical `AND` condition has already been started.

## Related Methods

[where](where.md) | [andWhere](andWhere.md) | [normalizeWhere](normalizeWhere.md) | [whereGroup](whereGroup.md) | [whereStr](whereStr.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)
