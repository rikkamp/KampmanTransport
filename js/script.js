//*****Get functions / vars*****\\
const getWeek = () => {
	let datum = new Date();
	let date = new Date(Date.UTC(datum.getFullYear(), datum.getMonth(), datum.getDate()));
	date.setUTCDate(date.getUTCDate() + 4 - (date.getUTCDay()||7));
	let yearStart = new Date(Date.UTC(date.getUTCFullYear(),0,1));
	let weekNo = Math.ceil(( ( (date - yearStart) / 86400000) + 1)/7);
	return weekNo;
}
function daysInMonth (month, year) {
    return new Date(year, month, 0).getDate();
}
function getDateOfWeek(w, y) {
    var d = (1 + (w - 1) * 7); // 1st of January + 7 days for each week

    return new Date(y, 0, d);
}
//*****Listen to events*****\\

//click pdf\\

document.querySelector(".pdf").addEventListener("click", () => {
	// console.log(sessionStorage.getItem('weekvalue'));
	// let str = getDateOfWeek(sessionStorage.getItem('weekvalue'), sessionStorage.getItem('jaarvalue'));
	// let dagstr = str.toLocaleString().slice(0, 2);
	// let maandstr = str.toLocaleString().slice(3, 5);
	// let jaarstr = str.toLocaleString().slice(6, 10);
	// let maandnmr = parseFloat(maandstr);
	// let maandnummer = daysInMonth(maandstr, jaarstr);
	// let dagnmr = parseFloat(dagstr);
	// let jaarnmr = parseFloat(jaarstr);
	// let dag2 = "";
	// let jaar2= jaarnmr;
	// dagnmr += 7;
	// if(dagnmr > maandnummer)
	// {
	// 	dag2 = dagnmr - maandnummer;
	// } else {
	// 	dag2 = dagnmr;
	// }
	// if(maandnmr > 12) {
	// 	maandnmr -= 12;
	// 	jaar2 += 1;
	// }
	// let datumdeel2 = str.slice(11, 13);
	// let datum = datumdeel1 + "tmt" + datumdeel2;
	// console.log(dagstr + "/" +maandstr+ "/" +jaarstr+ "tmt" +dag2 +"/"+maandnmr+ "/" +jaar2);
	// window.location.href = "pdf.php?weeknmr=" + sessionStorage.getItem('weekvalue') + "&jaar=" + sessionStorage.getItem('jaarvalue') + "&14datum=" + datum;
})

//load\\
window.addEventListener("load" , () =>	{
	if(document.cookie !== 0) {
		// alert(document.cookie);
	}
	// var dag = sessionStorage.getItem('dagchanged');
	// console.log(dag);
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
const dag = () =>{
	
	let dag = new Date().getDay();
	dag -= 1;
	if (dag === -1) {
		selectedDag = "Zondag";
	} else {
	selectedDag = document.querySelector(".dag").options[dag].text;
	}
	document.querySelector(".dag").value = selectedDag;
	
	console.log(selectedDag);
}

const dagValue = () => {
	let value = document.querySelector(".dag").value;
	sessionStorage.setItem('dagvalue', value);
	document.cookie = value;
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
	// document.cookie = "week="+ value +"; expires=Thu, 18 Dec 2033 12:00:00 UTC; path=/";
}

const getWeekValue = () => {
	document.querySelector(".week").value = sessionStorage.getItem('weekvalue');
	// document.cookie = "dag="+  +"; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";
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
	// document.cookie = "jaar="+ value +"; expires=Thu, 18 Dec 2033 12:00:00 UTC; path=/";
}

const getYearValue = () => {
	document.querySelector(".jaar").value = sessionStorage.getItem('jaarvalue');
}
const pasaan = () => {
	let id = event.target.value;
	let km = document.querySelector(".km"+id).dataset.km;
	let loc = document.querySelector(".loc"+id).dataset.loc;
	let aan = document.querySelector(".aan"+id).dataset.aan;
	let ver = document.querySelector(".ver"+id).dataset.ver;
	let no = document.querySelector(".no"+id).dataset.no;
	console.log();
	document.querySelector(".row"+id).innerHTML = `
	
		<td class='id${id}'>${id}</td>
		<td data-km='${km}' class='km${id}'><input type="text" name="km" value=${km}></td>
		<td data-loc='${loc}' class='loc${id}'><input type="text" name="loc" value=${loc}> </td>
		<td data-aan='${aan}'class='aan${id}'><input type="text" name="aan" value=${aan}> </td>
		<td data-ver='${ver}'class='ver${id}'><input type="text" name="ver" value=${ver}> </td>
		<td data-no='${no}'class='no${id}'><input type="text" name="no" value=${no}></td>
		<input type="hidden" name="id" value="${id}">
		<td><input type="submit" name="edit" value="pasaan"/><button value="${id}" onclick="stop()">x</button></td>
	`
}

const stop = () => {
	let id = event.target.value;
	let km = document.querySelector(".km"+id).dataset.km;
	let loc = document.querySelector(".loc"+id).dataset.loc;
	let aan = document.querySelector(".aan"+id).dataset.aan;
	let ver = document.querySelector(".ver"+id).dataset.ver;
	let no = document.querySelector(".no"+id).dataset.no;
	document.querySelector(".row"+id).innerHTML = `
	
		<td class='id${id}'>${id}</td>
		<td data-km='${km}' class='km${id}'>${km}</td>
		<td data-loc='${loc}' class='loc${id}'>${loc}</td>
		<td data-aan='${aan}'class='aan${id}'>${aan}</td>
		<td data-ver='${ver}'class='ver${id}'>${ver}</td>
		<td data-no='${no}'class='no${id}'>${no}</td>
		<td><button class='aanpas' onclick=pasaan() value='${id}'>aanpas</button></td>
	`
}
