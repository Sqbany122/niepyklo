document.addEventListener("DOMContentLoaded", function(event) {
	let imageBox = document.querySelectorAll(".imageBox");
	let expandElement = document.createElement("div");
	let expandIco = document.createElement("i");
	expandElement.classList.add("expandImage", "rounded-bottom");
	expandElement.onclick = function (e) {
		let image = e.target.parentNode.querySelector(".obrazek_min");
		image.classList.remove("obrazek_min");
		expandElement.remove();
	}
	expandIco.classList.add("fas", "fa-chevron-down", "fa-2x");
	expandElement.append(expandIco);

    imageBox.forEach(item => {
		if (item.querySelector("img").clientHeight > 1000) {
			item.append(expandElement);
		}
	});
});