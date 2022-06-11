$.ajax({
    url:'/datos-grafica/departamentos-empleados',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        const $LienzoGraficaDepartamento = document.getElementById('graficaDepartamento');
        
        dataDepartamento = data;
        graficaDepartamentoLabel = [];
        totalEmpleadoDepartamento = [];
        colorBarrasDepartamento = [];
        colorBordeBarrasDepartamento = [];

        for(var i in dataDepartamento) {
            color = (Math.random()*(255-1)+1); 
            graficaDepartamentoLabel.push(dataDepartamento[i].nombre);
            totalEmpleadoDepartamento.push(dataDepartamento[i].total);
            colorBarrasDepartamento.push('rgba(54, 162, '+color+', 0.2)');
            colorBordeBarrasDepartamento.push('rgba(54, 162, '+color+', 1)')
        }

        const GraficaDepartamento = {
            label: "Empleados por Departamento",
            data: totalEmpleadoDepartamento,
            backgroundColor: colorBarrasDepartamento,
            borderColor: colorBordeBarrasDepartamento,
            borderWidth: 1,
        };


        new Chart($LienzoGraficaDepartamento, {
            type: 'bar',// Tipo de gráfica
            data: {
                labels: graficaDepartamentoLabel,
                datasets: [
                    GraficaDepartamento,
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                },
            }
        });
    },
    error:function() {
        console.log("Error al recibir los datos")
    }
});