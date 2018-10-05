//*****Get functions / vars*****\\
const getWeek = () => {
	let datum = new Date();
	let date = new Date(Date.UTC(datum.getFullYear(), datum.getMonth(), datum.getDate()));
	date.setUTCDate(date.getUTCDate() + 4 - (date.getUTCDay()||7));
	var yearStart = new Date(Date.UTC(date.getUTCFullYear(),0,1));
	var weekNo = Math.ceil(( ( (date - yearStart) / 86400000) + 1)/7);
	return weekNo;
}



//*****Listen to events*****\\
window.addEventListener("load" , () =>	{
	if (sessionStorage.getItem('dagchanged') === null) {
		dag();
	} else {
		getDagValue();
	}
	if (sessionStorage.getItem('weekchanged') === null) {
		week();
	} else {
		getWeekValue();	
	}
	if (sessionStorage.getItem('yearchanged') === null) {
		year();
	} else {
		getYearValue();
	}
})
document.querySelector(".dag").addEventListener("change" , () => {
	sessionStorage.setItem('dagchanged', true);
	dagValue();
})
document.querySelector(".week").addEventListener("change" , () => {
	sessionStorage.setItem('weekchanged', true);
	weekValue();
})
document.querySelector(".jaar").addEventListener("change" , () => {
	sessionStorage.setItem('yearchanged', true);
	yearValue();
})

//****Functions*****\\
//dag functies\\
const dag = () => {
	let dag = new Date().getDay();
	dag -= 1;
	selectedDag = document.querySelector(".dag").options[dag].text;
	document.querySelector(".dag").value = selectedDag;
	console.log(selectedDag);
}

const dagValue = () => {
	let value = document.querySelector(".dag").value;
	sessionStorage.setItem('dagvalue', value);
}

const getDagValue = () => {
	document.querySelector(".dag").value = sessionStorage.getItem('dagvalue');
}

//week functies\\
const week = () => {
	let obj = document.querySelector(".week");
	let weeknummer = getWeek()
	console.log(weeknummer);
	obj.value = weeknummer;
	sessionStorage.setItem('weekvalue', weeknummer);
}

const weekValue = () => {
	let value = document.querySelector(".week").value;
	sessionStorage.setItem('weekvalue', value);
}

const getWeekValue = () => {
	document.querySelector(".week").value = sessionStorage.getItem('weekvalue');
}

//jaar functies\\
const year = () => {
	let obj = document.querySelector(".jaar");
	let yearnumber = new Date().getFullYear();
	console.log(yearnumber);
	obj.value = yearnumber;
	sessionStorage.setItem('jaarvalue', yearnumber);
}

const yearValue = () => {
	let value = document.querySelector(".jaar").value;
	sessionStorage.setItem('jaarvalue', value);
}

const getYearValue = () => {
	document.querySelector(".jaar").value = sessionStorage.getItem('jaarvalue');
}