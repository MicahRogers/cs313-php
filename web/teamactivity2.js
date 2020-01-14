
function onClick() 
{
	alert("Clicked!");
}

function changeColor() 
{
	var colorInput= document.getElementById("colorInput");

	var div = document.getElementById("div1");

	div.style.backgroundColor = colorInput.value;
}