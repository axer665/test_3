$(document).ready(function(){
	$('#add_fruit').on('click', function(){
		$('#fruits_message').text("");
		if ($(this).attr('data-trigger') == "add"){ //аттрибут data-trigger
			$('#block_button').before("<tr id='new_fruit__line'> <td> <input type='text' class='new_fruit__text' id='new_fruit__name' /> </td> <td> <input type='number' class='new_fruit__text' id='new_fruit__weight' /> </td> </tr>");
			$(this).attr('data-trigger', 'submit');
		} else {
			$.ajax({
				url: '/actions/main.php',
				type: 'POST',
				data: {
					command : 'add_fruit',
					name : $('#new_fruit__name').val(),
					weight : $('#new_fruit__weight').val()
				},
				error: function( data ) {
					console.log( data )
				},
				success: function( data ) {
					console.log(data);
					if (data == 1){
						$('#add_fruit').attr('data-trigger', 'add');
						if ($('#new_fruit__weight').val() >= 150){
							$('#fruit_table tr:nth-last-child(2)').after('<tr><td>'+$('#new_fruit__name').val()+'</td><td>'+$('#new_fruit__weight').val()+'</td></tr>');
							$('#fruits_message').text("Ваш фрукт успешно добавлен в коллекцию.");
						} else {
							$('#fruits_message').text("Ваш фрукт добавлен в коллекцию, но, к сожалению, мы не можем его показать... он слишком мало весит =(")
						}
						$('#new_fruit__line').remove();
					} else {
						$('#fruits_message').text("Проверьте, пожалуйста, правильно ли указано название фрукта и его вес.");
					}
				}
			});
		}
	});
	
});