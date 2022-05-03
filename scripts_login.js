function login(){
	let log = $('#login').val()
	let pas = $('#password').val()
	
	$.get('authoriza.php', {login:log, password:pas}, function(data){
		let otvet = JSON.parse(data)
		
		if ('error' in otvet) {
			alert(otvet['error']['text'])
		}
		else if ('response' in otvet) {
			//такой пользователь есть
			if (otvet['response'].length == 1) {
				alert('Вы успешно авторизованы!')
			}
			else {
				alert('Такого пользователя нет!')
			}
		}
		else {
			alert('Непредвидимая ошибка')
			console.log(data)
		}
	});
}