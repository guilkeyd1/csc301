// toggle display of drop down on button click
function expand() {
	document.getElementById("drop_menu").classList.toggle("show");
}
// toggle off display of drop down on outside click
window.onclick = function(e) {
	if (!e.target.matches('.open')) {
		var drop_menu = document.getElementById("drop_menu");
		if (drop_menu.classList.contains('show')) {
			drop_menu.classList.remove('show');
		}
	}
}