$(document).ready(function () {

    var song;
    var tracker = $('.tracker');
    var volume = $('#volume');
    var defaultVol = volume.val();

    var urlLast;

    function initAudio(elem) {
        var url = elem.attr('audiourl');
        urlLast = url;
        var title = elem.text();

        $('.player .title').text(title);

        song = new Audio(url);

        song.addEventListener('timeupdate', function () {

            var curtime = song.currentTime;
            var durtime = song.duration;

            var curMin = parseInt(curtime / 60);
            if (curMin < 10) {
                curMin = '0' + curMin;
            }
            var durMin = parseInt(durtime / 60);
            if (durMin < 10) {
                durMin = '0' + durMin;
            }

            var curSec = parseInt(curtime - (curMin * 60));
            if (curSec < 10) {
                curSec = '0' + curSec;
            }
            var durSec = parseInt(durtime - (durMin * 60));
            if (durSec < 10) {
                durSec = '0' + durSec;
            }

            $('#curtime').text(curMin + ':' + curSec);
            $('#durtime').text(durMin + ':' + durSec);

            var curtimeSlider = parseInt(curtime, 10);
            tracker.slider('value', curtimeSlider);


            if (song.currentTime === song.duration) {
                nextAuto();
            }
        });


        $('.playlist li').removeClass('active');
        elem.addClass('active');
    }

    function nextAuto() {
        $('.pause').trigger('eventclick');

        var next = $('.playlist li.active').next();
        if (next.length === 0) {
            next = $('.playlist li:first-child');
        }

        song.currentTime = 0;

        tracker.slider('value', song.currentTime);

        initAudio(next);

        $('.play').trigger('eventclick', function (e) {
            e.preventDefault();

            song.play();
            tracker.slider("option", "max", song.duration);
            song.volume = defaultVol / 100;

            $('.play').addClass('hidden');
            $('.pause').addClass('visible');
        } );

        song.pause();
        song.play();
    }

    function playAudio() {
        song.play();
        tracker.slider("option", "max", song.duration);
        song.volume = defaultVol / 100;

        $('.play').addClass('hidden');
        $('.pause').addClass('visible');
    }

    function stopAudio() {
        song.pause();

        $('.play').removeClass('hidden');
        $('.pause').removeClass('visible');
    }

    $('.play').click(function (e) {
        e.preventDefault();

        playAudio();
    });

    $('.pause').click(function (e) {
        e.preventDefault();

        stopAudio();
    });

    $('.fwd').click(function (e) {
        e.preventDefault();
        song.pause();

        var next = $('.playlist li.active').next();
        if (next.length === 0) {
            next = $('.playlist li:first-child');
        }
        initAudio(next);
        song.currentTime = 0;

        tracker.slider('value', song.currentTime);

        $('.play').trigger('eventclick', function (e) {
            e.preventDefault();

            song.play();
            tracker.slider("option", "max", song.duration);
            song.volume = defaultVol / 100;

            $('.play').addClass('hidden');
            $('.pause').addClass('visible');
        } );

        song.play();
    });

    $('.rew').click(function (e) {
        e.preventDefault();
        song.pause();

        var prev = $('.playlist li.active').prev();
        if (prev.length === 0) {
            prev = $('.playlist li:last-child');
        }
        initAudio(prev);
        song.currentTime = 0;

        tracker.slider('value', song.currentTime);

        $('.play').trigger('eventclick', function (e) {
            e.preventDefault();

            song.play();
            tracker.slider("option", "max", song.duration);
            song.volume = defaultVol / 100;

            $('.play').addClass('hidden');
            $('.pause').addClass('visible');
        } );

        song.play();
    });

    function that(el) {
        return el.attr('audiourl');
    }

    // $('.playlist li').data('counter', 1).click(function () {
    $('.playlist li').click(function () {
        // var th = that($(this));

        stopAudio();
        initAudio($(this));

        // var counter = $(this).data('counter');
        // $(this).data('counter', ++counter);
        //
        // if (urlLast === th && counter % 2 === 0) {
        //     playAudio();
        // } else if (urlLast === th && counter % 2 !== 0) {
        //     stopAudio();
        // } else {
        //     initAudio($(this));
        //     playAudio();
        // }
    });

    initAudio($('.playlist li:first-child'));

    // $('#mute').click(function () {
    //     mute();
    // });
    //
    // function mute() {
    //
    //     if (song.volume > 0) {
    //         song.volume = 0;
    //         $('#mute').text('Unmute');
    //         song.volume = 0;
    //     } else {
    //         song.volume = defaultVol / 100;
    //         $('#mute').text('Mute');
    //         song.volume = defaultVol / 100;
    //     }
    // }

    volume.mousemove(function () {
        defaultVol = $('#volume').val();
        $('#volume').attr('value', defaultVol);

        song.volume = defaultVol / 100;

    });


    tracker.slider({
        range: 'min',
        min: 0,
        max: 10,
        value: 0,
        animate: true,
        start: function (event, ui) {
        },
        slide: function (event, ui) {
            song.currentTime = ui.value;
        },
        stop: function (event, ui) {
        }
    });


});