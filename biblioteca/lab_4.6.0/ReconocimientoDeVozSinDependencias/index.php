<!DOCTYPE html>

<head>
    <title>Reconocimiento de Voz</title>
</head>

<body>
    <script>
        const recognition = new webkitSpeechRecognition();
        recognition.interimResults = true;
        // recognition.continuous = true;
        recognition.lang = 'es-CO';

        recognition.addEventListener('result', (e) => {
            const transcript = Array.from(e.results)
                .map((result) => result[0])
                .map((result) => result.transcript)
                .join('');

            console.log(transcript);
        });

        recognition.addEventListener('end', recognition.start);
        recognition.start();


        // const recongnition = new webkitSpeechRecognition();

        // recongnition.lang = 'es-Es';
        // recongnition.continuous = true;
        // recongnition.onresult = event => {
        //     for(const result of event.results){
        //         console.log(result[0].transcript);
        //     }
        // }
        // recongnition.start();
    </script>
</body>

</html>