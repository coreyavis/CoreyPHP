# replace

Defines the query type as a `REPLACE` statement. This method can be used to specify column names for a later `values()` call, or it can accept an associative array to define both columns and values at once.

> :pushpin: **Execution Required**: This method only constructs the SQL statement. You must terminate the method chain with `->execute()` to actually run the query against the database or `->preview()` to view the sql code.

## Usage

```
replace(string ...$args): static
replace(array $args): static
```

## Parameters

**args** (array|string)
: This parameter accepts three different formats:

- Variable List of Strings: Each string represents a column name.
- Indexed Array: An array of strings representing column names.
- Associative Array: An array where keys are column names and values are the data to be replaced. When using this format, the `values()` method is NOT required.

### Dynamic Value Tags

When passing values, you can use string tags (ex. `[datetime]`) to automatically inject dynamic system values. The class will parse these tags before executing the query.

| Tag | Keyword | Output Type | Description |
| --- | --- | --- | --- | --- |
| [date] | date | string | Current date formatted as `Y-m-d`. |
| [datetime] | datetime | string | Current date and time formatted as `Y-m-d H:i:s`. |
| [time] | time | string | Current time formatted as `H:i:s`. |
| [timestamp] | timestamp | integer | Current Unix timestamp. |

## Return Value

(static)
: Returns the current instance to allow for method chaining.

> NOTE: This method does not execute the query immediately. You must chain the `execute()` method at the end of your chain to run the query against the database.
>
> Upon successful execution, the `execute()` method returns the `int` representing the number of affected rows. Use this number to determine what action the database took:
>
> | Rows Affected | Meaning | Internal MySQL Action |
> | --- | --- | --- |
> | **1** | *Inserted* | A brand new row was created because no matching primary/unique key existed. |
> | **2** | *Overwritten* | An existing row conflicted. MySQL deleted the old row and inserted the new row. |
>
> You can retrieve the new row later via the read-only `$insertId` property (e.g., `$db->insertId`).

## Examples

1. Standard Usage (Separate Keys and Values)

    Use this if you prefer to keep your column list and data separate.

```
$db->replace('id', 'item', 'qty')->values(5, 'cars', 10)->execute();
// Result: REPLACE INTO `table` SET `id` = 5, `item` = 'cars', `qty` = 10

$db->replace('id', 'item', 'qty', 'modified')->values(5, 'cars', 10, '[datetime]')->execute();
// Result: REPLACE INTO `table` SET `id` = 5, `item` = 'cars', `qty` = 10, `modified` = 'YYYY-MM-DD HH:MM:SS' <- (YYYY-MM-DD HH:MM:SS = current date and time)
```

2. Associative Usage (Shorthand)

    Use this to define the entire payload in one go. The `values()` method is skipped entirely.

```
$db->replace(['id' => 10, 'item' => 'cars', 'qty' => 20])->execute();
// Result: REPLACE INTO `table` SET `id` = 10, `item` = 'cars', `qty` = 20

$db->replace(['id' => 10, 'item' => 'cars', 'qty' => 20, 'modified' => '[datetime]'])->execute();
// Result: REPLACE INTO `table` SET `id` = 10, `item` = 'cars', `qty` = 20, `modified` = 'YYYY-MM-DD HH:MM:SS' <- (YYYY-MM-DD HH:MM:SS = current date and time)
```

## Debug Errors

- No debug errors.

## Related Methods

[delete](delete.md) | [insert](insert.md) | [select](select.md) | [show](show.md) | [update](update.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Operations](../CoreyDB.md#operations)
