var startTime = new Date().getTime();

var radiusMax = 100;
var radiusMin = 20;
var leftMarginLimit = 300;
var topMarginLimit = 300;
var maxTimeout = 2000;

var shape =document.getElementById("shape");

// Timer Functions
function startTimer() {
	startTime = new Date().getTime();
}

function stopTimer() {
	shape.style.display = "none";
	document.getElementById("timer").innerHTML = (new Date().getTime() - startTime) / 1000;
}

// Random Number Functions
function randomNumber(limit) {
	return Math.random() * limit;
}

function randomInt(limit) {
	return Math.floor(Math.random() * (limit + 1));
}

function randomHex(){
	return Math.floor(Math.random() * 16777215).toString(16);
}

// Create Shape Function
function createShape() {
	shape.style.borderRadius = (randomInt(1) * 50) + "%";
	shape.style.marginLeft = randomNumber(leftMarginLimit) + "px";
	shape.style.marginTop = randomNumber(topMarginLimit) + "px";
	shape.style.height = (randomNumber(radiusMax - radiusMin) + radiusMin) + "px";
	shape.style.width = shape.style.height;
	shape.style.backgroundColor = "#" + randomHex();
	shape.style.display = "block";

	startTimer()
}

// Click Function
function wasClicked() {
	stopTimer();
	setTimeout(createShape, randomNumber(maxTimeout));
}

// Listener
shape.addEventListener("click", wasClicked);

// Start
setTimeout(createShape, randomNumber(maxTimeout));