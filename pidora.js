var PIDORA = (function ($, Mousetrap, PIDORA) {

var control = function (command) {
	$.post("api.php", {control: command});
};

var initializeStationSelect = function () {
	$.getJSON("stations.php", function(stations) {
		$.each(stations, function(key, value) {
			$('#station').append($("<option></option>")
			.attr("value",key)
			.text(value));
	   	});
	        $.getJSON("station.php", function(response) {
			if (response.station) {
        	        	$('#station').val(response.station);
				$('#station').selectmenu("refresh");
			}
        	});
	});
	$('#station').on('change', function() {
  		control(this.value); // or $(this).val()
	});
};

var currentSong = {};

var songRefresh = function () {
	window.setInterval(function(){
	   $.getJSON("song.php", function(newSong) {
	      if (newSong.title !== "" && currentSong.coverart !== newSong.coverart) {
		  	currentSong = newSong;         
		  	$('#coverArt').fadeOut('slow', function(){$(this).attr("src", newSong.coverart).fadeIn('slow');});
		  	$('#title').html(newSong.title);
		  	$('#album').html(newSong.album);
		  	$('#artist').html(newSong.artist);
	      } 
	      if (newSong.love === "1" && !$('#loved').is(':visible')) {
		  	$('#loved').fadeIn('slow');
		  } else if (newSong.love !== "1" && $('#loved').is(':visible')) {
		  	$('#loved').hide();
		  }
	   });
	}, 3000);
};

var checkMessages = function () {
	window.setInterval(function(){
	   $.getJSON("message.php", function(response) {
	      if (response.message !== "") {
		  	$('#msg').fadeIn('slow', function(){$(this).html(response.message).fadeOut(5000);});
	      }
	   });
	}, 3000);
};

var initializeKeyBindings = function () { 
	Mousetrap.bind(['p', 'space'], function() { control("p"); });
	Mousetrap.bind('n', function() { control("n"); });
	Mousetrap.bind('l', function() { control("+"); });
	Mousetrap.bind('b', function() { control("-"); });
	Mousetrap.bind('t', function() { control("t"); });
	Mousetrap.bind('+', function() { control(")"); });
	Mousetrap.bind('-', function() { control("("); });
};

var initializeControls = function () {
	$('input[data-pi-cmd]').on("click", function(event) {
		control($(this).attr("data-pi-cmd"));
	});
};

var initializeDetails = function () {
	$('#explanation-collapsible').bind("expand", function () {
		$.get('details.php', function (data) {
			$('#explanation').html(data);
		});
	});
};

var initialize = function () {
	initializeStationSelect();
	songRefresh();
	initializeKeyBindings();
	initializeControls();
	initializeDetails();
	checkMessages();
};

PIDORA.initialize = initialize;
PIDORA.currentSong = currentSong;

return PIDORA;

}(jQuery, Mousetrap, PIDORA || {}));
