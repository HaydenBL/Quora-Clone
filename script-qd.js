var upvotes = document.getElementsByClassName("upvote-arrow");
var downvotes = document.getElementsByClassName("downvote-arrow");

function setFunctions() {
	for(var i = 0; i < upvotes.length; i++) {
		upvotes[i].addEventListener("click", upvoteClicked, false);
	}

	for(var i = 0; i < upvotes.length; i++) {
		downvotes[i].addEventListener("click", downvoteClicked, false);
	}
}

window.onload = autoRefresh;

function autoRefresh() {
	//alert("Hi");
	setFunctions();
	setInterval( function() { refreshQuestionDetail(); }, 5000);
};