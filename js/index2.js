const progressBar = document.querySelector("#progressBar");
let progressWidth = document.querySelector(".progress").offsetWidth;
const len100 = progressBar.offsetWidth;

function addProgress() {
	setTimeout(() => {
		const progress = document.createElement("div");
		progress.classList.add("progress");
		progress.classList.add("progress");
		progressBar.append(progress);
		if (progressWidth < len100 * 0.8) {
			addProgress();
		}
		progressWidth = progressWidth + 24 * 2;
	}, 500);
}

addProgress();
