var PIDORA = (function ($, PIDORA) {

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
  		$.post("api.php",{control: this.value}); // or $(this).val()
	});
};

var currentSong = {};

var songRefresh = function () {
	window.setInterval(function(){
	   $.getJSON("song.php", function(newSong) {
	      if (newSong.title !== "" && currentSong.coverart !== newSong.coverart) {
		  	currentSong = newSong;         
		  	$('#coverArt').fadeOut('slow', function(){$(this).attr("src", newSong.coverart).fadeIn('slow')});
		  	$('#title').html(newSong.title);
		  	$('#album').html(newSong.album);
		  	$('#artist').html(newSong.artist);
	      }
	   });
	}, 3000);
};

var initializeKeyBindings = function () { 
	Mousetrap.bind(['p', 'space'], function() { $.get("api.php",{control:"p"}); });
	Mousetrap.bind('n', function() { $.get("api.php",{control:"n"}); });
	Mousetrap.bind('l', function() { $.get("api.php",{control:"+"}); });
	Mousetrap.bind('b', function() { $.get("api.php",{control:"-"}); });
	Mousetrap.bind('t', function() { $.get("api.php",{control:"t"}); });
	Mousetrap.bind('+', function() { $.get("api.php",{control:")"}); });
	Mousetrap.bind('-', function() { $.get("api.php",{control:"("}); });
};


var control = function (command) {
	$.post("api.php", {control: command});
};

var initializeControls = function () {
	$('input[pi-cmd]').on("click", function(event) {
		control($(this).attr("pi-cmd"));
	});
};

var initialize = function () {
	initializeStationSelect();
	songRefresh();
	initializeKeyBindings();
	initializeControls();
};

PIDORA.initialize = initialize;
PIDORA.control = control;
PIDORA.currentSong = currentSong;

return PIDORA;

}(jQuery, PIDORA || {}));
