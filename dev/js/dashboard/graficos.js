const dias = ["Día 1", "Día 3", "Día 5", "Día 8", "Día 12", "Día 15", "Día 18", "Día 20", "Día 25", "Día 28"];
    const compras = [2, 5, 3, 7, 4, 9, 6, 3, 5, 8];
    const dinero = [40, 120, 90, 180, 160, 210, 190, 80, 150, 220];

    // 📈 Compras realizadas por día
    new Chart(document.getElementById("comprasDiaChart"), {
      type: "bar",
      data: {
        labels: dias,
        datasets: [{
          label: "Compras realizadas",
          data: compras,
          backgroundColor: "#facc15",
          borderColor: "#eab308",
          borderWidth: 1,
          borderRadius: 6
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: "Compras registradas en el mes actual"
          },
          legend: { display: false }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { stepSize: 1 },
            title: { display: true, text: "Cantidad de compras" }
          }
        }
      }
    });

    // 💰 Dinero gastado en el mes
    new Chart(document.getElementById("dineroGastadoChart"), {
      type: "line",
      data: {
        labels: dias,
        datasets: [{
          label: "Dinero gastado (Bs)",
          data: dinero,
          borderColor: "#ef4444",
          backgroundColor: "rgba(239, 68, 68, 0.2)",
          fill: true,
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: "Monto gastado durante el mes"
          },
          legend: { display: false }
        },
        scales: {
          y: {
            beginAtZero: true,
            title: { display: true, text: "Monto (Bs)" }
          }
        }
      }
    });