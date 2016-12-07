
function displayMessages ()
{
	var messageContainer = document.getElementById("MessageContainer");
	messageContainer.style.visibility = "visible";
}

function hiddenMessages ()
{
	var messageContainer = document.getElementById("MessageContainer");
	messageContainer.style.visibility = "hidden";
}

function addMessages ()
{
	var messageContainer = document.getElementById("MessageContainerDiv");
	messageContainer.innerHTML += 'Me:' + 'alma' + '<br>';
}