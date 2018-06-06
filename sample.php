<?php

require_once "ClassSample.php";

print_r(ClassSample::getUserInfo(1)); // read DB
print_r(ClassSample::getUserInfo(1)); // read cache
print_r(ClassSample::getUserInfo(2)); // read DB

ClassSample::setUserInfo(1, ["name" => "john"]);

print_r(ClassSample::getUserInfo(1)); // read DB
print_r(ClassSample::getUserInfo(1)); // read cache
print_r(ClassSample::getUserInfo(2)); // read cache

ClassSample::deleteUserInfo(2);

print_r(ClassSample::getUserInfo(1)); // read cache
print_r(ClassSample::getUserInfo(2)); // read DB
print_r(ClassSample::getUserInfo(2)); // read cache
