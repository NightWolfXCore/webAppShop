<?php
namespace router;

use Model\Authentication;
use repository\Database;

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
Routing::getMethod("/settings", "settings");

Routing::getMethod("/test", "testpage");

Routing::postMethod("/login", Authentication::class, "login", $_POST);
Routing::postMethod("/register", Authentication::class, "register", $_POST);
Routing::postMethod("/logout", Authentication::class, "logout", $_POST = []);

Routing::action();
?>