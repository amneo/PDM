/**
 * Google Maps (Custom View Tag) for PHPMaker 2019
 * @license (C) 2019 e.World Technology Ltd.
 */
ew.googleMapIndex = 0;
ew.googleMapStyles = [
	[{
		url: ew.IMAGE_FOLDER + "people35.png",
		height: 35,
		width: 35,
		anchor: [16, 0],
		textColor: "#ff00ff",
		textSize: 10
	}, {
		url: ew.IMAGE_FOLDER + "people45.png",
		height: 45,
		width: 45,
		anchor: [24, 0],
		textColor: "#ff0000",
		textSize: 11
	}, {
		url: ew.IMAGE_FOLDER + "people55.png",
		height: 55,
		width: 55,
		anchor: [32, 0],
		textColor: "#ffffff",
		textSize: 12
	}], 
	[{
		url: ew.IMAGE_FOLDER + "conv30.png",
		height: 27,
		width: 30,
		anchor: [3, 0],
		textColor: "#ff00ff",
		textSize: 10
	}, {
		url: ew.IMAGE_FOLDER + "conv40.png",
		height: 36,
		width: 40,
		anchor: [6, 0],
		textColor: "#ff0000",
		textSize: 11
	}, {
		url: ew.IMAGE_FOLDER + "conv50.png",
		width: 50,
		height: 45,
		anchor: [8, 0],
		textSize: 12
	}],
	[{
		url: ew.IMAGE_FOLDER + "heart30.png",
		height: 26,
		width: 30,
		anchor: [4, 0],
		textColor: "#ff00ff",
		textSize: 10
	}, {
		url: ew.IMAGE_FOLDER + "heart40.png",
		height: 35,
		width: 40,
		anchor: [8, 0],
		textColor: "#ff0000",
		textSize: 11
	}, {
		url: ew.IMAGE_FOLDER + "heart50.png",
		width: 50,
		height: 44,
		anchor: [12, 0],
		textSize: 12
	}],
	[{
		url: ew.IMAGE_FOLDER + "pin.png",
		height: 48,
		width: 30,
		anchor: [-18, 0],
		textColor: "#ffffff",
		textSize: 10,
		iconAnchor: [15, 48]
	}]
];

// Show Google map
ew.showGoogleMap = function(map) {
	ew.googleMapIndex++;
	var $ = jQuery, latlng = map["latlng"], id = map["id"], singleMap = map["use_single_map"], typeId, oMap,
		showAllMarkers = map["show_all_markers"], useMarkerClusterer = map["use_marker_clusterer"] && window.MarkerClusterer;
	var _done = function(args) {
		$(document).trigger("map", [$.extend({ "index": ew.googleMapIndex }, map, args || {})]); // Trigger "map" event
		if (ew.googleMapIndex == ew.googleMaps.length) { // Last map done
			for (let i in ew.googleMaps) {
				if ($.isNumber(i))
					continue;
				var oMap = ew.googleMaps[i]; // Single map
				if (oMap["markers"] && !oMap["cluster"]) // Use marker clusterer
					oMap["cluster"] = new MarkerClusterer(oMap["map"], oMap["markers"], oMap["options"]);
				if (oMap["bounds"]) // Fit bounds
					oMap["map"].fitBounds(oMap["bounds"]);
			}
		}
		return true; // Next map
	};
	if (map["inited"]) // Already initiated
		return _done();
	var showAddress = function(id) { // Show original address
		$("#" + id + "[type='text/html']").each(function() {
			$scr = $(this);
			$scr.closest("td").find("span:first").append($scr.html());
		});
	}
	if (!latlng) { // Location not found
		showAddress(map["template_id"]); // Show original value
		if (!singleMap) {
			$("#" + id).css({ width: "", height: "", display: "inline-block" }).html(map["status"]).hide(); // Hide the map
		}
		return _done();
	}
	switch (map["type"].toLowerCase()) {
		case "satellite":
			typeId = google.maps.MapTypeId.SATELLITE; break;
		case "hybrid":
			typeId = google.maps.MapTypeId.HYBRID; break;
		case "terrain":
			typeId = google.maps.MapTypeId.TERRAIN; break;
		default:
			typeId = google.maps.MapTypeId.ROADMAP;
	}
	var mapOptions = { zoom: map["zoom"] || 10, center: latlng, mapTypeId: typeId };
	if (singleMap) { // Single map
		showAddress(map["template_id"]); // Show original value
		if (!ew.googleMaps[id]) {
			var $div = $("<div></div>").attr("id", id).addClass("ew-google-map ew-single-map").height(map["single_map_height"]); // Do not specify width by style
			var $tbl = $(".ew-report-table, .ew-grid, .ew-multi-column-grid").first();
			(map["show_map_on_top"]) ? $div.insertBefore($tbl.first()) : $div.insertAfter($tbl.first());
			ew.googleMaps[id] = { "map": new google.maps.Map($div[0], mapOptions) };
			if (showAllMarkers)
				ew.googleMaps[id]["bounds"] = new google.maps.LatLngBounds();
			if (useMarkerClusterer) {
				ew.googleMaps[id]["markers"] = [];
				ew.googleMaps[id]["options"] = {
					maxZoom: map["cluster_max_zoom"] === -1 ? null : map["cluster_max_zoom"],
					gridSize: map["cluster_grid_size"] === -1 ? null : map["cluster_grid_size"],
					styles: map["cluster_styles"] === -1 ? null : ew.googleMapStyles[map["cluster_styles"]],
					imagePath: ew.IMAGE_FOLDER + "m"
				};
			}
		}
	} else {
		if (!ew.googleMaps[id])
			ew.googleMaps[id] = { "map": new google.maps.Map($("#" + id)[0], mapOptions) };
	}
	oMap = ew.googleMaps[id];
	map["inited"] = true; // Initiated
	var marker = new google.maps.Marker({ // Marker
		position: latlng,
		map: oMap["map"],
		icon: map["icon"] || null,
		title: map["title"] || ""
	});
	map["marker"] = marker;
	if (singleMap && useMarkerClusterer)
		oMap["markers"].push(marker);
	var desc = $.trim(map["description"]);
	if (desc) { // Info window
		var infoWindow = new google.maps.InfoWindow({
			content: desc || ""
		});
		map["infowindow"] = infoWindow;
		google.maps.event.addListener(marker, "click", function() {
			infoWindow.open(oMap["map"], marker);
		});
	}
	if (singleMap && showAllMarkers) // Extend bounds if single map
		oMap["bounds"].extend(latlng);
	return _done(oMap);
}

// Init Google maps
ew.initGoogleMaps = function() {
	var $ = jQuery;
	ew.googleMapIndex = 0; // Reset
	$.each(ew.googleMaps, function(i, map) {
		if (map["inited"]) { // Already initiated
			ew.showGoogleMap(map);
		} else { // Not initiated
			var id = map["id"], address = map["address"], latitude = map["latitude"], longitude = map["longitude"],
				geocoding_delay = map["geocoding_delay"];
			if (address && $.trim(address) != "") {
				$.later(i * geocoding_delay, null, function() { // Set a timer for better performance
					var geocoder = new google.maps.Geocoder();
					geocoder.geocode({"address": address}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							map["latlng"] = results[0].geometry.location;
						} else { // Geocoding not successful
							map["status"] = status;
						}
						ew.showGoogleMap(map);
					});
				});
			} else {
				if (latitude && !isNaN(latitude) && longitude && !isNaN(longitude))
					map["latlng"] = new google.maps.LatLng(latitude, longitude);
				ew.showGoogleMap(map);
			}
		}
	});
}

// Init
jQuery(function($) {
	ew.initGoogleMaps();
	$("#ew-modal-dialog").on("load.ew", ew.initGoogleMaps);
	$(document).on("preview", ew.initGoogleMaps);
});
