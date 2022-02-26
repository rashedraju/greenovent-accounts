"use strict";
var KTProjectList = {
    init: function () {
        !(function () {
            var t = document.getElementById("kt_project_list_chart");
            if (t) {
                var e = t.getContext("2d");
                new Chart(e, {
                    type: "doughnut",
                    data: {
                        datasets: [
                            {
                                data: [10, 20, 30],
                                backgroundColor: [
                                    "#00A3FF",
                                    "#50CD89",
                                    "#E4E6EF",
                                ],
                            },
                        ],
                        labels: ["Active", "Completed", "Yet to start"],
                    },
                    options: {
                        chart: { fontFamily: "inherit" },
                        cutout: "75%",
                        cutoutPercentage: 65,
                        responsive: !0,
                        maintainAspectRatio: !1,
                        title: { display: !1 },
                        animation: { animateScale: !0, animateRotate: !0 },
                        tooltips: {
                            enabled: !0,
                            intersect: !1,
                            mode: "nearest",
                            bodySpacing: 5,
                            yPadding: 10,
                            xPadding: 10,
                            caretPadding: 0,
                            displayColors: !1,
                            backgroundColor: "#20D489",
                            titleFontColor: "#ffffff",
                            cornerRadius: 4,
                            footerSpacing: 0,
                            titleSpacing: 0,
                        },
                        plugins: { legend: { display: !1 } },
                    },
                });
            }
        })();
    },
};
KTUtil.onDOMContentLoaded(function () {
    KTProjectList.init();
});
