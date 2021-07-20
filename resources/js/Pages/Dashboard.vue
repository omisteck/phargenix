<template>
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
      <div class="widget widget-three">
        <div class="widget-heading">
          <h5 class="">Summary</h5>

          <div class="task-action">
            <div class="dropdown">
              <a
                class="dropdown-toggle"
                href="#"
                role="button"
                id="pendingTask"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-more-horizontal"
                >
                  <circle cx="12" cy="12" r="1"></circle>
                  <circle cx="19" cy="12" r="1"></circle>
                  <circle cx="5" cy="12" r="1"></circle>
                </svg>
              </a>

              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="pendingTask"
                style="will-change: transform"
              >
                <a class="dropdown-item" href="javascript:void(0);"
                  >View Report</a
                >
              </div>
            </div>
          </div>
        </div>
        <div class="widget-content">
          <div class="order-summary">
            <div class="summary-list summary-income">
              <div class="summery-info">
                <div class="w-icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-shopping-bag"
                  >
                    <path
                      d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"
                    ></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                  </svg>
                </div>

                <div class="w-summary-details">
                  <div class="w-summary-info">
                    <h6>Income <span class="summary-count">$92,600 </span></h6>
                    <p class="summary-average">90%</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="summary-list summary-profit">
              <div class="summery-info">
                <div class="w-icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-tag"
                  >
                    <path
                      d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"
                    ></path>
                    <line x1="7" y1="7" x2="7" y2="7"></line>
                  </svg>
                </div>
                <div class="w-summary-details">
                  <div class="w-summary-info">
                    <h6>Profit <span class="summary-count">$37,515</span></h6>
                    <p class="summary-average">65%</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="summary-list summary-expenses">
              <div class="summery-info">
                <div class="w-icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-credit-card"
                  >
                    <rect
                      x="1"
                      y="4"
                      width="22"
                      height="16"
                      rx="2"
                      ry="2"
                    ></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                  </svg>
                </div>
                <div class="w-summary-details">
                  <div class="w-summary-info">
                    <h6>Expenses <span class="summary-count">$55,085</span></h6>
                    <p class="summary-average">80%</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-5 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
      <div class="widget widget-table-one">
        <div class="widget-heading">
          <h5 class="">Transactions</h5>
          <div class="task-action">
            <div class="dropdown">
              <a
                class="dropdown-toggle"
                href="#"
                role="button"
                id="pendingTask"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-more-horizontal"
                >
                  <circle cx="12" cy="12" r="1"></circle>
                  <circle cx="19" cy="12" r="1"></circle>
                  <circle cx="5" cy="12" r="1"></circle>
                </svg>
              </a>

              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="pendingTask"
                style="will-change: transform"
              >
                <a class="dropdown-item" href="javascript:void(0);"
                  >View Report</a
                >
              </div>
            </div>
          </div>
        </div>

        <div class="widget-content">
          <div class="transactions-list">
            <div class="t-item">
              <div class="t-company-name">
                <div class="t-icon">
                  <div class="icon">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-home"
                    >
                      <path
                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                      ></path>
                      <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                  </div>
                </div>
                <div class="t-name">
                  <h4>Electricity Bill</h4>
                  <p class="meta-date">4 Aug 1:00PM</p>
                </div>
              </div>
              <div class="t-rate rate-dec">
                <p><span>-$16.44</span></p>
              </div>
            </div>
          </div>

          <div class="transactions-list t-info">
            <div class="t-item">
              <div class="t-company-name">
                <div class="t-icon">
                  <div class="avatar avatar-xl">
                    <span class="avatar-title">SP</span>
                  </div>
                </div>
                <div class="t-name">
                  <h4>Shaun Park</h4>
                  <p class="meta-date">4 Aug 1:00PM</p>
                </div>
              </div>
              <div class="t-rate rate-inc">
                <p><span>+$36.11</span></p>
              </div>
            </div>
          </div>

          <div class="transactions-list">
            <div class="t-item">
              <div class="t-company-name">
                <div class="t-icon">
                  <div class="avatar avatar-xl">
                    <span class="avatar-title">AD</span>
                  </div>
                </div>
                <div class="t-name">
                  <h4>Amy Diaz</h4>
                  <p class="meta-date">4 Aug 1:00PM</p>
                </div>
              </div>
              <div class="t-rate rate-inc">
                <p><span>+$66.44</span></p>
              </div>
            </div>
          </div>

          <div class="transactions-list t-secondary">
            <div class="t-item">
              <div class="t-company-name">
                <div class="t-icon">
                  <div class="icon">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-home"
                    >
                      <path
                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                      ></path>
                      <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                  </div>
                </div>
                <div class="t-name">
                  <h4>Netflix</h4>
                  <p class="meta-date">4 Aug 1:00PM</p>
                </div>
              </div>
              <div class="t-rate rate-dec">
                <p><span>-$32.00</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12 layout-spacing">
      <div class="widget widget-chart-one">
        <div class="widget-heading">
          <h5 class="">Revenue</h5>
          <div class="task-action">
            <div class="dropdown">
              <a
         ß       class="dropdown-toggle"
                href="#"
                role="button"
                id="pendingTask"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-more-horizontal"
                >
                  <circle cx="12" cy="12" r="1"></circle>
                  <circle cx="19" cy="12" r="1"></circle>
                  <circle cx="5" cy="12" r="1"></circle>
                </svg>
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="pendingTask"
                style="will-change: transform"
              >
                <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
              </div>
            </div>
          </div>
        </div>

        <div class="widget-content">
          <apexchart
            type="area"
            :options="options"
            :series="series"
          ></apexchart>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "./Layout/Layout.vue";

export default {
  // Using the shorthand
  layout: Layout,

  data: function () {
    return {
      options: {
        chart: {
          fontFamily: "Quicksand, sans-serif",
          height: 365,
          type: "area",
          zoom: {
            enabled: false,
          },
          dropShadow: {
            enabled: true,
            opacity: 0.2,
            blur: 10,
            left: -7,
            top: 22,
          },
          toolbar: {
            show: false,
          },
          events: {
            mounted: function (ctx, config) {
              const highest1 = ctx.getHighestValueInSeries(0);
              const highest2 = ctx.getHighestValueInSeries(1);

              ctx.addPointAnnotation({
                x: new Date(
                  ctx.w.globals.seriesX[0][
                    ctx.w.globals.series[0].indexOf(highest1)
                  ]
                ).getTime(),
                y: highest1,
                label: {
                  style: {
                    cssClass: "d-none",
                  },
                },
                customSVG: {
                  SVG:
                    '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#2196f3" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                  cssClass: undefined,
                  offsetX: -8,
                  offsetY: 5,
                },
              });

              ctx.addPointAnnotation({
                x: new Date(
                  ctx.w.globals.seriesX[1][
                    ctx.w.globals.series[1].indexOf(highest2)
                  ]
                ).getTime(),
                y: highest2,
                label: {
                  style: {
                    cssClass: "d-none",
                  },
                },
                customSVG: {
                  SVG:
                    '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#6d17cb" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                  cssClass: undefined,
                  offsetX: -8,
                  offsetY: 5,
                },
              });
            },
          },
        },
        colors: ["#2196f3", "#6d17cb"],
        dataLabels: {
          enabled: false,
        },
        markers: {
          discrete: [
            {
              seriesIndex: 0,
              dataPointIndex: 7,
              fillColor: "#000",
              strokeColor: "#000",
              size: 5,
            },
            {
              seriesIndex: 2,
              dataPointIndex: 11,
              fillColor: "#000",
              strokeColor: "#000",
              size: 4,
            },
          ],
        },
        subtitle: {
          text: "$10,840",
          align: "left",
          margin: 0,
          offsetX: 95,
          offsetY: 0,
          floating: false,
          style: {
            fontSize: "18px",
            color: "#4361ee",
          },
        },
        title: {
          text: "Total Profit",
          align: "left",
          margin: 0,
          offsetX: -10,
          offsetY: 0,
          floating: false,
          style: {
            fontSize: "18px",
            color: "#0e1726",
          },
        },
        stroke: {
          show: true,
          curve: "smooth",
          width: 2,
          lineCap: "square",
        },

        xaxis: {
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false,
          },
          crosshairs: {
            show: true,
          },
          labels: {
            offsetX: 0,
            offsetY: 5,
            style: {
              fontSize: "12px",
              fontFamily: "Quicksand, sans-serif",
              cssClass: "apexcharts-xaxis-title",
            },
          },
        },
        yaxis: {
          labels: {
            formatter: function (value, index) {
              return value / 1000 + "K";
            },
            offsetX: -15,
            offsetY: 0,
            style: {
              fontSize: "12px",
              fontFamily: "Quicksand, sans-serif",
              cssClass: "apexcharts-yaxis-title",
            },
          },
        },
        grid: {
          borderColor: "#e0e6ed",
          strokeDashArray: 5,
          xaxis: {
            lines: {
              show: true,
            },
          },
          yaxis: {
            lines: {
              show: false,
            },
          },
          padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: -10,
          },
        },
        legend: {
          position: "top",
          horizontalAlign: "right",
          offsetY: -70,
          fontSize: "16px",
          fontFamily: "Quicksand, sans-serif",
          markers: {
            width: 10,
            height: 10,
            strokeWidth: 0,
            strokeColor: "#fff",
            fillColors: undefined,
            radius: 12,
            onClick: undefined,
            offsetX: 0,
            offsetY: 0,
          },
          itemMargin: {
            horizontal: 20,
            vertical: 20,
          },
        },
        tooltip: {
          theme: "dark",
          marker: {
            show: true,
          },
          x: {
            show: false,
          },
        },
        fill: {
          type: "gradient",
          gradient: {
            type: "vertical",
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: 0.28,
            opacityTo: 0.05,
            stops: [45, 100],
          },
        },
        responsive: [
          {
            breakpoint: 575,
            options: {
              legend: {
                offsetY: -30,
              },
            },
          },
        ],
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      series: [
        {
          name: "Income",
          data: [
            16800,
            16800,
            15500,
            17800,
            15500,
            17000,
            19000,
            16000,
            15000,
            17000,
            14000,
            17000,
          ],
        },
        {
          name: "Expenses",
          data: [
            16500,
            17500,
            16200,
            17300,
            16000,
            19500,
            16000,
            17000,
            16000,
            19000,
            18000,
            19000,
          ],
        },
      ],
    };
  },

  props: ["name", "newClass"],
};
</script>