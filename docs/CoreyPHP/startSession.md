# startSession

Initializes a new session or attaches to an active one. Configures session cookie parameters using strict security defaults (`httponly`, `SameSite=Lax`, and `secure` conditional on HTTPS).

> :pushpin: Calling this method manually is usually unnecessary. The class constructor will automatically invoke `startSession()` if the configuration flag `session` is set to `true`.

## Usage

```
startSession(string $id): string
```

## Parameters

**id** (string)
: An explicit session ID to set before starting the session. Pass an empty string `""` to let PHP generate a random session ID. *^(optional)^*

## Return Value

Returns the active session ID.

> :pushpin: The session ID can also be retrieved later with `$cphp->sessionId`.

## Examples

Start a new standard session:

```
$sessionId = $cphp->startSession();
```

Start or resume a session with a custom ID:

```
$sessionId = $cphp->startSession('custom-session-id-12345');
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| session.auto | true | *bool* | Initialize sessions. |
| session.id | '' (empty) | *string* | Default session ID. If left empty, a random session ID will be created. |
| **Note**: Random session ID's is recommended. Only supply if you have a good reason. ||||
| session.name | COREYSESSID | *string* | Default session name. Only change if you plan on creating more than one session. |

## Debug Errors

- No debug errors.

## Related Methods

[clearSession](clearSession.md) | [endSession](endSession.md) | [getSession](getSession.md) | [regenSession](regenSession.md) | [removeSession](removeSession.md) | [setSession](setSession.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Session Management](../CoreyPHP.md#session-management)
