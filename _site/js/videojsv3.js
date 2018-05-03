// JavaScript Document

//<![CDATA[
$(window).load(function(){
/*
Copyright 2011 : Simone Gianni <simoneg@apache.org>

-- update by Geoff Hudson http://emptychairfilms.tv
altered width of player to fit widescreen player, removed outside border, set to 0

-- update by tcuttrissweb --
   adds in title besdie thumbs in carousel.
   adjusted css from the original to make room for this
     allows resizing
       to adjust size of the player adjust the css for:
       .youtube iframe.player width / height accordingly.

Released under The Apache License 2.0
http://www.apache.org/licenses/LICENSE-2.0

*/

(function() {
    function createPlayer(jqe, video, options) {
        var ifr = $('iframe', jqe);
        if (ifr.length === 0) {
            ifr = $('<iframe scrolling="no">');
            ifr.addClass('player');
        }
        var src = '//www.youtube.com/embed/' + video.id + '?wmode=opaque&';
        if (options.playopts) {
            src += '?';
            for (var k in options.playopts) {
                src += k + '=' + options.playopts[k] + '&';
            }
            src += '_a=b';
        }
        ifr.attr('src', src);
        jqe.append(ifr);
    }

    function createCarousel(jqe, videos, options) {
        var car = $('div.carousel', jqe);
        if (car.length === 0) {
            car = $('<div>');
            car.addClass('carousel');

			//append the carousel
            jqe.append(car);

        }
        $.each(videos, function(i, video) {

            options.thumbnail(car, video, options);
        });
    }

function createThumbnail(jqe, video, options) {


        var imgurl = video.thumbnails;
        var img = $('img[src="' + imgurl + '"]');
        var desc = video.description;
        var container;
        if (img.length !== 0) return;
        img = $('<img align="left">');
        img.addClass('thumbnail');

        //append the image
        //jqe.append( img );
		    //img.after(car);

        desk = $('<div class="grid_5">' + '<div><p class="video-title">' + video.title + '</p>' +'<img  width="75" height="75" src="' +imgurl+'"  class="thumbnail"/>' + '</div></div>'  );

		   jqe.append(desk);

        img.attr('src', imgurl);
        img.attr('title', video.title);
        img.click(function() {
            options.player(options.maindiv, video, $.extend(true, {}, options, {
                playopts: {
                    //autoplay: 1
                }
            }));
        });


		    //console.log(video.title);
        //console.log(video.description);

        desk.click(function() {
            options.player(options.maindiv, video, $.extend(true, {}, options, {
                playopts: {
                    autoplay: 1

                }
            }));
        });
    }

    var defoptions = {
        autoplay: false,
        user: null,
        carousel: createCarousel,
        player: createPlayer,
        thumbnail: createThumbnail,
        loaded: function() {},
        playopts: {

            egm: 1,
            autohide: 1,
            fs: 1,
            showinfo: 1,
            rel:0
        }
    };

    $.fn.extend({
        youTubeChannel: function(options) {
            var md = $(this);
            md.addClass('youtube');
            md.addClass('youtube-channel');
            var allopts = $.extend(true, {}, defoptions, options);
            allopts.maindiv = md;
            var keyapi = 'AIzaSyDdDMJ9SaqnuDRncbIABPDdmk9vNd7n4K4';
            var playlistid;
            $.get( "https://www.googleapis.com/youtube/v3/channels?", { part: "contentDetails", forUsername : "SchletterInc" , maxResults : "50" , key : keyapi })

            .done(function( data ) {
                $.each(data.items, function(i,item){
                playlistid = item.contentDetails.relatedPlaylists.uploads;
                // console.log(item.contentDetails.relatedPlaylists.uploads)
                getplaylist(playlistid );
                })

            });

        function getplaylist(playlistid ){
            $.getJSON('https://www.googleapis.com/youtube/v3/playlistItems',  {
                part: "snippet",
                maxResults: 50,
                playlistId : playlistid,
                key : keyapi
            })

             .done(function(data){
               var videos = [];
                 $.each(data.items, function(i, item) {
                    //console.log(item.snippet.title + item.snippet.description + item.snippet.thumbnails.default.url);

                    var video = {
                        title : item.snippet.title,
                        thumbnails : item.snippet.thumbnails.default.url,
                        description: item.snippet.description,
                        id : item.snippet.resourceId.videoId
                        //title: entry.title.$t,
                        //id: entry.id.$t.match('[^/]*$'),
                        //thumbnails: entry.media$group.media$thumbnail,
                        //description: entry.media$group.media$description.$t
                    };
                      videos.push(video);

                 });

                    // console.log(videos);

                    allopts.allvideos = videos;
                    allopts.carousel(md, videos, allopts);
                    allopts.player(md, videos[0], allopts);
                    allopts.loaded(videos, allopts);

            })
            }



            //});


        }


    });

})();

$(function() {
    $('#player').youTubeChannel({
        user: 'SchletterInc'
    });
});
//]]>
});
