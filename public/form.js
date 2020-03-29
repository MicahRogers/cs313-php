function getGame() {
trHTML = " ";
console.log($("#boardgame_max_players").val());
console.log($("#boardgame_min_players").val());
console.log($("#boardgame_coop_or_comp").val());
	var boardgame_name = $("#boardgame_name").val();
	var boardgame_id = $("#boardgame_id").val();
	var boardgame_max_players = $("#boardgame_max_players").val();
	var boardgame_min_players = $("#boardgame_min_players").val();
	var boardgame_coop_or_comp = $("#boardgame_coop_or_comp").val();
	var params = {
		boardgame_name: boardgame_name,
		boardgame_id: boardgame_id,
		boardgame_max_players: boardgame_max_players,
		boardgame_min_players: boardgame_min_players,
		boardgame_coop_or_comp : boardgame_coop_or_comp 
	};
	$.get("/getGame", params, function(result) {
console.log(result);
		if (result) { 
        $('#game_list').text(" ");
    $.each(result, function () {
        console.log("ID: " + this.boardgame_id);
        console.log("Name: " + this.boardgame_name);
        console.log(this.boardgame_min_players);
console.log(boardgame_min_players);
        console.log(this.boardgame_min_players <= boardgame_min_players);
        console.log(this.boardgame_max_players);
        console.log(this.boardgame_coop_or_comp);
        console.log(boardgame_coop_or_comp);
        console.log(this.boardgame_coop_or_comp == boardgame_coop_or_comp);

 trHTML += '<tr><td>' + this.boardgame_name + '</td><td>' + this.boardgame_id + '</td><td>' + this.boardgame_min_players + '</td><td>' + this.boardgame_max_players + '</td></tr>';
    });
        $('#game_list').append(trHTML);
		} else {
			$("#game_list").text("Error getting list.");
		}
	});
}

