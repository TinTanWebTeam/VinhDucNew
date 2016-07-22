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
   if($(this).find("a").text().trim()==="Người dùng"){
       $.get(url + "admin/getViewUser",function (data) {
            $("div.page-container").empty().append(data);
       })
   }
});