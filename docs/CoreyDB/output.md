# output

This method defines the output data type of the sql query.

## Usage

```
output(string $output = 'auto'): static
```

## Parameters

**output** (string)
: The output data type. (*default*: `'auto'`)

| Valid Output Types | Description | Example |
| --- | --- | --- |
| auto | Will try to auto-select the best output type based on the result structure. | N/A |
| array | An ordered list with indexes. | [0 => 5, 1 => 'Name', 2 => true] |
| assoc | An array with keys (associative array). | ['id' => 5, 'user' => 'Name', 'isAdmin' => true] |
| integer or int | A whole number | 5 |
| json | Javascript Object Notation | [{"id":5, "user":"Name","isAdmin":true}] |
| object or obj | An object with keys and properties. | {id: 5, user: "Name", isAdmin: true} |
| serial | PHP serialized string. | a:3:{s:2:"id";i:5;s:4:"user";s:4:"Name";s:7:"isAdmin";b:1;} |
| string or str | Plain text | 'Name' |

## Return Value

Returns the current instance to allow for method chaining.

> If you explicitly request a scalar type (`string` or `integer`) but the database query returns a dataset containing multiple rows or columns, the data type request is ignored. To prevent data loss, the method will fall back and return the full dataset as an array.
>
> :pushpin: Best Practice: If you are unsure of the exact structure the SQL query will return, explicitly set an output type (like `array` or `assoc`). Relying on `auto` might return a scalar value (like a string) when only one result exists, which will cause downstream code to fail if it expects to loop through an array.

## Examples

```
// Requesting JSON output
$db->select()->where('user', 'name')->output('json')->execute();
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| output | auto | *string* (See: [above](output.md#parameters)) | Default output data type. |

## Debug Errors

- Logs a notice if invalid output data type.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Output](../CoreyDB.md#output)
