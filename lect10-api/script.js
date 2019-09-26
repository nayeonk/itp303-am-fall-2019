function ajax(endpoint, returnFunction) {

	let xhr = new XMLHttpRequest();
	//.open( Method, Endpoint, Async?)
	xhr.open("GET", endpoint, true);
	xhr.send();

	// We wait for some kind of response from iTunes
	xhr.onreadystatechange = function() {
		console.log(this);
		if(this.readyState == this.DONE) {
			// Received some kind of response from iTunes and it is done
			// If we got a success response back
			if(xhr.status == 200) {
				console.log( xhr.responseText );
				// JSON.parse() - it converts JSON string into JS objects
				console.log( JSON.parse( xhr.responseText ) );

				let iTunesResults = JSON.parse( xhr.responseText );
				// Next thing to do is display the results on the browser
				returnFunction(iTunesResults);
				// displayResults(iTunesResults);
			}
			else {
				// Error
				console.log("AJAX error");
				console.log(xhr.status);
			}

		}

	}

}

function displayResults(results) {

	let tbodyElement = document.querySelector("tbody");

	// Clear the current list of songs
	while( tbodyElement.hasChildNodes() ) {
		tbodyElement.removeChild( tbodyElement.lastChild);
	}

	// Update the result count
	document.querySelector("#num-results").innerHTML = results.resultCount;

	// For every result, create a new <tr>, fill in information in <td>
	for(let i = 0; i < results.results.length; i++) {
		// Create a <tr>
		let rowElement = document.createElement("tr");
		// Create <td> for each information (cover, artist name, etc)
		let cellCover = document.createElement("td");
		let cellArtist = document.createElement("td");
		let cellTrack = document.createElement("td");
		let cellAlbum = document.createElement("td");
		let cellPreview = document.createElement("td");

		// The cover needs an image
		let imgElement = document.createElement("img");
		// Set the source. The source comes from the API results
		imgElement.src = results.results[i].artworkUrl100;
		// Append the image to the cover <td>
		cellCover.appendChild(imgElement);

		console.log(cellCover);

		// Add artist name in the artist <td>
		cellArtist.innerHTML = results.results[i].artistName;
		// Add track name in the track <td>
		cellTrack.innerHTML = results.results[i].trackName;
		// Add album name in the album <td>
		cellAlbum.innerHTML = results.results[i].collectionName;

		// Create audio tag for the preview
		let audioElement = document.createElement("audio");
		audioElement.src = results.results[i].previewUrl;
		audioElement.controls = true;

		// Add <audio> tag to the audio <td>
		cellPreview.appendChild(audioElement);

		// Append all these elements to the <tr>
		rowElement.appendChild(cellCover);
		rowElement.appendChild(cellArtist);
		rowElement.appendChild(cellTrack);
		rowElement.appendChild(cellAlbum);
		rowElement.appendChild(cellPreview);

		// Append the <tr> to the tbody
		document.querySelector("tbody").appendChild(rowElement);

	}

}

document.querySelector("#search-form").onsubmit = function(event) {
	event.preventDefault();

	let searchInput = document.querySelector("#search-id").value.trim();

	let limitInput = document.querySelector("#limit-id").value;

	console.log(searchInput);
	console.log(limitInput);

	// Make a HTTP request (via AJAX) to iTunes API to get music results from them

	let iTunesEndpoint = "https://itunes.apple.com/search?term=" + searchInput;

	// Call the ajax function I created above
	ajax(iTunesEndpoint, displayResults);
	
	console.log("HEYYY");

}









