$(document).ready(function(){
	//confirm all destroys
	$('form').submit(function(event){
		var method = $(this).children(':hidden[name=_method]').val();
		if ($.type(method) !== 'undefined' && method == 'DELETE'){
			if(!confirm("Are you Sure?")){
				event.preventDefault();
			}
		}
	});


	






// -------------------- checkbox change event ---------------------

$( ":checkbox" ).change(function() {

    if(this.checked)
    {
        var value = 1;	 
		var id = this.id;
	
    }else{
        var value = 0;	 
		var id = this.id;
    }
    	// alert(value+' '+id);

// var id = 12;
// var sid = 13;




	$.ajax({
	    method: 'POST', // Type of response and matches what we said in the route
	    url: '/customers/ajaxupdate/'+id+'/'+value,    // This is the url we gave in the route id='+id+'&value='+value,
	    data: "",//{'id' : id}, //{'value':value,'id' : id }, // a JSON object to send back
	    success: function(response){ // What to do if we succeed
	        console.log(response); 
	    },
	    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
	        console.log(JSON.stringify(jqXHR));
	        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
	    }
	}).done(function(){
        // alert("success");
    });
           
});




}); // end of doc ready





