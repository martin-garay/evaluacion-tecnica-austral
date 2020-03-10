// Current Weather API Endpoint


//var url = "http://api.weatherstack.com/current?access_key=6903144a6759a7f0d9403e6a59a5562a&query=fetch:ip&units=m&language=es"

//&callback=MY_CALLBACK


(function ( $ ) {
 
    $.fn.WeatherStack = function( options ) {
        
		var defaults = {
            color: "white",
            BackgroundColor: "#556b2f"
        };
        var settings = $.extend(defaults, options );
		var self = this;                         
		
		this.getData = function(callback){
			$.ajax({
			  url: 'http://api.weatherstack.com/current',
			  data: {
			    access_key: '6903144a6759a7f0d9403e6a59a5562a',
			    query: 'fetch:ip'
			  },
			  dataType: 'json',
			  success: callback
			});

		}
		this.render = function(data){
			//console.log(data);
			//console.log(data.current.weather_icons[0]);
			if(data.location || data.current){

				var ubicacion = data.location.name + ', ' + data.location.region + ', ' + data.location.country;

				var eContainer = document.createElement('div'),
					eLocation = document.createElement('div'),
					eData = document.createElement('div'),
					eDataLeftSide = document.createElement('div'),
					eDataRightSide = document.createElement('div'),
					eImg = document.createElement('img'),
					tLocation = document.createTextNode(ubicacion);
					tDataRightSide = document.createTextNode(data.current.temperature+'℃');

				eContainer.className = "weather-container";
				eLocation.className = "weather-location";
				eData.className = "weather-container-data";
				eDataLeftSide.className = "weather-container-data-left";
				eDataRightSide.className = "weather-container-data-right";
				eImg.className = "weather-img";
				
				eImg.src = data.current.weather_icons[0];
				eDataLeftSide.appendChild(tDataRightSide);
				eDataRightSide.appendChild(eImg);				

				eData.appendChild(eDataLeftSide);
				eData.appendChild(eDataRightSide);
											
				eLocation.appendChild(tLocation);
				
				eContainer.appendChild(eLocation);
				eContainer.appendChild(eData);				
				self.append(eContainer);	
			}		
		}
		setInterval(console.log(1),1000);
		setInterval(this.getData(this.render),3000);



		
    };
 
}( jQuery ));


