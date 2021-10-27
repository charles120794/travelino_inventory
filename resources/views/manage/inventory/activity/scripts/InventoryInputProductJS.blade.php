@push('scripts')

<script type="text/javascript">

	function autocomplete(inp) 
	{
	    /*the autocomplete function takes two arguments,
	    the text field element and an array of possible autocompleted values:*/
	    var currentFocus;
	    /*execute a function when someone writes in the text field:*/
	    inp.on('input', function(e) {

	        if($('input[name="customer_id"]').val().trim() == "") {

	            alert('Please select a customer');

	            $(this).val("");
	            e.preventDefault(); 
	        }

	        var a, b, i, val = $(this).val();
	        /*close any already open lists of autocompleted values*/
	        closeAllLists();

	        if (!val) { 
	            e.preventDefault(); 
	        }

	        currentFocus = -1;
	        /*create a DIV element that will contain the items (values):*/
	        a = document.createElement("DIV");
	        a.setAttribute('id', this.id + '_autocomplete_list');
	        a.setAttribute('class', 'autocomplete-items');
	        /*append the DIV element as a child of the autocomplete container:*/
	        this.parentNode.appendChild(a);
	        /*for each item in the array...*/
	        $.ajax({
	            type : 'get',
	            url : '{{ route('inventory.route',['path' => $path, 'action' => 'cashier-retrieve-product-json', 'id' => str_random(30)]) }}',
	            data : {page: 1, search : inp.val()},
	            dataType : 'json',
	            success : function(data){

	                for (i = 0; i < data.length; i++) {
	                    
	                    /*check if the item starts with the same letters as the text field value:*/
	                    let text_code = data[i].item_code;
	                    let text_desc = data[i].item_description;
	                        
	                    let matched_searc = new RegExp(inp.val(),'i');

	                    let matching_code = text_code.match(matched_searc); 
	                    let matching_desc = text_desc.match(matched_searc); 
	                        
	                    let searched_code = text_code.replace(matching_code, '<span style="background-color: yellow;">' + matching_code + '</span>');
	                    let searched_desc = text_desc.replace(matching_desc, '<span style="background-color: yellow;">' + matching_desc + '</span>');
	                        
	                    // var searched_word = searched_code + ' ' + searched_desc;

	                    // console.log(searched_code + ' ' + searched_desc);

	                    // var searched_start = searched_word.search(inp.val().toUpperCase());

	                    b = document.createElement("DIV");
	                    // b.innerHTML  = searched_word.substr(0,searched_start);
	                    b.innerHTML  = searched_code + ' ' + searched_desc;
	                    // b.innerHTML += "<strong>" + searched_word.substr(searched_start, val.length) + "</strong>";
	                    // b.innerHTML += 'Hello';

	                    // b.innerHTML += searched_word.substr((searched_start + val.length));
	                    /*insert a input field that will hold the current array item's value:*/
	                    b.innerHTML += "<input type='hidden' name='input_selected_item' value='" + searched_code + ' ' + searched_desc + "'>";
	                    b.innerHTML += "<input type='hidden' name='input_selected_item_code' value='" + data[i].item_code + "'>";
	                  
	                    b.setAttribute('class','input-item-result');

	                    b.setAttribute('onClick', 'return create_customer_basket_item("' + data[i].item_id_encrypt + '", 1)');
	                    // execute a function when someone clicks on the item value (DIV element):
	                    b.addEventListener("click", function(e) {
	                        /*insert the value for the autocomplete text field:*/
	                        // console.log()
	                        inp.val(text_code + ' ' + text_desc);

	                        inp.focus().select();
	                        // inp.value = this.getElementsByTagName("input")[0].value;
	                        // close the list of autocompleted values,
	                        // (or any other open lists of autocompleted values:
	                        closeAllLists();

	                    });

	                    a.appendChild(b);

	                }

	                if(data.length == 1) {
	                    var inputed = inp.val();
	                    var searche = $('input[name="input_selected_item_code"]').val();
	                    if(inputed.length === searche.length) {
	                        $('.input-item-result')[0].click();
	                    }
	                }

	                if(data.length == 0) {
	                    b = document.createElement("DIV");
	                    b.setAttribute('class','no-item-result')
	                    b.innerHTML += "<strong class='no-item-result-text'> No result's found! </strong>";
	                    a.appendChild(b);
	                }
	            }
	        });
	    });

	    /* execute a function presses a key on the keyboard:*/
	    inp.on('keydown', function(e) {

	        var x = $('#input_item_product_autocomplete_list div');

	        if (e.keyCode == 40) {
	            /*If the arrow DOWN key is pressed,
	            increase the currentFocus variable:*/
	            currentFocus++;
	            /*and and make the current item more visible:*/
	            addActive(x);
	        } else if (e.keyCode == 38) { //up
	            /*If the arrow UP key is pressed,
	            divecrease the currentFocus variable:*/
	            currentFocus--;
	            /*and and make the current item more visible:*/
	            addActive(x);
	        } else if (e.keyCode == 13) {
	            /*If the ENTER key is pressed, prevent the form from being submitted,*/
	            e.preventDefault();
	            
	            if (currentFocus > -1) {
	                /*and simulate a click on the "active" item:*/
	                if (x) x[currentFocus].click();
	            }
	        }
	    });

	    function addActive(x) {
	        /*a function to classify an item as "active":*/
	        if (!x) return false;
	        /*start by removing the "active" class on all items:*/
	        removeActive(x);
	        if (currentFocus >= x.length) currentFocus = 0;
	        if (currentFocus < 0) currentFocus = (x.length - 1);
	        /*add class "autocomplete-active":*/
	        x[currentFocus].classList.add('autocomplete-active');
	    }

	    function removeActive(x) {
	        /*a function to remove the "active" class from all autocomplete items:*/
	        for (var i = 0; i < x.length; i++) {
	            x[i].classList.remove('autocomplete-active');
	        }
	    }

	    function closeAllLists(elmnt) {
	        /*close all autocomplete lists in the document,
	        except the one passed as an argument:*/
	        var div = $('.autocomplete-items');
	        
	        for (var i = 0; i < div.length; i++) {
	            if (div[i] != elmnt) {
	                $(div[i]).remove();
	            }
	            // if (elmnt != x[i] && elmnt != inp) {
	            //     x[i].parentNode.removeChild(x[i]);
	            // }
	        }
	    }
	    /*execute a function when someone clicks in the document:*/
	    $(document).on('click', function (e) {
	        closeAllLists();
	    });
	}

</script>

@endpush