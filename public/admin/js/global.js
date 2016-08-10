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
    if($(this).find("a").text().trim()==="Chức vụ"){
        $.get(url + "admin/getViewPosition",function (data) {
            $("div.page-container").empty().append(data);
        })
    };
   if($(this).find("a").text().trim()==="Người dùng"){
       $.get(url + "admin/getViewUser",function (data) {
            $("div.page-container").empty().append(data);
       })
   };
    if($(this).find("a").text().trim()==="Bệnh nhân"){
        $.get(url + "admin/getViewPatient",function (data) {
            $("div.page-container").empty().append(data);
        })
    };
    if($(this).find("a").text().trim()==="Điều trị viên"){
        $.get(url + "admin/getViewTherapist",function (data) {
            $("div.page-container").empty().append(data);
        })
    } if($(this).find("a").text().trim()==="Gói"){
        $.get(url + "admin/getViewPackage",function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if($(this).find("a").text().trim()==="Vị trí điều trị"){
        $.get(url + "admin/getViewLocation",function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if($(this).find("a").text().trim()==="Tỉnh thành"){
        $.get(url + "admin/getViewProvinces",function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if($(this).find("a").text().trim()==="Độ tuổi"){
        $.get(url + "admin/getViewAge",function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if($(this).find("a").text().trim() === "Điều trị chuyên môn"){
        $.get(url + "admin/getViewProTreatment", function(data){
            $("div.page-container").empty().append(data);
        })
    }
});
var Diagnostic = $("nav.navbar.navbar-default.navbar-static-top > div.navbar-default.sidebar > div.sidebar-nav.navbar-collapse > ul#side-menu.nav > li");
Diagnostic.click(function () {
    if($(this).find("a").text().trim()==="Chẩn đoán"){
        $.get(url + "admin/getViewDiagnostic",function (data) {
            $("div.page-container").empty().append(data);
        })
    }
});
var SurveyProgression = $("nav.navbar.navbar-default.navbar-static-top > div.navbar-default.sidebar > div.sidebar-nav.navbar-collapse > ul#side-menu.nav > li > ul.nav.nav-second-level >li>ul.nav.nav-third-level>li");
SurveyProgression.click(function () {
    if($(this).find("a").text().trim()==="Điều trị chuyên môn"){
        $.get(url + "admin/getViewProfessional",function (data) {
            $("div.page-container").empty().append(data);
        })
    }
    if($(this).find("a").text().trim()==="Phác đồ điều trị"){
        $.get(url + "admin/getRegimens",function (data) {
            $("div.page-container").empty().append(data);
        })
    }
});