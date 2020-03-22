const express = require('express');
const app = express();

const { Pool } = require("pg"); // This is the postgres database connection module.
// hello
// This says to use the connection string from the environment variable, if it is there,
// otherwise, it will use a connection string that refers to a local postgres DB
const connectionString = process.env.DATABASE_URL || "postgres://lgetfwqbnkosxf:bcf6bc4e0c8c7543903e937c86e437f2dc8fc42de4301c9e77516d7d7054bce9@ec2-35-174-88-65.compute-1.amazonaws.com:5432/dfbsl94qn6nig9";

// Establish a new connection to the data source specified the connection string.
const pool = new Pool({connectionString: connectionString, ssl: true});


app.set('port', (process.env.PORT || 5000));
app.use(express.static(__dirname + '/public'));

app.get('/getGame', getGame);

// Start the server running
app.listen(app.get('port'), function() {
  console.log('Node app is running on port', app.get('port'));
});

// This function handles requests to the /getPerson endpoint
// it expects to have an id on the query string, such as: http://localhost:5000/getPerson?boardgame_id=1
function getGame(request, response) {
	// First get the boardgame's id
	const boardgame_id = request.query.boardgame_id;
        //const boardgame_id = 0;
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