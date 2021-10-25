
    let miCanvas = document.getElementById("graficaLuz").getContext("2d");

    var chart = new Chart(miCanvas,{
    type:"bar",
    data:{
    labels:["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    datasets: [
{
    label:"Factura de la luz mensual"
}
    ]
}
})
