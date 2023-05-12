const form = document.querySelector('form');

form.addEventListener('submit', e => {
	e.preventDefault();
	const username = document.getElementById('username').value.trim();
	const password = document.getElementById('password').value.trim();

	if (username === '' || password === '') {
		alert('Please fill in all fields');
		return false;
	}

	const xhr = new XMLHttpRequest();

	xhr.open('POST', 'login.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		if (xhr.status === 200 && xhr.responseText === 'success') {
			window.location.href = 'dashboard.php';
		} else {
			alert('Invalid login credentials');
		}
	}
	xhr.send(`username=${username}&password=${password}`);
});
