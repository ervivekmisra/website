
$(document).ready(function(){
	$('#regform').submit(function(e){
		e.preventDefault();
		$data=$(this).serialize();
		$.ajax({
			method:'POST',
			url:'register',
			data:$data,
			success:function(data){
				console.log(data);
			},
			error:function(result){
				console.log(result);
			}
		});
	});
});

