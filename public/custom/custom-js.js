
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
	      	if (inputFilter(this.value)) {
	        	this.oldValue = this.value;
	        	this.oldSelectionStart = this.selectionStart;
	        	this.oldSelectionEnd = this.selectionEnd;
	      	} else if (this.hasOwnProperty("oldValue")) {
	        	this.value = this.oldValue;
	        	this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
	      	} else {
	        	this.value = "";
	      	}
    	});
  	});
}

// setInputFilter(document.getElementsByClassName("input-number"), function(value) {
//   return /^-?\d*$/.test(value); });

// setInputFilter(document.getElementsByClassName("input-postive-number"), function(value) {
//   return /^\d*$/.test(value); });

// setInputFilter(document.getElementsByClassName("input-limit-number"), function(value) {
//   return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500); });

// setInputFilter(document.getElementsByClassName("input-currency-decimal"), function(value) {
//   return /^-?\d*[.,]?\d*$/.test(value); });

// console.log(document.getElementById("input-currency"));

var inputNumber = document.getElementsByClassName("input-number");

var inputNumberMaximum = document.getElementsByClassName("input-number-maximum");

var inputCurrency = document.getElementsByClassName("input-currency-old");

$.each(inputNumber, function(key, value){
	setInputFilter(value, function(value) { return /^-?\d*$/.test(value); });
});

$.each(inputNumberMaximum, function(key, value){
	maxNumber = Number($(value).data('max'));
	setInputFilter(value, function(value) { return /^\d*$/.test(value) && (value === "" || parseInt(value) <= maxNumber); });
});

$.each(inputCurrency, function(key, value){
	setInputFilter(value, function(value) { return /^-?\d*[.,]?\d{0,2}$/.test(value); });
});

// setInputFilter(document.getElementsByClassName("input-currency"), function(value) {
  // return /^-?\d*[.,]?\d{0,2}$/.test(value); });

// setInputFilter(document.getElementsByClassName("input-letters"), function(value) {
//   return /^[a-z]*$/i.test(value); });

// setInputFilter(document.getElementByClassName("input-hexadecimal"), function(value) {
//   return /^[0-9a-f]*$/i.test(value); });

/* New Currency Format as of 07-29-2020 */
$(".input-currency").on({
    input: function() {
      	formatCurrency($(this));
    },
    blur: function() { 
      	formatCurrency($(this), "blur");
    },
});

function inputNumberFormat(value) {
    // format number 1000000 to 1,234,567
    return setInputFilter(value, function(value) { return /^-?\d*$/.test(value); });
}

function formatNumber(value) {
  	// format number 1000000 to 1,234,567
  	return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur) {

	var add_caret;
	// appends $ to value, validates decimal side
  	// and puts cursor back in right position.
  	// get input value
  	var input_val = input.val();

  	// don't validate empty input
  	if($.trim(input_val) === ""){ 
  		return input.val('0.00');
  	}
  
  	// original length
  	var original_len = input_val.length;

  	// initial caret position 
  	var caret_pos = input.prop("selectionStart");

  	if (input_val.match(/\./g).length > 1) {
  		var caret_dot_pos = 1;
  	} else {
  		var caret_dot_pos = 0;
  	}
  	
		// // check for decimal
		if (input_val.indexOf(".") >= 0) {
	    // get position of first decimal
	    // this prevents multiple decimals from
	    // being entered
	    var decimal_pos = input_val.indexOf(".");

	    // split number by decimal point
	    var left_side = input_val.substring(0, decimal_pos);

	    var right_side = input_val.substring(decimal_pos);

	    // add commas to left side of dot
	    left_side = formatNumber(left_side);

	    // add commas to right side of dot
	    right_side = formatNumber(right_side);
    
	    // On blur make sure 2 numbers after decimal
	    if (blur === "blur") {
	      	right_side += "00";
	    }

	    if(right_side.length >= 3) {
	    	add_caret = 1;
	    } else {
	    	add_caret = 0;
	    }

	    // Limit decimal to only 2 digits
	    right_side = right_side.substring(0, 2);
	    // join number by .
	    input_val = "" + left_side + "." + right_side;

  	} else {
	    // no decimal entered
	    // add commas to number
	    // remove all non-digits
	    input_val = formatNumber(input_val);
	    input_val = "" + input_val;
	    // final formatting
	    if (blur === "blur") {
	      	input_val += ".00";
    	}
  	}

		// send updated string to input
		input.val(input_val);
  	// put caret back in the right position
  	var updated_len = input_val.length;

  	caret_pos = updated_len - original_len + caret_pos + add_caret + caret_dot_pos;

  	input[0].setSelectionRange(caret_pos, caret_pos);

}

function togglePassword(event) {
  	var x = document.getElementById(event);
  	if (x.type === "password") {
    	x.type = "text";
  	} else {
  	  	x.type = "password";
  	}
}

function proDropDownFunction(event) {
  	document.getElementById(event).classList.toggle("pro-show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  	if (!event.target.matches('.pro-dropbtn')) {
    	var dropdowns = document.getElementsByClassName("pro-dropdown-content"); var i;
    	for (i = 0; i < dropdowns.length; i++) {
      		var openDropdown = dropdowns[i];
      		if (openDropdown.classList.contains('pro-show')) {
        		openDropdown.classList.remove('pro-show');
      		}
    	}
  	}
}

