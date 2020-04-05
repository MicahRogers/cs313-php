const express = require('express');
const app = express();
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
app.use(express.static(__dirname + '/public'));
app.set('view engine', 'ejs');

// use res.render to load up an ejs view file

// index page 
app.get('/', function(req, res) {
    res.render('pages/form.ejs');
});

 app.get('/getGames', getGames);
 app.get('/addGame', addGame);

// Start the server running
app.listen(app.get('port'), function() {
  console.log('Node app is running on port', app.get('port'));
});

function getGames(request, response) {
	// First get the boardgame's id
	const boardgame_id = request.query.boardgame_id;
        const boardgame_name = request.query.boardgame_name;
        const boardgame_min_players = request.query.boardgame_min_players;
        const boardgame_max_players = request.query.boardgame_max_players;
        const boardgame_coop_or_comp = request.query.boardgame_coop_or_comp;
        const publisher_id = request.query.publisher_id;

	// use a helper function to query the DB, and provide a callback for when it's done
	getGamesFromDb(boardgame_id, boardgame_name, boardgame_min_players, boardgame_max_players, boardgame_coop_or_comp, publisher_id, function(error, result) {
		if (error || result == "" || result.length <= 0) {
			response.status(500).json({success: false, data: error});
		} else {
			const boardgames = result;
			response.status(200).json(boardgames);
		}
	});
}

// This function gets a boardgame from the DB.
function getGamesFromDb(boardgame_id, boardgame_name, boardgame_min_players, boardgame_max_players, boardgame_coop_or_comp, publisher_id, callback) {
	console.log("Getting person from DB with boardgame_name: " + boardgame_name);
var pub_sql = " AND publisher_id = $4::int ";
if (publisher_id == 0)
{
  pub_sql = " AND $4::int = $4::int ";
}
var coop_or_comp_sql = " AND boardgame_coop_or_comp = $3::varchar(15) ";
if (boardgame_coop_or_comp == "Either")
{
  coop_or_comp_sql = " AND $3::varchar(15) = $3::varchar(15) ";
}
        const sql = "SELECT boardgame_id, boardgame_name, boardgame_min_players, boardgame_max_players, boardgame_coop_or_comp, publisher_id FROM boardgames WHERE boardgame_min_players <= $1::int AND boardgame_max_players >= $2::int " + coop_or_comp_sql + pub_sql;

        const params = [boardgame_min_players, boardgame_max_players, boardgame_coop_or_comp, publisher_id];
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

} // end of getGamesFromDb

function addGame(request, response) {
	// First get the boardgame's id
	//const boardgame_id = request.query.boardgame_id;
        const boardgame_name = request.query.boardgame_name;
        const boardgame_min_players = request.query.boardgame_min_players;
        const boardgame_max_players = request.query.boardgame_max_players;
        const boardgame_coop_or_comp = request.query.boardgame_coop_or_comp;
	const publisher_id = request.query.publisher_id;
console.log("pub ID: " + publisher_id);
// use a helper function to query the DB, and provide a callback for when it's done
	addGameToDb(boardgame_name, boardgame_min_players, boardgame_max_players, boardgame_coop_or_comp, publisher_id, function(error, result) {
		if (error || result == "" || result.length <= 0) {
			response.status(500).json({success: false, data: error});
		} else {
			const boardgame = result;
			response.status(200).json(boardgame);
		}
	});
}
// (SELECT publisher_id FROM publishers WHERE publisher_name = $5::varchar(120)))";
// This function adds a boardgame to the DB.
function addGameToDb(boardgame_name, boardgame_min_players, boardgame_max_players, boardgame_coop_or_comp, publisher_id, callback) {
	console.log("adding game to DB with boardgame_name: " + boardgame_name);
        const sql = "INSERT INTO boardgames VALUES (DEFAULT, $1::varchar(120), $2::int, $3::int, $4::varchar(120), $5::int)";

        const params = [boardgame_name, boardgame_min_players, boardgame_max_players, boardgame_coop_or_comp, publisher_id];
	pool.query(sql, params, function(err, result) {
		// If an error occurred...
		if (err) {
			console.log("Error in query: ")
			console.log(err);
			callback(err, null);
		}

		// Log this to the console for debugging purposes.
		console.log("Add result: " + boardgame_name);

		// When someone else called this function, they supplied the function
		// they wanted called when we were all done. Call that function now
		// and pass it the results.
		// (The first parameter is the error variable, so we will pass null.)
		callback(null, result.rows);
	});

} // end of getGamesFromDb
