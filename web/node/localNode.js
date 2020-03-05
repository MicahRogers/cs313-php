var http = require('http');

function onRequest(request, response) {
  
  if (request.url == "/home")
  {
    response.writeHead(200, {"Content-Type": "text/html"});
    response.write('<h1>Welcome to the Home Page</h1>');
    response.end();
  }
  else if (request.url == "/getData")
  {
    response.writeHead(200, {"Content-Type": "application/json"});
    var myObj = {"name":"Micah","class":"cs313"}
    response.write("Name: " + myObj.name + " Class: " + myObj.class); 
    response.end();
  }
  else
  {
    response.writeHead(404, {"Content-Type": "text/html"});
    response.write("Page Not Found");
    response.end();
  }
  
  console.log("Recieved Request for: " + request.url);
  
}

var server = http.createServer(onRequest);
server.listen(8888);

console.log("listening port 8888");