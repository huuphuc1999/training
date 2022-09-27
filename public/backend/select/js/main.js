$(function() {

	$('select[multiple].active.3col').multiselect({
	  columns: 3,
	  placeholder: 'Click here to select',
	  search: true,
	  searchOptions: {
	      'default': 'Search here'
	  },
	  selectAll: true
	});
	

});