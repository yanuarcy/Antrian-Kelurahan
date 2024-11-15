<?php
session_start();
include "../config/AntarmukaConfig.php";


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
  
    <title>Kelurahan Jemursari Queue</title>
    <link rel="stylesheet" href="../assets/css/layout.css">
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>-->
    <!--<script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>-->
    <!--<script src="https://code.responsivevoice.org/responsivevoice.js?key=3WLZhCgS"></script>-->
    
    <style>
        .queue-number {
            flex-basis: 30%;
            background-color: #ea6db4;
            text-align: center;
            padding: 30px;
            padding-top: 120px;
            padding-bottom: 120px;
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            color: #ffffff;
        }
        
        .queue-number p:first-child {
            font-size: 2.5em;
            margin: -95px 0 35px 0;
            font-family: Poppins-Regular;
        }
        
        .queue-number p:nth-child(2) {
            font-size: 14em;
            margin: 35px 0 35px 0;
            font-family: Poppins-Regular;
            /* animation: blink 1s step-start 0s infinite; */
            animation: blink 2s step-start infinite;
        }
        
        .queue-number p:last-child {
            font-size: 5.5em;
            margin: 40px 0 -90px 0;
            font-family: Poppins-Regular;
        }
        
        /* Add blinking animation */
        @keyframes blink {
            0%, 50%, 100% {
                opacity: 1; /* Visible */
            }
        
            25%, 75% {
                opacity: 0; /* Invisible */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="../assets/img/LogoCompany.png" alt="Logo Puskesmas">
            </div>
            <div class="info">
                <h1>KELURAHAN JEMURWONOSARI</h1>
                <p>Jl. Jemursari VIII No. 49, Wonocolo, <br>Surabaya, Jawa Timur 60237</p>
            </div>
            <div class="date">
            <h2><span id="current-time"></span></h2>
            </div>
        </div>
        <div class="queue-display">
            <div class="queue-number">
                <p>Antrian Sekarang</p>
                <p id="antrian-sekarang">--</p>
                <p id="loket">LOKET --</p>
            </div>
            <div class="video-section">
                <div class="embed-video">
                    <iframe id="video-frame" width="760" height="445" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="poliklinik">
                <div class="poliklinik-item">
                    <p id="antrian-selanjutnya-1">--</p>
                </div>
                <div class="poliklinik-item">
                    <p id="antrian-selanjutnya-2">--</p>
                </div>
                <div class="poliklinik-item">
                    <p id="antrian-selanjutnya-3">--</p>
                </div>
                <div class="poliklinik-item">
                    <p id="antrian-selanjutnya-4">--</p>
                </div>
                <div class="poliklinik-item">
                    <p id="antrian-selanjutnya-5">--</p>
                </div>
                <div class="poliklinik-item">
                    <p id="antrian-selanjutnya-6">--</p>
                </div>
                <div class="poliklinik-item">
                    <p id="antrian-selanjutnya-7">--</p>
                </div>
                <div class="poliklinik-item">
                    <p id="antrian-selanjutnya-8">--</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Layout/index.php -->
    <audio id="tingtung" src="../assets/audio/tingtung.mp3"></audio>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>
    <script type="text/javascript">
        
        

        // Variables to store previous values
        var previousAntrian = '';
        var previousLoket = '';

        // function playAudioAndSpeak(antrian, loket) {
        //     var bell = document.getElementById('tingtung');

        //     // Play bell sound
        //     bell.pause();
        //     bell.currentTime = 0;
        //     bell.play();

        //     // Set delay for bell sound duration
        //     var durasi_bell = bell.duration * 500;

        //     // Speak the queue number after the bell sound
        //     setTimeout(function() {
        //         responsiveVoice.speak("Nomor Antrian, " + antrian + ", menuju loket, " + loket, "Indonesian Female", {
        //             rate: 0.9,
        //             pitch: 1,
        //             volume: 2
        //         });
        //     }, durasi_bell);
        // }
        
        let isPlaying = false; // To track if audio is currently playing
        let queue = []; // Array to hold the queue data
        
        // function playAudioAndSpeak(antrian, nama, loket) {
        //     return new Promise((resolve) => {
        //         var bell = document.getElementById('tingtung');
    
        //         // Play bell sound
        //         bell.pause();
        //         bell.currentTime = 0;
        //         bell.play();
    
        //         // Set delay for bell sound duration
        //         var durasi_bell = bell.duration * 1000; // bell.duration is in seconds, multiply by 1000 for milliseconds
    
        //         // Speak the queue number after the bell sound
        //         setTimeout(function() {
        //             let speechText = nama 
        //                 ? `Nomor Antrian, ${antrian}, atas nama, ${nama}, menuju loket, ${loket}`
        //                 : `Nomor Antrian, ${antrian}, menuju loket, ${loket}`;
        //             responsiveVoice.speak(speechText, "Indonesian Female", {
        //                 rate: 0.9,
        //                 pitch: 1,
        //                 volume: 1, // Max volume is 1
        //                 onend: resolve // Resolve the promise when speaking is finished
        //             });
        //         }, durasi_bell);
        //     });
        // }
    
        // Function to play audio and speak
        function playAudioAndSpeak(antrian, nama, loket, whatsapp) {
            return new Promise((resolve) => {
                // var bell = document.getElementById('tingtung');
                var bell = document.getElementById('tingtung');
    
                // Play bell sound
                bell.pause();
                bell.currentTime = 0;
                bell.play();

                // Set delay for bell sound duration
                var durasi_bell = bell.duration * 1000; // bell.duration is in seconds, multiply by 1000 for milliseconds

                whatsappExist = true
                if (whatsapp === "-") {
                    whatsappExist = false
                } else {
                    whatsappExist = true
                }  
                // console.log("nama", nama);
                setTimeout(function() {
                    // console.log("ada wa ngga", whatsappExist);
                    let speechText = whatsappExist
                        ? `Nomor Antrian, ${antrian}, menuju loket, ${loket}`
                        : `Nomor Antrian, ${antrian}, atas nama, ${nama}, menuju loket, ${loket}`;
                    
                    responsiveVoice.speak(speechText, "Indonesian Female", {
                        rate: 0.9,
                        pitch: 1,
                        volume: 1,
                        onend: resolve
                    });
                }, durasi_bell);
            });
        }
        
        // function playAudioAndSpeak(antrian, nama, loket) {
        //     return new Promise((resolve) => {
        //         const bell = document.getElementById('tingtung');

        //         // Play bell sound
        //         bell.pause();
        //         bell.currentTime = 0;
        //         bell.play();

        //         // Set delay for bell sound duration
        //         const durasi_bell = bell.duration * 1000;

        //         setTimeout(() => {
        //             let speechText = nama
        //                 ? `Nomor Antrian, ${antrian}, atas nama, ${nama}, menuju loket, ${loket}`
        //                 : `Nomor Antrian, ${antrian}, menuju loket, ${loket}`;

        //             const utterance = new SpeechSynthesisUtterance(speechText);
        //             utterance.lang = 'id-ID'; // Set language to Indonesian
        //             utterance.rate = 0.9;
        //             utterance.pitch = 0.5;
        //             utterance.volume = 1;

        //             utterance.onend = resolve;

        //             // Get available voices
        //             const voices = window.speechSynthesis.getVoices();
                    
        //             // Try to find an Indonesian voice
        //             const indonesianVoice = voices.find(voice => voice.lang === 'id-ID');
        //             if (indonesianVoice) {
        //                 utterance.voice = indonesianVoice;
        //             }

        //             window.speechSynthesis.speak(utterance);
        //         }, durasi_bell);
        //     });
        // }
        
        // if (typeof speechSynthesis !== 'undefined' && speechSynthesis.onvoiceschanged !== undefined) {
        //     speechSynthesis.onvoiceschanged = () => {
        //         window.speechSynthesis.getVoices();
        //     };
        // }
        
        
        // function playAudioAndSpeak(antrian, nama, loket, whatsapp) {
        //     return new Promise((resolve) => {
        //         const bell = document.getElementById('tingtung');

        //         // Play bell sound
        //         bell.pause();
        //         bell.currentTime = 0;
        //         bell.play();

        //         // Set delay for bell sound duration
        //         const durasi_bell = bell.duration * 1000;

        //         const whatsappExist = whatsapp !== "-";
        //         console.log($nama);

        //         setTimeout(() => {
        //             const speechText = whatsappExist
        //                 ? `Nomor Antrian, ${antrian}, menuju loket, ${loket}`
        //                 : `Nomor Antrian, ${antrian}, atas nama, ${nama}, menuju loket, ${loket}`;

        //             const utterance = new SpeechSynthesisUtterance(speechText);
        //             utterance.lang = 'id-ID'; // Set language to Indonesian
        //             utterance.rate = 0.9;
        //             utterance.pitch = 1;
        //             utterance.volume = 1;

        //             utterance.onend = resolve;

        //             // Get available voices
        //             const voices = window.speechSynthesis.getVoices();
                    
        //             // Try to find an Indonesian voice
        //             const indonesianVoice = voices.find(voice => voice.lang === 'id-ID');
        //             if (indonesianVoice) {
        //                 utterance.voice = indonesianVoice;
        //             }

        //             window.speechSynthesis.speak(utterance);
        //         }, durasi_bell);
        //     });
        // }

        // Initialize voices (needed for some browsers)
        // if (typeof speechSynthesis !== 'undefined' && speechSynthesis.onvoiceschanged !== undefined) {
        //     speechSynthesis.onvoiceschanged = () => {
        //         window.speechSynthesis.getVoices();
        //     };
        // }
        
        // Function to process the queue sequentially
        // async function processQueue() {
        //     // Exit if queue is empty or audio is already playing
        //     if (queue.length === 0 || isPlaying) return;
    
        //     isPlaying = true; // Mark that audio is playing
        //     const { antrian, nama, loket } = queue.shift(); // Remove the first item from the queue
            
        //     // Update the HTML elements with the current queue data
        //     document.getElementById('antrian-sekarang').innerText = antrian;
        //     document.getElementById('loket').innerText = 'LOKET ' + loket;
            
        //     await playAudioAndSpeak(antrian, nama, loket); // Wait for the audio and speaking to complete
        //     isPlaying = false; // Mark that audio has finished
    
        //     // Send a POST request to remove the announced item from the server-side queue
        //     $.post('../panggilan-antrian/current_antrian.php', {}, function() {
        //         // Continue processing the next item in the queue
        //         processQueue();
        //     });
        // }
    
        // Fetch the queue periodically
        // setInterval(function() {
        //     $.get('../panggilan-antrian/current_antrian.php', function(data) {
        //         queue = data; // Ensure data is an array from the JSON
        //         processQueue(); // Start processing the queue
        //     });
        // }, 3000); // Fetch every second
    
        // Function to process the queue sequentially
        async function processQueue() {
            if (isPlaying) return;

            try {
                const response = await fetch('../api/api.php?action=next');
                const data = await response.json();

                if (data.status === 'empty') {
                    console.log('Antrian kosong');
                    return;
                }

                if (data.id) {
                    isPlaying = true;

                    // Update UI
                    document.getElementById('antrian-sekarang').innerText = data.antrian;
                    document.getElementById('loket').innerText = 'LOKET ' + data.loket;

                    await playAudioAndSpeak(data.antrian, data.nama, data.loket, data.whatsapp);

                    // Mark as complete and delete from database
                    const completeResponse = await fetch('../api/api.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({
                            action: 'complete',
                            id: data.id
                        })
                    });

                    const completeResult = await completeResponse.json();
                    if (completeResult.status !== 'success') {
                        throw new Error('Gagal menandai antrian sebagai selesai');
                    }

                    isPlaying = false;
                }
            } catch (error) {
                console.error('Error processing queue:', error);
                isPlaying = false;
            }
        }
    
        // Fetch the queue periodically
        setInterval(processQueue, 1000); // Fetch every second

        // // Continuously check for updates every few seconds
        // setInterval(function() {
        //     $.get('../panggilan-antrian/current_antrian.php', function(data) {

        //         var antrianSekarang = data.antrian;
        //         var loketSekarang = data.loket;

        //         // Log the current values to the console for debugging
        //         console.log("Antrian Sekarang: ", antrianSekarang);
        //         console.log("Loket Sekarang: ", loketSekarang);

        //         // Check if the current values are different from the previous ones
        //         if (antrianSekarang !== previousAntrian || loketSekarang !== previousLoket) {
        //             playAudioAndSpeak(antrianSekarang, loketSekarang);

        //             // Update the previous values with the current ones
        //             previousAntrian = antrianSekarang;
        //             previousLoket = loketSekarang;
        //         }
        //     });
        // }, 1000); // Check every 5 seconds

        function updateCurrentTime() {
            var currentTime = new Date();
            var formattedTime = currentTime.toLocaleString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('current-time').textContent = formattedTime;
        }

        setInterval(updateCurrentTime, 1000);
        updateCurrentTime();

        $(document).ready(function() {
            function loadAntrianSekarang() {
                // $('#antrian-sekarang').load('../panggilan-antrian/get_antrian_sekarang.php');
                // $('#loket').load('./get_active_loket.php');
                
                $.ajax({
                    url: '../panggilan-antrian/get_antrian_selanjutnya.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Tampilkan nomor antrian selanjutnya ke elemen yang sesuai
                        response.forEach(function(item, index) {
                            $('#antrian-selanjutnya-' + (index + 1)).text(item);
                        });

                        // Jika kurang dari 8, tampilkan "--" pada sisa elemen
                        for (var i = response.length; i < 8; i++) {
                            $('#antrian-selanjutnya-' + (i + 1)).text("--");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            }

            loadAntrianSekarang();
            setInterval(loadAntrianSekarang, 1000);
            
            // Function to extract the video ID from the YouTube embed URL
            function extractVideoId(url) {
                // Regular expression to match the video ID in the embed URL
                const match = url.match(/\/embed\/([^?&]+)/);
                return match ? match[1] : '';
            }

            currentSumber = "";
            function updateVideoSrc() {
                $('#video-frame').load('./get_active_video.php', function(response) {
                    console.log(response);
                    const extractResponse = extractVideoId(response);
                    // console.log(extractResponse);
                    
                    if (response !== currentSumber) {
                        // $('#video-frame').attr('src', "https://www.youtube.com/embed/85LwMa6JkAs?si=V4A3c6dyI8hpvm5r");
                        // $('#video-frame').attr('src', "https://www.youtube.com/embed/tXWuQbGTfxM?si=7BPBmTTQJLhlCdhM&autoplay=1&mute=1");
                        // $('#video-frame').attr('src', response + "&autoplay=1&mute=1");
                        // $('#video-frame').attr('src', response + "&autoplay=1&mute=1&loop=1&color=white&controls=0&modestbranding=1&playsinline=1&rel=0&enablejsapi=1&playlist=${extractResponse}");
                        $('#video-frame').attr('src', `${response}&autoplay=1&mute=1&loop=1&color=white&controls=0&modestbranding=1&playsinline=1&rel=0&enablejsapi=1&playlist=${extractResponse}`);
                        // &autoplay=1&mute=1&loop=1&color=white&controls=0&modestbranding=1&playsinline=1&rel=0&enablejsapi=1&playlist=rsFovUU_0FQ
                        currentSumber = response;
                    }
                });
            }

            // Update the video source every second
            setInterval(updateVideoSrc, 1000);
            updateVideoSrc();  // Initial call to set the video source
        });
        
    </script>
</body>
</html>
