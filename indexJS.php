<script>

    let searchResults = [
        <?php
        if (is_array($searchFiles)) {
            foreach ($searchFiles as $file) {
                echo '"' . str_replace("\\", "/", $file->getPath()) . ': ' . $file->size . ' KB",';
            }
        }  
        ?>
    ];

    //Erstellt eine Variable mit dem searchResult Element
    let searchResultDiv = document.getElementById('searchResult');
    //gibt die Lenge des gefundenes Resultats aus
    for (let i = 0; i < searchResults.length; i++) {
        //Erstellt in diesem Fall einen Paragraph P
        let resultBox = document.createElement('p');
        resultBox.innerHTML = searchResults[i];
        searchResultDiv.append(resultBox);
    }
    //Falls keine Datei in der Suche gefunden wurde.
    if (searchResults.length == 0) {
        let resultBox = document.createElement('p');
        resultBox.innerHTML = "keine Datei gefunden";
        searchResultDiv.append(resultBox); 
    }

    //Javascript Balkendiagramm
    var config = {
        type: "bar",
        data: {
            labels: [
            <?php

                foreach ($largestFiles as $file) {
                    echo '"' . basename($file->getPath()) . " " . $file->sizeMB .'MB",';
                }
            ?>
            ],
            datasets: [
            {
                //Ausgabe des kleinen Texts oberhalb des Diagramms
                label: "Size MB",
                data: [
                    <?php
                    //Die Werte in $largestFiles werden hier mit einer foreach Schleife ausgegeben
                    foreach ($largestFiles as $file) {
                        //sizeMB ist hier die neue Size die in MB umgerechnet wurde.
                        //Ausgabe der Grösse von jedem File.
                        echo '"' . $file->sizeMB . '",';
                    }
                    ?>
                ],
                //Farbendeklaration
                backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(201, 203, 207, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(201, 203, 207, 0.5)'
                ],
                //Farbendeklaration
                borderColor: [
                'rgb(255, 99, 132, 1)',
                'rgb(255, 159, 64, 1)',
                'rgb(255, 205, 86, 1)',
                'rgb(75, 192, 192, 1)',
                'rgb(54, 162, 235, 1)',
                'rgb(153, 102, 255, 1)',
                'rgb(201, 203, 207, 1)',
                'rgb(54, 162, 235, 1)',
                'rgb(153, 102, 255, 1)',
                'rgb(201, 203, 207, 1)'
                ],
                //Randdicke
                borderWidth: 2,
            }], 
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: 'rgb(255, 99, 132)'
                    }
                }
            }
        }
    }; 

    //Gibt eine Referenz zu einem Element anhand seiner ID zurück.
    var chartCanvas = document.getElementById("barChartFiles");
    var barChartFiles = new Chart(chartCanvas, config);

</script>