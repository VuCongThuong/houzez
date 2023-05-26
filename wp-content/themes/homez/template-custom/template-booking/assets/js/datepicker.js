document.addEventListener("DOMContentLoaded", function () {
  flatpickr.l10ns.en.firstDayOfWeek = 0;
  flatpickr("#datetimepicker1", {
    wrap: true,
    dateFormat: "Y/m/d",
    locale: "en",
    clickOpens: false,
    allowInput: true,
    monthSelectorType: "static",
    mode: "range",
  });
});

$(function () {
  $("#datepicker").datepicker();
});

function btncls() {
  let p1 = document.getElementById("reflist");
  let f1 = document.getElementById("refoot");

  let i1 = document.getElementById("ranno");
  let i2 = document.getElementById("kanrino");
  let i3 = document.getElementById("buhin");
  let i4 = document.getElementById("dt1");
  let i5 = document.getElementById("dt2");

  let s1 = document.getElementById("status");
  let s2 = document.getElementById("eigyo");
  let s3 = document.getElementById("souko");
  let s4 = document.getElementById("company");
  let s5 = document.getElementById("user");

  i1.value = "";
  i2.value = "";
  i3.value = "";
  i4.value = "";
  i5.value = "";

  s1.selectedIndex = 0;
  s2.selectedIndex = 0;
  s3.selectedIndex = 0;
  s4.selectedIndex = 0;
  s5.selectedIndex = 0;

  p1.style.display = "none";
  f1.style.display = "none";
}
