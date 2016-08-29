// var user = $("div.page-header > div.page-header-menu > div.container > div.hor-menu > ul.nav.navbar-nav > li.menu-dropdown.classic-menu-dropdown > ul.dropdown-menu.pull-left > li.dropdown-submenu");
// user.click(function () {
//     if($(this).find("a").text().trim()==="Người dùng"){
//         $.get(url + "admin/getViewUser",function (data) {
//             $("div.page-container").empty().append(data);
//         })
//     }
// });
var user = $("nav.navbar.navbar-default.navbar-static-top > div.navbar-default.sidebar > div.sidebar-nav.navbar-collapse > ul#side-menu.nav > li >ul.nav.nav-second-level > li");
user.click(function () {
    if ($(this).find("a").text().trim() === "Chức vụ") {
        $.get(url + "admin/getViewPosition", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    ;
    if ($(this).find("a").text().trim() === "Người dùng") {
        $.get(url + "admin/getViewUser", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    ;
    if ($(this).find("a").text().trim() === "Bệnh nhân") {
        $.get(url + "admin/getViewPatient", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    ;
    if ($(this).find("a").text().trim() === "Điều trị viên") {
        $.get(url + "admin/getViewTherapist", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Bác sĩ") {
        $.get(url + "admin/getViewDoctor", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Gói") {
        $.get(url + "admin/getViewPackage", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Vùng điều trị") {
        $.get(url + "admin/getViewLocation", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Tỉnh thành") {
        $.get(url + "admin/getViewProvinces", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Độ tuổi") {
        $.get(url + "admin/getViewAge", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Điều trị chuyên môn") {
        $.get(url + "admin/getViewProTreatment", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Nguồn khách hàng") {
        $.get(url + "admin/getViewSourceCustomer", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
});
var Diagnostic = $("nav.navbar.navbar-default.navbar-static-top > div.navbar-default.sidebar > div.sidebar-nav.navbar-collapse > ul#side-menu.nav > li");
Diagnostic.click(function () {
    if ($(this).find("a").text().trim() === "Chẩn đoán") {
        $.get(url + "admin/getViewDiagnostic", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Hồ sơ bệnh án") {
        $.get(url + "admin/getViewMedicalRecord", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
});
var SurveyProgression = $("nav.navbar.navbar-default.navbar-static-top > div.navbar-default.sidebar > div.sidebar-nav.navbar-collapse > ul#side-menu.nav > li > ul.nav.nav-second-level >li>ul.nav.nav-third-level>li");
SurveyProgression.click(function () {
    if ($(this).find("a").text().trim() === "Điều trị chuyên môn") {
        $.get(url + "admin/getViewProfessional", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Phác đồ điều trị") {
        $.get(url + "admin/getRegimens", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Thống kê bệnh nhân") {
        $.get(url + "admin/getStatisticsPatients", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Thống kê chuyên viên") {
        $.get(url + "admin/getStatisticsTherapist", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Tìm kiếm phác đồ") {
        $.get(url + "admin/getViewSearch", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Thông tin khảo sát ý kiến bệnh nhân") {
        $.get(url + "admin/getViewInformationSurveys", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if ($(this).find("a").text().trim() === "Thống kê và xem danh sách khảo sát") {
        $.get(url + "admin/getViewStatistics", function (data) {
            $("div.page-container").empty().append(data);
        })
    }
});
var languageOptions = {
    "decimal": "",
    "emptyTable": "Không có dữ liệu trên bảng",
    "info": "Hiển thị từ _START_ đến _END_ trong _TOTAL_ hàng",
    "infoEmpty": "Hiển thị từ 0 đến 0 trong 0 hàng",
    "infoFiltered": "(Lọc từ _MAX_ hàng)",
    "infoPostFix": "",
    "thousands": ",",
    "lengthMenu": "Hiển thị _MENU_ hàng",
    "loadingRecords": "Đang tải ...",
    "processing": "Đang xử lý ...",
    "search": "Tìm Kiếm:",
    "zeroRecords": "Không tìm thấy hàng phù hợp",
    "paginate": {
        "first": "Đầu",
        "last": "Cuối",
        "next": "Tiếp",
        "previous": "Lùi"
    },
    "aria": {
        "sortAscending": ": Nhấp vào để xếp cột tăng dần",
        "sortDescending": ": Nhấp vào để xếp cột giảm dần"
    }
};