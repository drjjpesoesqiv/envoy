# jpeso_Envoy

**A magento2 extension**

<p>
A URL endpoint that adds one or more items to a customer cart.<br>
Takes a base64 encoded json string in $_GET['request'].<br>
All links should contain the UNIX time.<br>
Default timeout is 60 seconds and can be changed in admin panel.<br>
</p>

Request JSON Example
```
{
  "p": [1,2,3],
  "t": time() # unix time
}
```
