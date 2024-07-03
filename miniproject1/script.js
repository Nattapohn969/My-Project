let runningTotal = 0;
let buffer = "0";
let previousOperator;

const screen = document.querySelector('.screen');

function buttonClick(value) {
    if (isNaN(value)) {
        handleSymbol(value);
    } else {
        handleNumber(value);
    }
    screen.innerText = buffer;
}

function handleSymbol(symbol) {
    switch (symbol) {
        case 'C':
            buffer = '0';
            runningTotal = 0;
            previousOperator = null;
            break;
        case '=':
        case '&equals;':
            if (previousOperator === null) {
                return;
            }
            flushOperation(parseInt(buffer));
            previousOperator = null;
            buffer = runningTotal.toString();
            runningTotal = 0;
            break;
        case '←':
        case '&larr;':
            if (buffer.length === 1) {
                buffer = '0';
            } else {
                buffer = buffer.slice(0, -1);
            }
            break;
        case '+':
        case '&plus;':
        case '-':
        case '&minus;':
        case '×':
        case '&times;':
        case '÷':
        case '&divide;':
            handleMath(symbol);
            break;
    }
}

function handleMath(symbol) {
    if (buffer === '0') {
        return;
    }

    const intBuffer = parseInt(buffer);

    if (runningTotal === 0) {
        runningTotal = intBuffer;
    } else {
        flushOperation(intBuffer);
    }
    previousOperator = symbol;
    buffer = '0';
}

function flushOperation(intBuffer) {
    switch (previousOperator) {
        case '+':
        case '&plus;':
            runningTotal += intBuffer;
            break;
        case '-':
        case '&minus;':
            runningTotal -= intBuffer;
            break;
        case '×':
        case '&times;':
            runningTotal *= intBuffer;
            break;
        case '÷':
        case '&divide;':
            if (intBuffer === 0) {
                alert("Error: Division by zero");
                return;
            }
            runningTotal /= intBuffer;
            break;
    }
}

function handleNumber(numberString) {
    if (buffer === "0") {
       
        if (numberString === "0") {
            return;
        }
        buffer = numberString;
    } else {
        buffer += numberString;
    }
}

function init() {
    document.querySelectorAll('.cal-but').forEach(button => {
        button.addEventListener('click', function(event) {
            buttonClick(event.target.innerText.trim());
        });
    });
}

init();
