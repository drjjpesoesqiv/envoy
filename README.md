# jpeso_Envoy
Adds products in URL request to cart.

Links are time-gated.

Takes a base64 encoded json string in $_GET['request'].

Default timeout is 60 seconds. Can be changed in admin panel.

Request JSON Example
```
{
  "p": [1,2,3],
  "t": time() # unix time
}
```
