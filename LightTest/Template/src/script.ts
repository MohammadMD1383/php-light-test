const collapseButtons = document.querySelectorAll(".title > span");
collapseButtons.forEach((btn: HTMLSpanElement) => {
	btn.addEventListener("click", () => {
		const contentBox = btn.parentNode!.parentNode!.querySelector(".content") as HTMLElement;
		if (btn.classList.contains("collapsed")) {
			contentBox.style.height = `${contentBox.scrollHeight}px`;
		} else {
			contentBox.style.height = "0";
		}
		btn.classList.toggle("collapsed");
	});
});

const infoProvider = document.createElement("div");
infoProvider.id = "info-provider";
document.body.appendChild(infoProvider);

const infoButtons = document.querySelectorAll(".info, td.icon[data-icon='f']");
infoButtons.forEach((btn: HTMLElement) => {
	let canMove = false;
	btn.addEventListener("mouseover", () => {
		canMove = true;
		infoProvider.innerHTML = btn.dataset["info"]!;
		infoProvider.style.opacity = "1";
	});
	btn.addEventListener("mouseout", () => {
		canMove = false;
		infoProvider.style.opacity = "0";
		infoProvider.scrollTop = 0;
	});
	btn.addEventListener("mousemove", (e) => {
		const clientRect = infoProvider.getBoundingClientRect();
		const screenHeight = document.documentElement.clientHeight;

		let top = e.y - clientRect.height / 2;
		let left = e.x;
		if (btn.classList.contains("icon")) left += 15;
		else left -= clientRect.width + 15;

		const down = e.y + clientRect.height / 2;
		const up = e.y - clientRect.height / 2;

		if (down > screenHeight) top -= down - screenHeight;
		if (up < 0) top += -up;

		infoProvider.style.top = `${top}px`;
		infoProvider.style.left = `${left}px`;
	});
	btn.addEventListener("wheel", (e) => {
		e.preventDefault();
		infoProvider.scrollTop += e.deltaY / 10;
	});
});
