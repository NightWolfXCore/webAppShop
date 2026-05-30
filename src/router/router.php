<?php
namespace router;

use Model\Authentication;
use repository\Database;

global $app;

Routing::getMethod("/", "main");
Routing::getMethod("/catalog", "catalog");
Routing::getMethod("/about", "about");
Routing::getMethod("/partners", "partners");
Routing::getMethod("/delivery", "delivery");
Routing::getMethod("/faq", "faq");
Routing::getMethod("/contacts", "contacts");
Routing::getMethod("/privacy", "privacy");
Routing::getMethod("/agreement", "agreement");

Routing::getMethod("/auth", "login");
Routing::getMethod("/registerNewUser", "register");
Routing::getMethod("/recoveryPass", "recoveryPass");
Routing::getMethod("/profile/settings", "settings");
Routing::getMethod("/cart", "cart");

Routing::getMethod("/myorders", "myOrders");
Routing::getMethod("/myorders/orderdetails", "orderdetails");
Routing::getMethod("/order/success", "orderSuccess");


Routing::getMethod("/admin", "admin/admin-orders");
Routing::getMethod("/admin/orders", "admin/admin-orders");
Routing::getMethod("/admin/orders/orderdetails", "orderdetails");

Routing::getMethod("/problem/notFoundPage", "problemPage");
Routing::getMethod("/problem/accessDenied", "problemPage");
Routing::getMethod("/problem/serverProblem", "problemPage");
Routing::getMethod("/test", "testpage");

Routing::postMethod("/login", $app->authentication, "login", $_POST);
Routing::postMethod("/register", $app->authentication, "register", $_POST);
Routing::postMethod("/logout", $app->authentication, "logout", $_POST);

Routing::postMethod("/profile/settings/change", $app->userRepository, "updateUser", $_POST);
Routing::postMethod("/cart/submit", $app->orders, "submitOrder", $_POST);

Routing::postMethod("/admin/orders/statuschange", $app->orders, "changeStatusOrder", $_POST);
Routing::postMethod("/admin/orders/deleteorder", $app->orders, "deleteOrder", $_POST);


Routing::action();
?>