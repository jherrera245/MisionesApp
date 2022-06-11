$.ajax({
    url:'/datos-grafica/capacitaciones-empleados',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        const $LienzoGraficaCapacitacion = document.getElementById('graficaCapacitaciones');
        
        dataCapacitacion = data;
        graficaCapacitacionLabel = [];
        totalEmpleadoCapacitacion = [];
        colorPastel = []
        colorBordePastel = [];

        for(var i in dataCapacitacion) {
            color = (Math.random()*(255-1)+1)
            graficaCapacitacionLabel.push(dataCapacitacion[i].nombre_capacitacion);
            totalEmpleadoCapacitacion.push(dataCapacitacion[i].total);
            colorPastel.push('rgba(54, 162, '+color+', 0.2)');
            colorBordePastel.push('rgba(54, 162, '+color+', 1)');
        }

        const graficaCapacitacion = {
            label: "Empleados por Capacitacion",
            data: totalEmpleadoCapacitacion,
            backgroundColor: colorPastel,
            borderColor: colorBordePastel,
            borderWidth: 1,
        };

        new Chart($LienzoGraficaCapacitacion, {
            type: 'doughnut',// Tipo de gráfica
            data: {
                labels: graficaCapacitacionLabel,
                datasets: [
                    graficaCapacitacion,
                ]
            },
            options: {
                scales: {
                    y: {
                        display: false,
                    },
                    x:{
                        display: false,
                    },
                },
            }
        });
    },
    error:function() {
        console.log("Error al recibir los datos")
    }
});