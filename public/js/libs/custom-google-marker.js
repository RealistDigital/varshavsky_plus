function CustomMarker(lat,lng,map,args) {
	latlng=new google.maps.LatLng(lat,lng);
	this.latlng = latlng;
	this.mapVar = map;
	this.args = args;
	this.setMap(map);
	this.lat=lat;
	this.lng=lng;
	
	google.maps.event.addDomListener(map,'drag',clear_show);
	//google.maps.event.addDomListener(map,'idle',clear_show);
	google.maps.event.addDomListener(map,'zoom_changed',clear_show);
	//google.maps.event.addDomListener(map,'click',clear_show);
}

function clear_show(){
	$('body').find('.map-marker.show').removeClass('show');
}

CustomMarker.prototype = new google.maps.OverlayView();
CustomMarker.prototype.draw = function() {
	
	var self = this;
	var div = this.div;

	if (!div) {
	
		div = this.div = document.createElement('div');
		div.className = 'marker_null'+(self.args.class ? ' '+self.args.class : '');

		if(self.args.class=='map-marker' || self.args.class=='map-marker orleft'){

			div.setAttribute('data-tm',self.args.type_marker);
			
		//if (!device.desktop()) {

			
			google.maps.event.addDomListener(div,'click',function(event){

				//$('body').find('.map-marker.show').removeClass('show');

				if($(this).hasClass('show')){
					$(this).removeClass('show');
				} else {
					if(!$(event.target).is('.content,.content *')){
						$(this).addClass('show').siblings().removeClass('show');
					}
				}
				
			});
			
	   /*//	} else {

		   	google.maps.event.addDomListener(div,'mouseover',function(event){
				if(!$(event.target).is('.content,.content *')){
					$(this).addClass('show').siblings().removeClass('show');
				}
			});

		   	google.maps.event.addDomListener(div,'mouseout',function() {
				$(this).removeClass('show');
			});
		}*/
		
	}
		
		
		var panes=this.getPanes();
		panes.overlayImage.appendChild(div);
	}


	var point=this.getProjection().fromLatLngToDivPixel(this.latlng);

	if(point){
		var width_offset  = (self.args.class=='map-marker' ? 0 : 0);
		var height_offset = (self.args.class=='map-marker' ? 0 : 0);

		div.style.left=(point.x-width_offset)+'px';
		div.style.top=(point.y-height_offset)+'px';
	}
};

CustomMarker.prototype.remove=function(){if(this.div){this.div.parentNode.removeChild(this.div);this.div=null}};
CustomMarker.prototype.getPosition=function(){return this.latlng};