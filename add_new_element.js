count_of_added_elements = 0;
function add_new_author(elem){
	count_of_added_elements++;
	
	new_elem = document.createElement('input');
	new_elem.setAttribute('type','text');
	new_elem.setAttribute('name','author' + count_of_added_elements);
	document.getElementById('authors').appendChild(document.createElement('br'));
	document.getElementById('authors').appendChild(new_elem);
}

function del_new_author(){
	if (count_of_added_elements > 0){
		elem = document.getElementById('authors');
		elem.removeChild(elem.lastChild);
		elem.removeChild(elem.lastChild);
		count_of_added_elements--;
	}
}