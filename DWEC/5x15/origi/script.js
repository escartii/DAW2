var colors = ['ForestGreen', 'darkred', 'blue', 'gold', 'MediumPurple'];
var seed = 1;
var level = 0;
var isCurrentGame = false;
var selectedCell = null;

function getCellByCoord(y, x) {
	return document.getElementById(y + "." + x);
}

function getCellAttrsByCoord(y, x) {
	return getCellAttrsById(y + "." + x);
}

function getCellAttrsById(cellId) {
	var cell = document.getElementById(cellId);
	return getCellAttrs(cell);
}

function getColorClass(cell) {
	var arr = cell.className.split(" ");
	for (idx = 0; idx < arr.length; idx++) {
		if (arr[idx].indexOf("color-") === 0) {
			return arr[idx].replace("color-", "");
		}
	}
}

function addClass(elt, newClassName) {
	var arr = elt.className.split(" ");
	if (arr.indexOf(newClassName) === -1) {
		elt.className += " " + newClassName;
	}
}

function removeClass(elt, newClassName) {
	let re = new RegExp(`\\b${newClassName}\\b`, 'g');
	elt.className = elt.className.replace(re, "").trim();
}

function getCellAttrs(cell) {
	var yXValues = cell.id.split(".");
	var cellAttrs = {
		id: cell.id,
		color: getColorClass(cell),
		value: cell.innerHTML !== "" ? parseInt(cell.innerHTML) : "",
		y: parseInt(yXValues[0]),
		x: parseInt(yXValues[1])
	};
	return cellAttrs;
}

function shuffle(a) {
	var j, x, i;
	for (i = a.length - 1; i > 0; i--) {
		j = Math.floor(random() * (i + 1));
		x = a[i];
		a[i] = a[j];
		a[j] = x;
	}
	return a;
}

function setCell(value, x, y) {
	var elt = document.getElementById(y + "." + x);
	var values = value.split("-");
	elt.innerHTML = values[1] || "";
	elt.className = "cell color-" + (values[0] || "white");

	if (elt.innerHTML !== "" && getColorClass(elt) !== "white") {
		elt.draggable = true;
	} else {
		elt.draggable = false;
	}
}

function random() {
	var x = Math.sin(seed++) * 10000;
	return x - Math.floor(x);
}

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

async function initBoard() {
	var isSeed = document.querySelector('input[name="seedName"]:checked').value;
	var seedValue = document.getElementById("seedValueId").value;
	if (isSeed == "random" || (seedValue == "" || isNaN(seedValue))) {
		seed = Math.floor(Math.random() * 100000) + 1;
		document.getElementById("seedValueId").value = seed;
	} else {
		seed = seedValue;
	}

	level = document.querySelector('input[name="levelName"]:checked').value;

	var header = document.getElementById("seedBoxId");
	header.innerHTML = "Seed " + seed;

	displayPanel(3);
	isCurrentGame = true;

	var table = new Array(5 * 15);
	var tableIdx = 0;
	for (colorIdx = 0; colorIdx < 5; colorIdx++) {
		for (number = 1; number < 16; number++) {
			table[tableIdx] = colors[colorIdx] + "-" + number;
			tableIdx++;
		}
	}

	shuffle(table);

	tableIdx = 0;
	for (y = 1; y < 6; y++) {
		setCell("white-", 0, y);
		for (x = 1; x < 16; x++) {
			setCell(table[tableIdx], x, y);
			tableIdx++;
			await sleep(20);
		}
	}

	var currentLine = 1;
	for (y = 1; y < 6; y++) {
		for (x = 1; x < 16; x++) {
			var elt = document.getElementById(y + "." + x);
			addClass(elt, "highlightedCell");
			if (elt.innerHTML == "1") {
				var cellColor = getColorClass(elt);
				setCell(cellColor + "-1", 0, currentLine);
				setCell("white-", x, y);
				currentLine++;
			}
			await sleep(30);
			removeClass(elt, "highlightedCell");
		}
	}

	defineDragEvents();
}

function canSwap(originCell, targetCell) {
	var orgAttr = getCellAttrs(originCell);
	var targAttr = getCellAttrs(targetCell);

	if (targAttr.color == "white") {
		var xLeftCell = targAttr.x - 1;
		var leftCellAttr = getCellAttrsByCoord(targAttr.y, xLeftCell);
		if (orgAttr.color == leftCellAttr.color && leftCellAttr.value + 1 == orgAttr.value) {
			return true;
		}

		var xRightCell = targAttr.x + 1;
		if (xRightCell < 16) {
			var rightCellAttr = getCellAttrsByCoord(targAttr.y, xRightCell);
			if (orgAttr.color == rightCellAttr.color && rightCellAttr.value - 1 == orgAttr.value) {
				return true;
			}
		}
	}
	return false;
}

function swapCells(originCell, targetCell) {
	var orgAttr = getCellAttrs(originCell);
	var targAttr = getCellAttrs(targetCell);

	setCell(targAttr.color + "-" + targAttr.value, orgAttr.x, orgAttr.y);
	setCell(orgAttr.color + "-" + orgAttr.value, targAttr.x, targAttr.y);
}

function areSuit(cell) {
	var suitSize = 1;
	var cellAttr = getCellAttrs(cell);
	var x = cellAttr.x - 1;
	var value = cellAttr.value - 1;
	var continueSuit = true;
	while (x > 0 && continueSuit) {
		var leftCell = getCellAttrsByCoord(cellAttr.y, x);
		continueSuit = (leftCell.value == value) && (leftCell.color == cellAttr.color);
		if (continueSuit) {
			suitSize++;
		}
		x--;
		value--;
	}
	return suitSize >= 3 + parseInt(level);
}

function canSwipe(originCell, targetCell) {
	var orgAttr = getCellAttrs(originCell);
	var targAttr = getCellAttrs(targetCell);

	return orgAttr.value == 15
		&& targAttr.value === ""
		&& targAttr.y == orgAttr.y
		&& targAttr.x == orgAttr.x + 1
		&& areSuit(originCell);
}

async function swipeCells(originCell, targetCell) {
	var blankCell = targetCell;
	var toSwap = originCell;
	var toSwapAttr = getCellAttrs(toSwap);
	var x = toSwapAttr.x;
	var value = toSwapAttr.value;
	var color = toSwapAttr.color;

	while (x > 0 && (toSwapAttr.value == value) && (toSwapAttr.color == color)) {
		swapCells(toSwap, blankCell);
		blankCell = document.getElementById(toSwapAttr.y + "." + x);
		x--;
		value--;
		toSwap = document.getElementById(toSwapAttr.y + "." + x);
		toSwapAttr = getCellAttrs(toSwap);
		await sleep(50);
	}
}

function highlightMatchingCell(y, x, isLeft) {
	var cellAttr = getCellAttrsByCoord(y, x);
	var color = cellAttr.color;
	var value = cellAttr.value + (isLeft ? 1 : -1);
	if (color != "white" && value >= 1 && value <= 15) {
		var cells = document.getElementsByClassName("cell");
		for (var i = 0; i < cells.length; i++) {
			var currentCellAttr = getCellAttrs(cells[i]);
			if (currentCellAttr.value == value && currentCellAttr.color == color) {
				addClass(cells[i], "highlightedCell");
				break;
			}
		}
	}
}

function hint(emptyCell) {
	var emptyCellAttr = getCellAttrs(emptyCell);
	if (emptyCellAttr.x >= 1) {
		highlightMatchingCell(emptyCellAttr.y, emptyCellAttr.x - 1, true);
	}
	if (emptyCellAttr.x < 15) {
		highlightMatchingCell(emptyCellAttr.y, emptyCellAttr.x + 1, false);
	}
}

function removeHints() {
	var cells = document.getElementsByClassName("highlightedCell");
	for (var i = cells.length - 1; i >= 0; i--) {
		removeClass(cells[i], "highlightedCell");
	}
}

function defineDragEvents() {
	var cells = document.getElementsByClassName("cell");
	for (var i = 0; i < cells.length; i++) {
		cells[i].addEventListener('dragstart', function (evt) {
			evt.dataTransfer.setData("text/plain", evt.target.id);
		});

		cells[i].addEventListener('dragover', function (evt) {
			evt.preventDefault();
		});

		cells[i].addEventListener('dragenter', function (evt) {
			var cell = evt.currentTarget;
			var attr = getCellAttrs(cell);
			if (attr.color == "white") {
				addClass(cell, "highlightedCell");
			}
		});

		cells[i].addEventListener('dragleave', function (evt) {
			var cell = evt.currentTarget;
			removeClass(cell, "highlightedCell");
		});

		cells[i].addEventListener('drop', async function (evt) {
			evt.preventDefault();
			removeClass(evt.currentTarget, "highlightedCell");

			var targetCell = evt.currentTarget;
			var originCellId = evt.dataTransfer.getData("text/plain");
			var originCell = document.getElementById(originCellId);

			if (canSwap(originCell, targetCell)) {
				swapCells(originCell, targetCell);
			} else if (canSwipe(originCell, targetCell)) {
				await swipeCells(originCell, targetCell);
			}

			isGameSuccessfull();
		});
	}
}

function displayPanel(idToDisplay) {
	var resumeBox = document.getElementById("resumeButtonId");
	resumeBox.style.display = isCurrentGame ? "block" : "none";

	var initPanel = document.getElementById("initBox");
	var newGamePanel = document.getElementById("newGamePanel");
	var boardPanel = document.getElementById("board");
	switch (idToDisplay) {
		case 1:
			initPanel.style.display = "inline-block";
			newGamePanel.style.display = "none";
			boardPanel.style.display = "none";
			break;
		case 2:
			initPanel.style.display = "none";
			newGamePanel.style.display = "inline-block";
			boardPanel.style.display = "none";
			break;
		case 3:
			initPanel.style.display = "none";
			newGamePanel.style.display = "none";
			boardPanel.style.display = "inline-block";
			break;
	}
}

function isGameSuccessfull() {
	var stillOk = true;
	for (var i = 1; (i < 6 && stillOk); i++) {
		var rightCell = getCellAttrsByCoord(i, 15);
		if (rightCell.color != "white") {
			stillOk = false;
		}
	}
	if (stillOk) {
		for (var y = 1; (y < 6 && stillOk); y++) {
			var previousCell = getCellAttrsByCoord(y, 0);
			var expectedValue = previousCell.value + 1; // es 1
			var color = previousCell.color;
			for (var x = 1; (x < 15 && stillOk); x++) {
				var cell = getCellAttrsByCoord(y, x);
				if (cell.color != color || cell.value != expectedValue) {
					stillOk = false;
				} else {
					expectedValue++;
				}
			}
		}
	}
	if (stillOk) {
		alert("You won");
	} else {
		console.log("Not yet successfull");
	}
	return stillOk;
}