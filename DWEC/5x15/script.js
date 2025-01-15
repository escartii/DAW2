// Constants
const COLORS = ['ForestGreen', 'darkred', 'blue', 'gold', 'MediumPurple'];
let seed = 1;
let level = 0;
let isCurrentGame = false;
let selectedCell = null;

function initBoard() {
    // Handle seed initialization
    const isSeed = document.querySelector('input[name="seedName"]:checked').value;
    const seedValue = document.getElementById("seedValueId").value;
    
    seed = isSeed === "random" || !seedValue ? 
           Math.floor(Math.random() * 100000) + 1 : 
           parseInt(seedValue);
    
    document.getElementById("seedValueId").value = seed;
    level = document.querySelector('input[name="levelName"]:checked').value;
    
    document.getElementById("seedBoxId").innerHTML = "Seed " + seed;
    displayPanel(3);
    isCurrentGame = true;
    selectedCell = null;

    initializeBoard();
}

async function initializeBoard() {
    // Create board data
    const table = [];
    for (let color of COLORS) {
        for (let number = 1; number <= 15; number++) {
            table.push(`${color}-${number}`);
        }
    }
    shuffle(table);

    // Place tiles on board
    let tableIdx = 0;
    for (let y = 1; y <= 5; y++) {
        setCell("white-", 0, y);
        for (let x = 1; x < 16; x++) {
            setCell(table[tableIdx], x, y);
            tableIdx++;
            await sleep(20);
        }
    }

    // Move 1s to first column
    let currentLine = 1;
    for (let y = 1; y <= 5; y++) {
        for (let x = 1; x < 16; x++) {
            const cell = getCellByCoord(y, x);
            if (cell.innerHTML === "1") {
                const color = getColorClass(cell);
                setCell(`${color}-1`, 0, currentLine);
                setCell("white-", x, y);
                currentLine++;
            }
        }
    }

    setupEventListeners();
}

function setupEventListeners() {
    const cells = document.getElementsByClassName("cell");
    Array.from(cells).forEach(cell => {
        cell.addEventListener('click', handleCellClick);
        cell.setAttribute('draggable', true);
        cell.addEventListener('dragstart', handleDragStart);
        cell.addEventListener('dragenter', handleDragEnter);
        cell.addEventListener('dragover', handleDragOver);
        cell.addEventListener('dragleave', handleDragLeave);
        cell.addEventListener('drop', handleDrop);
        cell.addEventListener('dragend', handleDragEnd);
    });
}

function handleCellClick(event) {
    const cell = event.currentTarget;
    const cellAttr = getCellAttrs(cell);

    if (cellAttr.x === 0) return;

    if (selectedCell) {
        if (cell === selectedCell) {
            handleDoubleSelection();
        } else if (canSwap(selectedCell, cell)) {
            swapCells(selectedCell, cell);
            checkGameSuccess();
        } else if (canSwipe(selectedCell, cell)) {
            swipeCells(selectedCell, cell);
            checkGameSuccess();
        }
        clearSelection();
    } else if (cell.innerHTML) {
        selectCell(cell);
    } else {
        showHints(cell);
    }
}

// Drag and Drop Functions
let dragSrcEl = null;

function handleDragStart(e) {
    dragSrcEl = this;
    e.dataTransfer.effectAllowed = 'move';
    addClass(this, 'dragging');
}

function handleDragOver(e) {
    e.preventDefault();
    return false;
}

function handleDragEnter(e) {
    addClass(this, 'over');
}

function handleDragLeave(e) {
    removeClass(this, 'over');
}

function handleDrop(e) {
    e.stopPropagation();
    
    if (dragSrcEl === this) return false;

    if (canSwap(dragSrcEl, this)) {
        swapCells(dragSrcEl, this);
        checkGameSuccess();
    } else if (canSwipe(dragSrcEl, this)) {
        swipeCells(dragSrcEl, this);
        checkGameSuccess();
    }

    return false;
}

function handleDragEnd(e) {
    Array.from(document.getElementsByClassName("cell")).forEach(cell => {
        removeClass(cell, 'over');
        removeClass(cell, 'dragging');
    });
}

// Helper Functions
function canSwap(from, to) {
    const fromAttr = getCellAttrs(from);
    const toAttr = getCellAttrs(to);

    if (toAttr.color !== "white") return false;

    const leftCell = toAttr.x > 0 ? getCellAttrsByCoord(toAttr.y, toAttr.x - 1) : null;
    const rightCell = toAttr.x < 15 ? getCellAttrsByCoord(toAttr.y, toAttr.x + 1) : null;

    return (leftCell && leftCell.color === fromAttr.color && leftCell.value + 1 === fromAttr.value) ||
           (rightCell && rightCell.color === fromAttr.color && rightCell.value - 1 === fromAttr.value);
}

function canSwipe(from, to) {
    const fromAttr = getCellAttrs(from);
    const toAttr = getCellAttrs(to);

    return fromAttr.value === 15 &&
           !toAttr.value &&
           toAttr.y === fromAttr.y &&
           toAttr.x === fromAttr.x + 1 &&
           checkSuitLength(from);
}

function checkSuitLength(cell) {
    let length = 1;
    const attrs = getCellAttrs(cell);
    let x = attrs.x - 1;
    let value = attrs.value - 1;

    while (x > 0) {
        const leftCell = getCellAttrsByCoord(attrs.y, x);
        if (leftCell.color !== attrs.color || leftCell.value !== value) break;
        length++;
        x--;
        value--;
    }

    return length >= (3 + parseInt(level));
}

async function swipeCells(from, to) {
    let empty = to;
    let current = from;
    let currentAttrs = getCellAttrs(current);
    
    while (currentAttrs.x > 0 && 
           currentAttrs.value === getCellAttrs(current).value && 
           currentAttrs.color === getCellAttrs(current).color) {
        
        swapCells(current, empty);
        await sleep(50);
        
        empty = getCellByCoord(currentAttrs.y, currentAttrs.x);
        currentAttrs.x--;
        current = getCellByCoord(currentAttrs.y, currentAttrs.x);
    }
}

function swapCells(cell1, cell2) {
    const temp = {
        color: getColorClass(cell1),
        value: cell1.innerHTML
    };
    
    setCell(`${getColorClass(cell2)}-${cell2.innerHTML}`, 
            getCellAttrs(cell1).x, 
            getCellAttrs(cell1).y);
            
    setCell(`${temp.color}-${temp.value}`, 
            getCellAttrs(cell2).x, 
            getCellAttrs(cell2).y);
}

function checkGameSuccess() {
    let success = true;
    
    // Check right column is empty
    for (let y = 1; y <= 5 && success; y++) {
        if (getColorClass(getCellByCoord(y, 15)) !== "white") {
            success = false;
        }
    }
    
    // Check sequences
    if (success) {
        for (let y = 1; y <= 5 && success; y++) {
            const firstCell = getCellAttrsByCoord(y, 0);
            let expectedValue = firstCell.value + 1;
            const color = firstCell.color;
            
            for (let x = 1; x < 15 && success; x++) {
                const cell = getCellAttrsByCoord(y, x);
                if (cell.color !== color || cell.value !== expectedValue) {
                    success = false;
                    break;
                }
                expectedValue++;
            }
        }
    }
    
    if (success) {
        alert("¡Felicidades! ¡Has ganado!");
    }
}

// Utility functions
function getCellByCoord(y, x) {
    return document.getElementById(`${y}.${x}`);
}

function getCellAttrsByCoord(y, x) {
    return getCellAttrsById(`${y}.${x}`);
}

function getCellAttrsById(id) {
    return getCellAttrs(document.getElementById(id));
}

function getCellAttrs(cell) {
    const [y, x] = cell.id.split(".");
    return {
        id: cell.id,
        color: getColorClass(cell),
        value: cell.innerHTML ? parseInt(cell.innerHTML) : "",
        y: parseInt(y),
        x: parseInt(x)
    };
}

function getColorClass(cell) {
    return cell.className.split(" ")
                .find(cls => cls.startsWith("color-"))
                ?.replace("color-", "") || "";
}

function setCell(value, x, y) {
    const cell = getCellByCoord(y, x);
    const [color, number] = value.split("-");
    cell.innerHTML = number || "";
    cell.className = `cell color-${color}`;
}

function random() {
    const x = Math.sin(seed++) * 10000;
    return x - Math.floor(x);
}

function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function addClass(el, className) {
    if (!el.className.includes(className)) {
        el.className += ` ${className}`;
    }
}

function removeClass(el, className) {
    el.className = el.className.replace(new RegExp(`\\b${className}\\b`, 'g'), '').trim();
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function displayPanel(panelId) {
    const resumeBox = document.getElementById("resumeButtonId");
    resumeBox.style.display = isCurrentGame ? "block" : "none";
    
    const panels = {
        initBox: document.getElementById("initBox"),
        newGamePanel: document.getElementById("newGamePanel"),
        board: document.getElementById("board")
    };
    
    Object.values(panels).forEach(panel => panel.style.display = "none");
    
    switch(panelId) {
        case 1: panels.initBox.style.display = "inline-block"; break;
        case 2: panels.newGamePanel.style.display = "inline-block"; break;
        case 3: panels.board.style.display = "inline-block"; break;
    }
}