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
		for(idx=0; idx < arr.length; idx++) {
			if (arr[idx].indexOf("color-") == 0) {
				return arr[idx].replace("color-","");
			}
		}
	}

	function addClass(elt, newClassName) {
	  var arr = elt.className.split(" ");
	  if (arr.indexOf(newClassName) == -1) {
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
			value: cell.innerHTML != "" ? parseInt(cell.innerHTML) : "",
			y: parseInt(yXValues[0]),
			x: parseInt(yXValues[1])
		};
		return cellAttrs;
	}

	/**
	 * Shuffles array in place.
	 * @param {Array} a items An array containing the items.
	 */
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
		elt.innerHTML = values[1]; 
		elt.className="cell color-" + values[0];
	}

	/* return pseudo random value using seed global variable */ 
	function random() {
		var x = Math.sin(seed++) * 10000;
		return x - Math.floor(x);
	}

	/* pause an async function for ms milliseconds */ 
	function sleep(ms) {
	  return new Promise(resolve => setTimeout(resolve, ms));
	}

	/* Prepare new game */
	async function initBoard() {
	
		// Checking seed value for random or specified game
		var isSeed = document.querySelector('input[name="seedName"]:checked').value;
		var seedValue = document.getElementById("seedValueId").value;
		
		if(isSeed == "random" || (seedValue == "" || isNaN(seedValue)) ) {
			seed = Math.floor(Math.random() * 100000) + 1;
			console.log("random game with seed " + seed);
			document.getElementById("seedValueId").value = seed;
		} else {
			console.log("seedValue defined by user to "+seedValue);
			seed = seedValue;
		}
		
		// Checking level (difficulty) value
		level = document.querySelector('input[name="levelName"]:checked').value;
		
		
		var header = document.getElementById("seedBoxId");
		header.innerHTML = "Seed "+seed;
		
		displayPanel(3);
		isCurrentGame=true;
		selectedCell = null;
		

				
		/* Creates table with colors and numbers */
		var table = new Array(5*15);
		var tableIdx=0;
		for(colorIdx=0;  colorIdx < 5; colorIdx++){
			for(number=1; number < 16; number++) {
				table[tableIdx]=colors[colorIdx]+"-"+number;
				tableIdx++;
			}
		}
		
		shuffle(table);

		// display cells on board
		tableIdx=0;
		for(y=1; y < 6; y++) { // lines
			setCell("white-", 0, y);
			for(x=1; x < 16; x++) { //columns
				setCell(table[tableIdx], x, y);
				tableIdx++;
				await sleep(20);
			}
		}
		
		// Searching and removing the 1
		var currentLine = 1;
		for(y=1; y < 6; y++) { // lines
			for(x=1; x < 16; x++) { //columns
				var elt = document.getElementById(y + "." + x);
				addClass(elt, "highlightedCell");
				if(elt.innerHTML == "1") {
					var cellColor = getColorClass(elt);
					setCell(cellColor + "-1",0, currentLine);
					setCell("white-", x, y);
					currentLine++;
				}
				await sleep(30);
				removeClass(elt, "highlightedCell");
			}
		}
		
		defineClicEvents();
		
	}

	function canSwap(originCell, targetCell) {
		var orgAttr = getCellAttrs(originCell);
		var targAttr = getCellAttrs(targetCell);
		
		var targetCellColor = getColorClass(targetCell);
		var targetCellValue = targetCell.innerHTML;
		var targetXxValues = targetCell.id.split(".");
		
		if (targAttr.color=="white") {
			var xLeftCell = targAttr.x - 1;
			var leftCellAttr = getCellAttrsByCoord(targAttr.y, xLeftCell);
			if(orgAttr.color == leftCellAttr.color
				&& leftCellAttr.value + 1 == orgAttr.value) {
				return true;
			}
			
			var xRightCell = targAttr.x + 1;
			if(xRightCell < 16) {
				var rightCellAttr = getCellAttrsByCoord(targAttr.y, xRightCell);
				if(orgAttr.color == rightCellAttr.color
					&& rightCellAttr.value -1 == orgAttr.value) {
					return true;
				}
			}
		}
		
		return false;
	}

	/* swap target cell and origin cell */
	function swapCells(originCell, targetCell) {
		var orgAttr = getCellAttrs(originCell);
		var targAttr = getCellAttrs(targetCell);
		
		// set origin cell attributes
		setCell(targAttr.color + "-" + targAttr.value, orgAttr.x, orgAttr.y);
		
		// set target cell attributes
		setCell(orgAttr.color +"-" + orgAttr.value, targAttr.x, targAttr.y);
		
	}

	/* Return true if the specified cell and several cells on the left forms a long enough suit */
	function areSuit(cell) {
		var suitSize = 1;
		var cellAttr = getCellAttrs(cell);
		
		var x = cellAttr.x -1;
		var value = cellAttr.value - 1;
		var continueSuit = true;
		while(x > 0 && continueSuit) {
			var leftCell = getCellAttrsByCoord(cellAttr.y, x);
			continueSuit = (leftCell.value == value) && (leftCell.color == cellAttr.color);
			if(continueSuit) {
				suitSize++;
			}
			x--;
			value--;
		}
		return suitSize >= 3 + parseInt(level);
	}

	/* return true if the origin cell (and several cells) can swipe to target cell */
	function canSwipe(originCell, targetCell) {
		var orgAttr = getCellAttrs(originCell);
		var targAttr = getCellAttrs(targetCell);

		return orgAttr.value == 15
			&& targAttr.value == ""
			&& targAttr.y == orgAttr.y // same line-height
			&&  targAttr.x == orgAttr.x + 1 // 1 case to the right
			&& areSuit(originCell);
			
	}

	/* Swipe originCell and all others cells of a suit to the right */
	async function swipeCells(originCell, targetCell) {
		var blankCell = targetCell;
		var toSwap = originCell;
		var toSwapAttr = getCellAttrs(toSwap);
		var x = toSwapAttr.x;
		var value = toSwapAttr.value;
		var color = toSwapAttr.color;
		
		while(x > 0 && (toSwapAttr.value == value) && (toSwapAttr.color == color)) {
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
		if (color != "white" && value > 1 && value < 16) {
			var cells = document.getElementsByClassName("cell");
			for(i = 0 ; i < cells.length; i++) {
				var currentCellAttr = getCellAttrs(cells[i]);
				if(currentCellAttr.value == value && currentCellAttr.color == color) {
			  		addClass(cells[i], "highlightedCell");
					break;
				}
			}
		}
	}

	/* Highlight the tiles that match the current tile */ 
	function hint(emptyCell) {
		var emptyCellAttr = getCellAttrs(emptyCell);
		if(emptyCellAttr.x >= 1) {
			highlightMatchingCell(emptyCellAttr.y, emptyCellAttr.x - 1, true);
		}
		if(emptyCellAttr.x < 15) {
			highlightMatchingCell(emptyCellAttr.y, emptyCellAttr.x + 1, false);
		}
	}

	/* Removes highlight */
	function removeHints() {
		var cells = document.getElementsByClassName("highlightedCell");
		for(i = cells.length - 1 ; i >= 0; i--) { // reverse iterate because the class changes inside the loop
			var cellAttr = getCellAttrs(cells[i]);
			removeClass(cells[i], "highlightedCell"); 
		}
	}

	var clickCell = function clickCellFunc(evt) {
		var cell = evt.currentTarget;
		var cellAttr = getCellAttrs(cell);
		
		var yxValues = cell.id.split(".");
		if(cellAttr.x != 0) { // no action on first column
			if(selectedCell) { // if a cell is already selected, check if correct destination
				if(cell == selectedCell) { 
					// double-click, we move cell if only on destination is available
					var emptyCells = document.getElementsByClassName("color-white");
					var swappable = new Array();
					var swipable = new Array();
					for(i = emptyCells.length - 1 ; i >= 0; i--) { 
						if(canSwap(selectedCell, emptyCells[i])) {
							swappable.push(emptyCells[i]);
						} else if(canSwipe(selectedCell, emptyCells[i])) {
							swipable.push(emptyCells[i]);
						}
					}
					if((swappable.length + swipable.length) == 1) {
						if(swappable.length ==1) {
							swapCells(selectedCell,swappable[0]);
						} else {
							swipeCells(selectedCell,swipable[0]);
						}
					}
				} else if (canSwap(selectedCell, cell)) {
					swapCells(selectedCell, cell);
				} else if(canSwipe(selectedCell, cell) ) {
					swipeCells(selectedCell, cell);
				}
				removeClass(selectedCell, "selectCell");
				removeClass(cell, "selectCell");
				selectedCell = null;
				isGameSuccessfull();
			} else if(cell.innerHTML != "") {
				removeHints();
				selectedCell = cell;
				addClass(cell, "selectCell");
			} else {
				if (selectedCell) {
					removeClass(cell, "selectCell");
					selectedCell = null;
				}
				removeHints();
				hint(cell);
			}
		}
	}

	/* Add clic listeners to each cell of the board */
	function defineClicEvents() {
		var cells = document.getElementsByClassName("cell");
		for(i = 0 ; i < cells.length; i++) {
			cells[i].addEventListener('click', clickCell)
		}
	}

	function displayPanel(idToDisplay) {
		// display resume button if needed
		var resumeBox = document.getElementById("resumeButtonId");
		resumeBox.style.display = isCurrentGame ? "block" : "none";
			
		var initPanel = document.getElementById("initBox");
		var newGamePanel = document.getElementById("newGamePanel");
		var boardPanel = document.getElementById("board");
		switch(idToDisplay) {
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
		for(i=1; (i < 6 && stillOk); i++) {
			// first check right cells to see if there are blank
			var rightCell = getCellAttrsByCoord(i, 15);
			if(rightCell.color != "white") {
				stillOk = false;
			}
		}
		if(stillOk) {
			for(y=1; (y < 6 && stillOk); y++) {
				// check all lines
				var previousCell = getCellAttrsByCoord(y, 0);
				var expectedValue = previousCell.value + 1; // is 1
				var color = previousCell.color;
				for(x=1; (x < 15 && stillOk); x++) {
					// check all cells of the line
					var cell = getCellAttrsByCoord(y, x);
					if(cell.color != color || cell.value != expectedValue) {
						stillOk = false;
					} else {
						expectedValue++;
					}
				}
			}
		}
		if(stillOk) {
			alert("You won");
		} else {
			console.log("Not yet successfull");
		}
		return stillOk;
		
	}