var audio;
var prev_play;
var slider  = $('#slider'), tooltip = $('.tooltip');
var vol = 1;

function formatSecondsAsTime(secs, format) {
    var hr  = Math.floor(secs / 3600);
    var min = Math.floor((secs - (hr * 3600))/60);
    var sec = Math.floor(secs - (hr * 3600) -  (min * 60));

    if (min < 10){
        min = "0" + min;
    }
    if (sec < 10){
        sec  = "0" + sec;
    }

    return min + ':' + sec;
}

function getActive(){
    return $('a.pause_track').parents("tr:eq(0)").find('td:last');
}

function player(selector) {
    audio = $.media(selector);
    audio.volume(vol);
    audio.time(function () {
        all = audio.duration() - this.time();
        time = '-'+formatSecondsAsTime(Math.floor(all).toString());
        active = getActive();
        active.html(time);
    })
}

$(function() {

    player('#audio')

    $('.track').click(function(){
        obj = $(this)
        track = obj.data('track')
        player = $('.player')

        if(track != prev_play) {
            $('.track').not(this).removeClass('pause_track').addClass('play_track')
            $('.time').html('')
            audio.source(track)
            prev_play = track
        }
        if(obj.hasClass('play_track')){
            obj.removeClass('play_track').addClass('pause_track')
            player.removeClass('play').addClass('pause')
            audio.play()
        }
        else{
            obj.removeClass('pause_track').addClass('play_track')
            player.removeClass('pause').addClass('play')
            audio.pause()
        }
    })

    $('.player').click(function(){
            $('a[data-track="'+prev_play+'"]').click()
    })


    tooltip.hide();

    slider.slider({
        range: "min",
        min: 0,
        value: 100,

        start: function(event,ui) {
            tooltip.fadeIn('fast');
        },

        slide: function(event, ui) {

            var value  = slider.slider('value'),
                volume = $('.volume');

            tooltip.css('left', value).text(ui.value);

            if(value <= 5) {
                volume.css('background-position', '0 0');
            }
            else if (value <= 25) {
                volume.css('background-position', '0 -25px');
            }
            else if (value <= 75) {
                volume.css('background-position', '0 -50px');
            }
            else {
                volume.css('background-position', '0 -75px');
            };

            vol = Number(ui.value) / 100
            audio.volume(vol)

        },

        stop: function(event,ui) {
            tooltip.fadeOut('fast');
        },

    });

});