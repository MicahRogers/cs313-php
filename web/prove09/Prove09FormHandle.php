const express = require('express');
const app = express();
const port = process.env.PORT || 8080;

// tell it to use the public directory as one where static files live
app.use(express.static(__dirname));

// views is directory for all template files
app.set('views', __dirname);
app.set('view engine', 'ejs');

// set up a rule that says requests to "/cost" should be handled by the
// handleMath function below
app.get('/cost', computeCost);

// start the server listening
app.listen(port, function() {
  console.log('Node app is running on port', port);
});


/**********************************************************************
 * Ideally the functions below here would go into a different file
 * but for ease of reading this example and seeing all of the pieces
 * they are listed here.
 **********************************************************************/

function computeCost(request, response) {
	const operand1 = Number(request.query.weight);
	const operand2 = Number(request.query.shipping);

	// TODO: Here we should check to make sure we have all the correct parameters

}





