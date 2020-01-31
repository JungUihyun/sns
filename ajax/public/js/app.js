let start = 0;  // 불러와야할 데이터 시작 번호

function drawData(list) {
	let box = document.querySelector(".list");

	list.forEach(x => {
		let div = document.createElement("div");
		div.classList.add("item");
		div.innerHTML = `<span class="id">${x.id}</span>
						 <span class="title">${x.title}</span>
						 <span class="writer">${x.writer}</span>`;
		box.appendChild(div);
		setTimeout(()=>{
			div.classList.add("added");
		}, 100 * (idx + 1));
	});
}

function getData(no){
	let req = new XMLHttpRequest();

	let loader = document.querySelector(".loader");
	loader.style.display = "flex";
	let startTime = new Date();

	req.addEventListener("readystatechange", (e) => {
		if(req.readyState == req.DONE) {
			let json = JSON.parse(req.responseText);
			start += json.length;
			let endTime = new Date();
			let delta = endTime - startTime;

			if( delta > 1000 ) {
				loader.style.display = "none";
				drawData(json);
			} else {
				setTimeout(()=>{
					loader.style.display = "none";
					drawData(json);
			}, 1000);
			}
		}
	});

	req.open("GET", "/ajax/load?start=" + no);
	req.send();
}

window.addEventListener("load", () => {
	getData(0);

	let btn = document.querySelector("#load");
	btn.addEventListener("click", ()=>{
		getData(start);
	});
});