# insert

Defines the query type as a `INSERT` statement. This method can be used to specify column names for a later `values()` call, or it can accept an associative array to define both columns and values at once.

> :pushpin: **Execution Required**: This method only constructs the SQL statement. You must terminate the method chain with `->execute()` to actually run the query against the database or `->preview()` to view the sql code.

## Usage

```
insert(string ...$args): static
insert(array $args): static
```

## Parameters

**args** (array|string)
: This parameter accepts three different formats:

- Variable List of Strings: Each string represents a column name.
- Indexed Array: An array of strings representing column names.
- Associative Array: An array where keys are column names and values are the data to be inserted. When using this format, the `values()` method is NOT required.

### Dynamic Value Tags

When passing values, you can use string tags (ex. `[datetime]`) to automatically inject dynamic system values. The class will parse these tags before executing the query.

| Tag | Keyword | Output Type | Description |
| --- | --- | --- | --- | --- |
| [date] | date | string | Current date formatted as `Y-m-d`. |
| [datetime] | datetime | string | Current date and time formatted as `Y-m-d H:i:s`. |
| [time] | time | string | Current time formatted as `H:i:s`. |
| [timestamp] | timestamp | integer | Current Unix timestamp. |

## Return Value

Returns the current instance to allow for method chaining.

> NOTE: This method does not execute the query immediately. You must chain the `execute()` method at the end of your chain to run the query against the database.
>
> Upon successful execution, the `execute()` method returns the `int` ID of the newly inserted row, or `true` if no ID is generated.
>
> You can also retrieve this ID later via the read-only `$insertId` property (e.g., `$db->insertId`).

## Examples

1. Standard Usage (Separate Keys and Values)

    Use this if you prefer to keep your column list and data separate.

```
$db->insert('item', 'qty')->values('cars', 10)->execute();
// Result: INSERT INTO `table` (`item`, `qty`) VALUES ('cars', 10)

$db->insert('item', 'qty', 'created')->values('cars', 10, '[datetime]')->execute();
// Result: INSERT INTO `table` (`item`, `qty`, `created`) VALUES ('cars', 10, 'YYYY-MM-DD HH:MM:SS') <- (YYYY-MM-DD HH:MM:SS = current date and time)
```

2. Associative Usage (Shorthand)

    Use this to define the entire payload in one go. The `values()` method is skipped entirely.

```
$db->insert(['item' => 'cars', 'qty' => 20])->execute();
// Result: INSERT INTO `table` (`item`, `qty`) VALUES ('cars', 20)

$db->insert(['item' => 'cars', 'qty' => 20, 'created' => '[datetime]'])->execute();
// Result: INSERT INTO `table` (`item`, `qty`, `created`) VALUES ('cars', 20, 'YYYY-MM-DD HH:MM:SS') <- (YYYY-MM-DD HH:MM:SS = current date and time)
```

## Debug Errors

- No debug errors.

## Related Methods

[delete](delete.md) | [replace](replace.md) | [select](select.md) | [show](show.md) | [update](update.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Operations](../CoreyDB.md#operations)
