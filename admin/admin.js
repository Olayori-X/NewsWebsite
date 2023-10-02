function showinput(){
    var category = document.getElementById("category");
    var othercategorydiv = document.getElementById("othercategorydiv");
    var othercategory = document.getElementById("othercategory");
    var categoryvalue = category.value;
    if(categoryvalue.toLowerCase() == "others"){
        othercategorydiv.style.display = "block";
        category.setAttribute("name", "others");
        othercategory.setAttribute("name", "category");
        othercategory.setAttribute("required", "required");
    }else{
        othercategorydiv.style.display = "none";
        othercategory.setAttribute("name", "others");
        category.setAttribute("name", "category");
        othercategory.removeAttribute("required");
    }
}

function changecategory(){
    var category = document.getElementById("category");
    var othercategory = document.getElementById("othercategory");
    var categoryvalue = category.value;
    if(othercategory.value != ""){
        document.getElementById("existingcategory").value = othercategory.value;
    }else if(categoryvalue.toLowerCase() != "others"){
        document.getElementById("existingcategory").value = category.value;
    }else{
        console.log("nothing");
    }
}

function autocomplete(input, list) {

	//Add an event listener to compare the input value with all countries
	input.addEventListener('input', function () {
		//Close the existing list if it is open
		closeList();
		//searchInput();

		//If the input is empty, exit the function
		if (!this.value)
			return;

		//Create a suggestions <div> and add it to the element containing the input field
		suggestions = document.createElement('div');
		suggestions.setAttribute('id', 'suggestions');
		this.parentNode.appendChild(suggestions);

		//Iterate through all entries in the list and find matches
		for (let j=0; j < list.length; j++) {

			if (list[j].toUpperCase().includes(this.value.toUpperCase())) {

				//If a match is found, create a suggestion <div> and add it to the suggestions <div>
				suggestion = document.createElement('div');
				suggestion.innerHTML = list[j];
				
				suggestion.addEventListener('click', function () {
					input.value = this.innerHTML;
					closeList();
				});
				suggestion.style.cursor = 'pointer';
				

				suggestions.appendChild(suggestion);
			}
				
		}

	});

	function closeList() {
		let suggestions = document.getElementById('suggestions');
		if (suggestions)
			suggestions.parentNode.removeChild(suggestions);
	}

}