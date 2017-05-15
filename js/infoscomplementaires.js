$(document).ready(function(){

	$("#btnajoutcompetence").click(function(){

		$.ajax({
                url: 'EmployeController.php',
                type:'POST',
                data:
                {
                    fonction:'ajoutInfos',
                },
                success: function(data)
                {
                    alert(data);
                }
            });

	});

});