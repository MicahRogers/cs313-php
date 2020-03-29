var path = require('path');
var express = require('express');
var app = express();

const { Pool } = require("pg"); // This is the postgres database connection module.
const connectionString = process.env.DATABASE_URL; console.log(process.env.DATABASE_URL)
const pool = new Pool({connectionString: connectionString, ssl: true,}); console.log(connectionString)
console.log(process.env.DATABASE_URL);
console.log("hello");

// We are going to use sessions
var session = require('express-session')

// set up sessions
app.use(session({
  secret: 'my-super-secret-secret!',
  resave: false,
  saveUninitialized: true
}))

// Because we will be using post values, we need to use the body parser middleware
app.use(express.json() );       // to support JSON-encoded bodies
app.use(express.urlencoded({ extended: true })); // to support URL-encoded bodies
const { Pool } = require("pg"); // This is the postgres database connection module.

// This says to use the connection string from the environment variable, if it is there,
// otherwise, it will use a connection string that refers to a local postgres DB
const connectionString = process.env.DATABASE_URL || "postgres://lgetfwqbnkosxf:bcf6bc4e0c8c7543903e937c86e437f2dc8fc42de4301c9e77516d7d7054bce9@ec2-35-174-88-65.compute-1.amazonaws.com:5432/dfbsl94qn6nig9";

// Establish a new connection to the data source specified the connection string.
const pool = new Pool({connectionString: connectionString, ssl: true});


app.set('port', (process.env.PORT || 5000));

// We have html and js in the public directory that need to be accessed
app.use(express.static(path.join(__dirname, 'public')))

// This shows how to use a middleware function for all requests (it is defined below)
// Becuse it comes after the static function call, we won't see it log requests
// for the static pages, only the ones that continue on passed that (e.g., /logout)
app.use(logRequest);

// Setup our routes
app.post('/login', handleLogin);
app.post('/logout', handleLogout);

app.get('/', getPerson);
app.get('/hello', hello);
// This method has a middleware function "verifyLogin" that will be called first
app.get('/getServerTime', verifyLogin, getServerTime);

// Start the server
app.listen(app.get('port'), function() {
  console.log('Node app is running on port', app.get('port'));
});

function hello()
{
console.log("hello");
}


/****************************************************************
 * These methods should likely be moved into a different module
 * But they are here for ease in looking at the code
 ****************************************************************/

function getGame(request, response) {
	// First get the boardgame's id
	//const boardgame_id = request.query.boardgame_id;
        const boardgame_id = 1;
console.log(boardgame_id);

	// use a helper function to query the DB, and provide a callback for when it's done
	getGameFromDb(boardgame_id, function(error, result) {
		// This is the callback function that will be called when the DB is done.
		// The job here is just to send it back.

		// Make sure we got a row with the boardgame, then prepare JSON to send back
		if (error || result == null || result.length != 1) {
			response.status(500).json({success: false, data: error});
		} else {
			const boardgame = result[0];
			response.status(200).json(boardgame);
		}
	});
}

// This function gets a boardgame from the DB.
// By separating this out from the handler above, we can keep our model
// logic (this function) separate from our controller logic (the getPerson function)
function getGameFromDb(boardgame_id, callback) {
	console.log("Getting person from DB with boardgame_id: " + boardgame_id);

	// Set up the SQL that we will use for our query. Note that we can make
	// use of parameter placeholders just like with PHP's PDO.
	const sql = "SELECT boardgame_id, boardgame_name FROM boardgames WHERE boardgame_id = $1::int";

	// We now set up an array of all the parameters we will pass to fill the
	// placeholder spots we left in the query.
	   const params = [boardgame_id];

	// This runs the query, and then calls the provided anonymous callback function
	// with the results.
	pool.query(sql, params, function(err, result) {
		// If an error occurred...
		if (err) {
			console.log("Error in query: ")
			console.log(err);
			callback(err, null);
		}

		// Log this to the console for debugging purposes.
		console.log("Found result: " + JSON.stringify(result.rows));

		// When someone else called this function, they supplied the function
		// they wanted called when we were all done. Call that function now
		// and pass it the results.
		// (The first parameter is the error variable, so we will pass null.)
		callback(null, result.rows);
	});

} // end of getGameFromDb

// Checks if the username and password match a hardcoded set
// If they do, put the username on the session
function handleLogin(request, response) {
	var result = {success: false};

	// We should do better error checking here to make sure the parameters are present
	if (request.body.username == "admin" && request.body.password == "password") {
		request.session.user = request.body.username;
		result = {success: true};
	}

	response.json(result);
}

// If a user is currently stored on the session, removes it
function handleLogout(request, response) {
	var result = {success: false};

	// We should do better error checking here to make sure the parameters are present
	if (request.session.user) {
		request.session.destroy();
		result = {success: true};
	}

	response.json(result);
}

// This function returns the current server time
function getServerTime(request, response) {
	var time = new Date();
	
	var result = {success: true, time: time};
	response.json(result); 
}

// This is a middleware function that we can use with any request
// to make sure the user is logged in.
function verifyLogin(request, response, next) {
	if (request.session.user) {
		// They are logged in!

		// pass things along to the next function
		next();
	} else {
		// They are not logged in
		// Send back an unauthorized status
		var result = {success:false, message: "Access Denied"};
		response.status(401).json(result);
	}
}

// This middleware function simply logs the current request to the server
function logRequest(request, response, next) {
	console.log("Received a request for: " + request.url);

	// don't forget to call next() to allow the next parts of the pipeline to function
	next();
}