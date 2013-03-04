
(function() {

    if (!getState('member')) {
		window.location.href = urlConfig.login;
	}

    var watchId;
    var flag=0;
    var coor_lat;
    var coor_long;
    
    
	var map;
	
    function setGeolocation(){
        loadLocation();
    }

    function loadLocation() {
        if(navigator.geolocation) {
            //document.getElementById("status").innerHTML = "HTML5 Geolocation is supported in your browser.";
            watchId = navigator.geolocation.watchPosition(updateLocation,handleLocationError,{ maximumAge:5000});
        }
    }

    function get_point_list(list){
        var point_list = [];
        for (var i = 0; i < list.length; i++) {
            var point = new Point(list[i].x,list[i].y);
            point_list.push(point);
        }
        return point_list;
    }

    function updateLocation(position) {

        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        var accurary = position.coords.accurary;
        if (!latitude || !longitude) {
            $("#status").html("HTML5 Geolocation is supported in your browser, but location is currently not available.");
            return;
        }

        //cache the location choose whether to update the map
        if(flag!=0)
            var distance = haversine(latitude,longitude,coor_lat,coor_long);
        if(flag==0 || distance>getSencitiveDistance()){  
            flag = 1;

            coor_lat = latitude;
            coor_long = longitude;

            post_location(latitude,longitude);
            my_timer = setInterval(function(){
                post_location(latitude,longitude);
            }, 10000);
        
           init_map(latitude,longitude);    
        }
    }
    

    var my_timer;
    function init_map(latitude,longitude){

        var latlng = new google.maps.LatLng(latitude, longitude);
        var myOptions = {
            zoom: 17,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_container"),myOptions);

        google.maps.event.trigger(map, 'resize');

        //show me 
        $('#show_me').click(function(){
            map.panTo(latlng);
        });

        var current = new Point(latitude,longitude);
        var loc_name = 'undefined';
        $('#location_title').html('undefined');
        window.set_loc_id(0);
            //check location{
            //highlight and make mark
            //}
        for (var i = 0; i < window.getPlace().length; i++) {
            loc_name = window.getPlace()[i].name;
            var loc_polygon = window.getPlace()[i].polygon;
            loc_polygon.push(loc_polygon[0]);

            if(inPolygon(current,loc_polygon)){

                $('h3#location_title').html(loc_name);
                //chat room update
                window.set_loc_id(window.getPlace()[i].id);
                
                ///////////////////
                var PolygonCoords = [];
                for (var i = 0; i < loc_polygon.length; i++) {
                    var tmp = new google.maps.LatLng(loc_polygon[i].x, loc_polygon[i].y);
                    PolygonCoords.push(tmp);
                };
                //highlight
                var highlight = new google.maps.Polygon({
                    paths: PolygonCoords,
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.6,
                    strokeWeight: 2,
                    fillColor: "#FF0000",
                    fillOpacity: 0.35
                });
                highlight.setMap(map);
                break;
            }
        }  
        var chatroom = $('#location_title').html();

        chatConnection(chatroom);
        
        $('#chatBtn').click(function(){
            
            if($.trim($("#contentBox").val())){
                var state = getState('member');
                if (!state) {
                    logout();
                }

                startSending();
                var msg = $("#contentBox").val();
                msg = msg.replace(/\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-/g,""); 
                $("#contentBox").val(msg);
                sendChat(chatroom,msg);

                var loc_id = window.get_loc_id();
                var email = state.user;
                var pw = state.pw;
                

                $.ajax({
                    type : 'POST',
                    url : urlConfig.location_msg,
                    headers : {
                        'Authorization' : 'Basic ' + window.btoa(email + ':' + pw)
                    },
                    data:{
                        location_id : loc_id,
                        content : $.trim($("#contentBox").val())
                    },
                    success : function(response) {
                        console.log(response);
                    },
                    error : function(response) {
                        console.log(response);
                    }
                });    
            }
                
        });
        $(window).bind('keypress', function(e) {
            if (e.keyCode == 13) {
                if ($('#contentBox').val().length > 0)
                    var curElement = document.activeElement;
                if (curElement.nodeName == "INPUT")
                    $('#chatBtn').trigger('click');
            }
        });


        $.ajax({
            type : 'GET',
            url : urlConfig.user,
            headers : {
                'Authorization' : 'Basic ' + window.btoa( getState('member').user + ':' + getState('member').pw )
            },
            success : function(response) {
                var result = jQuery.parseJSON(response);
                var data = result;
                var near_people=[];
                $.each(data, function(index,value){
                    var now = new Date().getTime();
                    var a = value.last_location_timestamp.split(/[^0-9]/)
                    //var mydate = Date.parse(value.last_location_timestamp);
                    var mydate=new Date (a[0],a[1]-1,a[2],a[3],a[4],a[5] ).getTime();
                   
                    if(value.geometry!=null&& mydate>0 && now-mydate<90){// && mydate>0 && now-mydate<90 ){
                    
                        var image = new google.maps.MarkerImage(value.profile,null,null,null,
                                    new google.maps.Size(30, 30));
                        var displayName;
                        //console.log(value.email+' '+getState('member').user);
                        if(value.email==(getState('member').user)){
                        	displayName='Me';
                        }else{
                        	displayName=value.name;
                        }
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(parseFloat(value.geometry.x), parseFloat(value.geometry.y)),
                            map: map, 
                            icon: image,
                            email: value.email,
                            title: displayName,
                            content: value.status,
                            pic:value.profile,
                        });
                    
                        attachSecretMessage(marker);

                        if( get_location(value.geometry.x, value.geometry.y).name == loc_name ){
                            near_people.push(value);
                        }

                    }
                });
                window.set_near_peope(near_people);
            },
            error : function(response) {
                console.log('Cannot to login');
                //direct to login
            }
        });





        var infowindow = new google.maps.InfoWindow(
            {
                content:'',
                size: new google.maps.Size(50,50)
            });
        function attachSecretMessage(marker){
            var photo;
            if(marker.email!= getState('member').user){
                photo = '<span >\
                            <a id="go_to_friend" href="#page8" data-theme="">\
                                <div class="hidden">'+marker.email+'</div>\
                                <img src='+ marker.pic +' height="60" width="60" />\
                            </a>\
                        </span>';
            }else{
                photo = '<span >\
                            <a id="go_to_friend" href="#page6" data-theme="">\
                                <div class="hidden">'+marker.email+'</div>\
                                <img src='+marker.pic+' height="60" width="60" />\
                            </a>\
                        </span>';
            }
            
            var message = '<table>\
                        <tr>\
                            <td class="left">\
                                '+photo+'\
                            </td>\
                            <td class="right" >\
                                <div id="name"><b>'+marker.title+'</b> '+haversine(latitude,longitude,marker.position.Xa,marker.position.Ya)+'m'+'\
                               </div>\
                                <div id="other">'+marker.content+'\
                                </div>\
                            </td>\
                        </tr>\
                    </table>';
            
            google.maps.event.addListener(marker,'click',function(event){
                infowindow.setContent(message);
                infowindow.open(map,marker);
                $('a#go_to_friend').click(function(){
                    var friend_email = $(this).children('div')[0].innerHTML;
                    var hashed = md5(friend_email);
                    $.ajax({
                        type : 'GET',
                        url : urlConfig.user+'/email/'+hashed,
                        headers : {
                            'Authorization' : 'Basic ' + window.btoa( getState('member').user + ':' + getState('member').pw  )
                        },
                        success : function(response) {
                            var result = jQuery.parseJSON(response);
                            var data = result[0];
                            var last_loc = get_location(data.geometry.x,data.geometry.y).name;
                            $('#other_profile_last_location').html(last_loc);
                            $('#other_profile_last_location').addClass(data.gender);
                            $('#other_profile').attr('src',data.profile);
                            $('#other_profile_email').text(data.email);
                            $('#other_profile_name').html(data.name);
                            $('#other_profile_name').addClass(data.gender);
                            $('#other_profile_gender').html(data.gender.capitalize());
                            $('#other_profile_gender').addClass(data.gender);
                            $('#other_profile_status').html(data.status);
                            $('#other_profile_status').addClass(data.gender);
                            $('#profile_major').html(data.major);
                            $('#profile_major').addClass(data.gender);
                            $('#profile_hobbies').html(data.hobbies);
                            $('#profile_hobbies').addClass(data.gender);
                        },
                        error : function(response) {
                            console.log('Cannot to login');
                            //direct to login
                        }
                     });

                    $.ajax({
                        type : 'GET',
                        url : urlConfig.follow,
                        headers : {
                            'Authorization' : 'Basic ' + window.btoa(getState('member').user + ':' + getState('member').pw )
                        },
                        success : function(data) {
                            console.log(1);
                            var data = jQuery.parseJSON(data);
                            $('#follow_btn').children('span').children('span').text('Follow');
                            $.each(data, function(index, value) {
                                if(friend_email==value.user_followed){
                                    $('#follow_btn').children('span').children('span').text('Unfollow');
                                }
                            });
                        },
                        error : function(response) {
                            console.log('Cannot to get followed');
                            //direct to login
                        }
                    });
                   
                })
            });

        }
    }



    function post_location(lat,long){

        var point = {x:lat, y:long};
        $.ajax({
            type : 'POST',
            url : urlConfig.post_location,
            headers : {
                'Authorization' : 'Basic ' + window.btoa( getState('member').user + ':' + getState('member').pw  )
            },
            data:point,
            error : function(response) {
                console.log('cannot post location');
                //direct to login
            }
        });
    }

    function getSencitiveDistance(){
        return 20;
    }

    function rad(x){
        return x * Math.PI / 180;
    }

    function haversine(p1_latitude,p1_longtitude,p2_latitude,p2_longtitude){
        var R = 6371*1000;
        var p1 = {
            latitude:p1_latitude,
            longitude:p1_longtitude
        };
        var p2 = {
            latitude:p2_latitude,
            longitude:p2_longtitude
        };
        var dLat  = rad(p2.latitude - p1.latitude)
        var dLong = rad(p2.longitude - p1.longitude)

        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(rad(p1.latitude)) * Math.cos(rad(p2.latitude)) * Math.sin(dLong/2) * Math.sin(dLong/2)
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a))
        var d = R * c
        return Math.round(d)
    }

    function handleLocationError(error){
      switch(error.code){
        case 0:
                updateStatus("There was an error while retrieving your location: " +
                error.message);
        break;
        case 1:
        updateStatus("The user prevented this page from retrieving a location.");
        break;
        case 2:
        updateStatus("The browser was unable to determine your location: " +
                                error.message);
        break;
        case 3:
        updateStatus("The browser timed out before retrieving the location.");
        break;
        }
    }

    function updateStatus(message){
      $("#status").html(message);
    }
    
    window.get_location = function(x,y){
        var result= {
            'name':'undefined',
            'polygon': [],
        };
        for (var i = 0; i < window.getPlace().length; i++) {
            var loc_name = window.getPlace()[i].name;
            var loc_polygon = window.getPlace()[i].polygon;
            loc_polygon.push(loc_polygon[0]);
            var point = new Point(x,y);

            
            if(inPolygon(point,loc_polygon)){
                result['name'] = loc_name;
                result['polygon'] = loc_polygon; 
                break;
            }
            
        }  
        return result;
    }

    // Geometry Class  -----------------------------------------

    function Point( x , y ){
        this.x = x;
        this.y = y;
    }

    Point.prototype.getX = function(){
        return this.x;
    }

    Point.prototype.getY = function(){
        return this.y;
    }

    function Polygon(points){
        this.points = points;
    }

    Polygon.prototype.getPoints = function(){
        return this.points;
    }

    // in polygon algorithm---------------------------------------

    function cross(p, q, r){
        return ( r.x-q.x ) * ( p.y-q.y ) - ( r.y-q.y ) * ( p.x-q.x);
    }

    function angle(a, b, c){   // a is the middle point
        var ux = b.x - a.x, uy = b.y - a.y, vx = c.x - a.x, vy = c.y - a.y;
        return Math.acos( (ux * vx + uy * vy) / Math.sqrt( (ux * ux + uy * uy) * (vx * vx + vy * vy) ) ); 
    }

    
    function inPolygon(point, polygon){   //important !!! the last point must equal to the first point

        //var polygon = polygon.getPoints();
        var eps = 0.0000001;
        if(polygon.length == 0)
            return false;
        var sum = 0;
        for (var i = 0; i < polygon.length - 1; i++) {
            if( cross(point, polygon[i], polygon[i+1]) < 0 )
                sum -= angle(point, polygon[i], polygon[i+1]);
            else
                sum += angle(point, polygon[i], polygon[i+1]);
        }

        return ( Math.abs(sum-2*Math.PI) < eps || Math.abs(sum+2*Math.PI) < eps );
    }
    
    function init(){
        $.ajax({
            type : 'GET',
            url : urlConfig.location,
            headers : {
                'Authorization' : 'Basic ' + window.btoa( getState('member').user + ':' + getState('member').pw )
            },
            success : function(response) {
                var result = jQuery.parseJSON(response);
                var data = result;
                if(!isPlaceSet()){
                    var list = data;
                    var location = [];

                    for (var i = 0; i < list.length; i++) {
                        var tmp_geo = list[i].geometry;
                        var point_list = get_point_list(tmp_geo);
                        //console.log(list[i]);
                        var tmp = {
                            id: list[i].location_id,
                            name: list[i].name,
                            polygon: point_list, 
                        };
                        location.push(tmp);
                    }
                    setPlace(location);
                }  
               setGeolocation();
            },
            error : function(response) {
                console.log('Cannot set geolocation');
                //direct to login
            }
        });
    }

    

    //-----------------------------------------------------

    // $('.page-map').live("pagecreate", function() {
        // init();
    // });
    $('.page-map').live('pageshow',function(){
    	if(map!=null){
    	 google.maps.event.trigger(map, 'resize');
    	 }else{
    	 	init();
    	 }
    });

})()