function getGames() {
trHTML = " ";
	var boardgame_name = $("#boardgame_name").val();
	var boardgame_id = $("#boardgame_id").val();
	var boardgame_max_players = $("#boardgame_max_players").val();
	var boardgame_min_players = $("#boardgame_min_players").val();
	var boardgame_coop_or_comp = $("#boardgame_coop_or_comp").val();
	var publisher_id = $("#publisher_id").val();
	var params = {
		boardgame_name: boardgame_name,
		boardgame_id: boardgame_id,
		boardgame_max_players: boardgame_max_players,
		boardgame_min_players: boardgame_min_players,
		boardgame_coop_or_comp : boardgame_coop_or_comp, 
                publisher_id : publisher_id
	};
	$.get("/getGames", params, function(result) {
console.log(result);
		if (result) { 
        $('#game_list').text(" ");
var publisher_name = " ";
trHTML = '<table><tr><th>Name</th><th>Min Players</th><th>Max Players</th><th>Coop or Comp</th><th>Publisher</th></tr><tr>';
    $.each(result, function () {
if (this.publisher_id == 1) { publisher_name = "Z-Man Games"; }
else if (this.publisher_id == 2) { publisher_name = "Hasbro"; }
else if (this.publisher_id == 3) { publisher_name = "Test Publisher"; }
else { publisher_name = "Other"; }
 trHTML += '<tr><td>' + this.boardgame_name + '</td><td>' + this.boardgame_min_players + '</td><td>' + this.boardgame_max_players + '</td><td>' + this.boardgame_coop_or_comp + '</td><td>' + publisher_name + '</td></tr>';
    });
 trHTML += '</table>'; 
        $('#game_list').append(trHTML);
		} else {
			$("#game_list").text("Error getting list.");
		}
	});
}

function addGame() {
trHTML = " ";
	var boardgame_name = $("#boardgame_name").val();
	//var boardgame_id = $("#boardgame_id").val();
	var boardgame_max_players = $("#boardgame_max_players").val();
	var boardgame_min_players = $("#boardgame_min_players").val();
	var boardgame_coop_or_comp = $("#boardgame_coop_or_comp").val();
        var publisher_id = $("#publisher_id").val();
	var params = {
		boardgame_name: boardgame_name,
		//boardgame_id: boardgame_id,
		boardgame_max_players: boardgame_max_players,
		boardgame_min_players: boardgame_min_players,
		boardgame_coop_or_comp : boardgame_coop_or_comp, 
                publisher_id : publisher_id
	};
	$.get("/addGame", params, function(result) {
		if (result) { 
        $('#game_list').text(" ");
    $.each(result, function () {
 trHTML += '<tr><td>' + this.boardgame_name + '</td><td>' + this.boardgame_id + '</td><td>' + this.boardgame_min_players + '</td><td>' + this.boardgame_max_players + '</td></tr>';
    });
        $("#game_list").text("Game Added");
		} else {
			$("#game_list").text("Error adding to list.");
		}
	});
}

