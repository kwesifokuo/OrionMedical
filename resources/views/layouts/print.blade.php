
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>{{   $mycompany->legal_name }}</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  
  <link rel="stylesheet" href="{{ asset('/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('/css/font.css')}}" type="text/css" />

<style type="text/css">
  
@import url(http://fonts.googleapis.com/css?family=Montserrat:400,700);

html {
  background-color: #f7f7f7;
  /*overflow-x: hidden;*/
}
body {
  font-family: "Montserrat","Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 13px;
  color: #717171;
  background-color: transparent;
  -webkit-font-smoothing: antialiased;
}
.h1,
.h2,
.h3,
.h4,
.h5,
.h6 {
  margin: 0;
}
a {
  color: #2e3e4e;
  text-decoration: none;
}
a:hover,
a:focus {
  color: #4a647e;
  text-decoration: none;
}
.badge {
  background-color: #bebebe;
}
.badge.up {
  position: relative;
  top: -10px;
  padding: 3px 6px;
}
.badge-sm {
  font-size: 85%;
  padding: 2px 5px !important;
}
label {
  font-weight: normal;
}
.label-sm {
  padding-top: 0;
  padding-bottom: 0;
}
.text-primary {
  color: #65bd77;
}
.text-info {
  color: #4cc0c1;
}
.text-success {
  color: #8ec165;
}
.text-warning {
  color: #ffc333;
}
.text-danger {
  color: #fb6b5b;
}
.text-light {
  color: #f1f1f1;
}
.text-white {
  color: #fff;
}
.text-dark {
  color: #2e3e4e;
}
.text-muted {
  color: #979797;
}
small {
  font-size: 90%;
}
.badge-white {
  background-color: transparent;
  border: 1px solid rgba(255,255,255,0.35);
  padding: 2px 6px;
}
.badge-hollow {
  background-color: transparent;
  border: 1px solid rgba(0,0,0,0.15);
  color: inherit;
}
.caret-white {
  border-top-color: #fff;
  border-top-color: rgba(255,255,255,0.65);
}
a:hover .caret-white {
  border-top-color: #fff;
}
.tooltip-inner {
  background-color: rgba(0,0,0,0.9);
  background-color: #2e3e4e;
}
.tooltip.top .tooltip-arrow {
  border-top-color: rgba(0,0,0,0.9);
  border-top-color: #2e3e4e;
}
.tooltip.right .tooltip-arrow {
  border-right-color: rgba(0,0,0,0.9);
  border-right-color: #2e3e4e;
}
.tooltip.bottom .tooltip-arrow {
  border-bottom-color: rgba(0,0,0,0.9);
  border-bottom-color: #2e3e4e;
}
.tooltip.left .tooltip-arrow {
  border-left-color: rgba(0,0,0,0.9);
  border-left-color: #2e3e4e;
}
.popover-content {
  font-size: 12px;
  line-height: 1.5;
}
.progress-xs {
  height: 6px;
}
.progress-sm {
  height: 10px;
}
.progress-sm .progress-bar {
  font-size: 10px;
  line-height: 1em;
}
.breadcrumb {
  background-color: #fff;
  border: 1px solid #e8e8e8;
  padding-left: 10px;
  font-size: 12px;
  margin-bottom: 10px;
}
.breadcrumb a {
  color: #999;
}
.accordion-group,
.accordion-inner {
  border-color: #e8e8e8;
  border-radius: 2px;
}
.alert {
  font-size: 85%;
  box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
}
.alert .close i {
  font-size: 12px;
  font-weight: normal;
  display: block;
}
.form-control {
  border-color: #d9d9d9;
  border-radius: 2px;
}
.form-control,
.form-control:focus {
  -webkit-box-shadow: none;
  box-shadow: none;
}
.form-control:focus {
  border-color: #4cc0c1;
}
.input-s-sm {
  width: 120px;
}
.input-s {
  width: 200px;
}
.input-s-lg {
  width: 250px;
}
.input-group-addon {
  border-color: #d9d9d9;
  background-color: #f9f9f9;
}
.list-group {
  border-radius: 2px;
}
.list-group.no-radius .list-group-item {
  border-radius: 0 !important;
}
.list-group.no-borders .list-group-item {
  border: none;
}
.list-group.no-border .list-group-item {
  border-width: 1px 0;
}
.list-group.no-bg .list-group-item {
  background-color: transparent;
}
.list-group-item {
  border-color: #e8e8e8;
  padding-right: 15px;
}
.list-group-item.media {
  margin-top: 0;
}
.list-group-item.active {
  color: #fff;
  border-color: #65bd77 !important;
  background-color: #65bd77 !important;
}
.list-group-item.active .text-muted {
  color: #d0ebd6;
}
.list-group-item.active a {
  color: #fff;
}
.list-group-alt .list-group-item:nth-child(2n+2) {
  background-color: rgba(0,0,0,0.02);
}
.list-group-lg .list-group-item {
  padding-top: 15px;
  padding-bottom: 15px;
}
.list-group-sp .list-group-item {
  margin-bottom: 5px;
  border-radius: 3px;
}
.list-group-item > .badge {
  margin-right: 0;
}
.list-group-item > .fa-chevron-right {
  float: right;
  margin-top: 4px;
  margin-right: -5px;
}
.list-group-item > .fa-chevron-right + .badge {
  margin-right: 5px;
}
.nav-pills.no-radius > li > a {
  border-radius: 0;
}
.nav-pills > li.active > a {
  color: #fff !important;
  background-color: #4cc0c1 !important;
}
.nav.nav-sm > li > a {
  padding: 6px 8px;
}
.nav .avatar {
  width: 30px;
  margin-top: -5px;
  margin-right: 5px;
}
.panel {
  border-radius: 2px;
}
.panel.panel-default {
  border-color: #e8e8e8;
}
.panel.panel-default > .panel-heading,
.panel.panel-default > .panel-footer {
  border-color: #e8e8e8;
}
.panel .list-group-item {
  border-color: #f0f0f0;
}
.panel.no-borders {
  border-width: 0;
}
.panel.no-borders .panel-heading,
.panel.no-borders .panel-footer {
  border-width: 0;
}
.panel .table td,
.panel .table th {
  padding: 6px 15px;
  border-top: 1px solid #f1f1f1;
}
.panel .table thead > tr > th {
  border-bottom: 1px solid #ebebeb;
}
.panel .table-striped > tbody > tr:nth-child(odd) > td,
.panel .table-striped > tbody > tr:nth-child(odd) > th {
  background-color: #f9f9f9;
}
.panel .table-striped > thead th {
  background: #f5f5f5;
  border-right: 1px solid #f1f1f1;
}
.panel .table-striped > thead th:last-child {
  border-right: none;
}
.panel-heading {
  border-radius: 2px 2px 0 0;
}
.panel-heading.no-border {
  margin: -1px -1px 0 -1px;
  border: none;
}
.panel-heading .nav {
  font-size: 13px;
  margin: -10px -15px -11px;
  border: none;
}
.panel-heading .nav > li > a {
  border-radius: 0;
  margin: 0;
  border-width: 0;
}
.panel-heading .nav-tabs.nav-justified {
  width: auto;
}
.panel-heading .nav-tabs.nav-justified > li:first-child > a,
.panel-heading .nav-tabs.pull-left > li:first-child > a {
  border-radius: 2px 0 0 0;
}
.panel-heading .nav-tabs.nav-justified > li:last-child > a,
.panel-heading .nav-tabs.pull-right > li:last-child > a {
  border-radius: 0 2px 0 0;
}
.panel-heading .nav-tabs > li > a {
  line-height: 1.5;
}
.panel-heading .nav-tabs > li > a:hover,
.panel-heading .nav-tabs > li > a:focus {
  border-width: 0;
  background: transparent;
  border-color: transparent;
}
.panel-heading .nav-tabs > li.active > a,
.panel-heading .nav-tabs > li.active > a:hover,
.panel-heading .nav-tabs > li.active > a:focus {
  color: #717171;
  background: #fff;
}
.panel-heading .list-group {
  background: transparent;
}
.panel-footer {
  border-radius: 0 0 2px 2px;
}
.panel-group .panel-heading + .panel-collapse .panel-body {
  border-top: 1px solid #eaedef;
}
.open {
  z-index: 1050;
  position: relative;
}
.dropdown-menu {
  font-size: 13px;
  border-radius: 2px;
  -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  border: 1px solid #ddd;
  border: 1px solid rgba(0,0,0,0.1);
}
.dropdown-menu.pull-left {
  left: 100%;
}
.dropdown-menu > .panel {
  border: none;
  margin: -5px 0;
}
.dropdown-menu > li > a {
  padding: 5px 15px;
}
.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus,
.dropdown-menu > .active > a,
.dropdown-menu > .active > a:hover,
.dropdown-menu > .active > a:focus {
  background-image: none;
  filter: none;
  background-color: #f1f1f1 !important;
  color: #717171;
}
.dropdown-header {
  padding: 5px 15px;
}
.dropdown-submenu {
  position: relative;
}
.dropdown-submenu:hover > a,
.dropdown-submenu:focus > a {
  background-color: #f1f1f1 !important;
  color: #717171;
}
.dropdown-submenu:hover > .dropdown-menu,
.dropdown-submenu:focus > .dropdown-menu {
  display: block;
}
.dropdown-submenu.pull-left {
  float: none !important;
}
.dropdown-submenu.pull-left > .dropdown-menu {
  left: -100%;
  margin-left: 10px;
}
.dropdown-submenu .dropdown-menu {
  left: 100%;
  top: 0;
  margin-top: -6px;
  margin-left: -1px;
}
.dropup .dropdown-submenu > .dropdown-menu {
  top: auto;
  bottom: 0;
}
.dropdown-select > li > a input {
  position: absolute;
  left: -9999em;
}
.carousel-control {
  width: 40px;
  color: #999;
  text-shadow: none;
}
.carousel-control:hover,
.carousel-control:focus {
  color: #ccc;
  text-decoration: none;
  opacity: 0.9;
  filter: alpha(opacity=90);
}
.carousel-control.left,
.carousel-control.right {
  background-image: none;
  filter: none;
}
.carousel-control i {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 5;
  display: inline-block;
  width: 20px;
  height: 20px;
  margin-top: -10px;
  margin-left: -10px;
}
.carousel-indicators.out {
  bottom: -5px;
}
.carousel-indicators li {
  -webkit-transition: background-color .25s;
  transition: background-color .25s;
  background: #ddd;
  background-color: rgba(0,0,0,0.2);
  border: none;
}
.carousel-indicators .active {
  background: #f0f0f0;
  background-color: rgba(200,200,200,0.2);
  width: 10px;
  height: 10px;
  margin: 1px;
}
.carousel.carousel-fade .item {
  -webkit-transition: opacity .25s;
  transition: opacity .25s;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  backface-visibility: hidden;
  opacity: 0;
  filter: alpha(opacity=0);
}
.carousel.carousel-fade .active {
  opacity: 1;
  filter: alpha(opacity=1);
}
.carousel.carousel-fade .active.left,
.carousel.carousel-fade .active.right {
  left: 0;
  z-index: 2;
  opacity: 0;
  filter: alpha(opacity=0);
}
.carousel.carousel-fade .next,
.carousel.carousel-fade .prev {
  left: 0;
  z-index: 1;
}
.carousel.carousel-fade .carousel-control {
  z-index: 3;
}
.col-lg-2-4 {
  position: relative;
  min-height: 1px;
  padding-left: 15px;
  padding-right: 15px;
}
.col-0 {
  clear: left;
}
.row.no-gutter {
  margin-left: 0;
  margin-right: 0;
}
.no-gutter [class*="col"] {
  padding: 0;
}
.modal-backdrop {
  background-color: #2e3e4e;
}
.modal-backdrop.in {
  opacity: 0.8;
  filter: alpha(opacity=80);
}
.modal-over {
  width: 100%;
  height: 100%;
  position: relative;
  background: #2e3e4e;
}
.modal-center {
  position: absolute;
  left: 50%;
  top: 50%;
}
.modal-content {
  -webkit-box-shadow: 0 2px 10px rgba(0,0,0,0.25);
  box-shadow: 0 2px 10px rgba(0,0,0,0.25);
}
.icon-muted {
  color: #ccc;
}
.navbar-inverse .navbar-collapse,
.navbar-inverse .navbar-form {
  border-color: transparent;
}
@media (min-width: 768px) {
  .app,
  .app body {
    width: 100%;
    height: 100%;
    /*overflow: hidden;*/
  }
  .app .hbox.stretch {
    height: 100%;
  }
  .app .vbox > section,
  .app .vbox > footer {
    position: absolute;
  }
  .app .vbox.flex > section > section {
    overflow: auto;
  }
  .hbox {
    display: table;
    table-layout: fixed;
    border-spacing: 0;
    width: 100%;
  }
  .hbox > aside,
  .hbox > section {
    display: table-cell;
    vertical-align: top;
    height: 100%;
    padding: 0;
    float: none;
  }
  .hbox > aside.show,
  .hbox > aside.hidden-sm,
  .hbox > section.show,
  .hbox > section.hidden-sm {
    display: table-cell !important;
  }
  .vbox {
    display: table;
    border-spacing: 0;
    position: relative;
    height: 100%;
    width: 100%;
  }
  .vbox > section,
  .vbox > footer {
    top: 0;
    bottom: 0;
    width: 100%;
  }
  .vbox > header ~ section {
    top: 50px;
  }
  .vbox > section.w-f {
    bottom: 50px;
  }
  .vbox > footer {
    top: auto;
    z-index: 1000;
  }
  .vbox > footer ~ section {
    bottom: 50px;
  }
  .vbox.flex > header,
  .vbox.flex > section,
  .vbox.flex > footer {
    position: inherit;
  }
  .vbox.flex > section {
    display: table-row;
    height: 100%;
  }
  .vbox.flex > section > section {
    position: relative;
    height: 100%;
    -webkit-overflow-scrolling: touch;
  }
  .ie .vbox.flex > section > section {
    display: table-cell;
  }
  .vbox.flex > section > section > section {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
  }
  .aside-xs {
    width: 48px;
  }
  .aside {
    width: 180px;
  }
  .aside-sm {
    width: 150px;
  }
  .aside-md {
    width: 220px;
  }
  .aside-lg {
    width: 250px;
  }
  .aside-xl {
    width: 300px;
  }
  .aside-xxl {
    width: 450px;
  }
  .scrollable {
    -webkit-overflow-scrolling: touch;
  }
  ::-webkit-scrollbar {
    width: 7px;
    height: 7px;
  }
  ::-webkit-scrollbar-thumb {
    background-color: rgba(50,50,50,0.3);
  }
  ::-webkit-scrollbar-thumb:hover {
    background-color: rgba(50,50,50,0.6);
  }
  ::-webkit-scrollbar-track {
    background-color: rgba(50,50,50,0.1);
  }
  ::-webkit-scrollbar-track:hover {
    background-color: rgba(50,50,50,0.2);
  }
}
.hbox > aside,
.hbox > section {
  padding: 0 !important;
}
.header,
.footer {
  min-height: 50px;
  padding: 0 15px;
}
.header > p,
.footer > p {
  margin-top: 15px;
  display: inline-block;
}
.header > .btn,
.header > .btn-group,
.header > .btn-toolbar,
.footer > .btn,
.footer > .btn-group,
.footer > .btn-toolbar {
  margin-top: 10px;
}
.header > .btn-lg,
.footer > .btn-lg {
  margin-top: 0;
}
.header .nav-tabs,
.footer .nav-tabs {
  border: none;
  margin-left: -15px;
  margin-right: -15px;
}
.header .nav-tabs > li a,
.footer .nav-tabs > li a {
  border: none !important;
  border-radius: 0;
  padding-top: 15px;
  padding-bottom: 15px;
  line-height: 20px;
}
.header .nav-tabs > li a:hover,
.header .nav-tabs > li a:focus,
.footer .nav-tabs > li a:hover,
.footer .nav-tabs > li a:focus {
  background-color: transparent;
}
.header .nav-tabs > li.active a,
.footer .nav-tabs > li.active a {
  color: #717171;
}
.header .nav-tabs > li.active a,
.header .nav-tabs > li.active a:hover,
.footer .nav-tabs > li.active a,
.footer .nav-tabs > li.active a:hover {
  background-color: #f7f7f7;
}
.header .nav-tabs.nav-white > li.active a,
.header .nav-tabs.nav-white > li.active a:hover,
.footer .nav-tabs.nav-white > li.active a,
.footer .nav-tabs.nav-white > li.active a:hover {
  background-color: #fff;
}
.header.navbar,
.footer.navbar {
  min-height: 0;
  border-radius: 0;
  border: none;
  margin-bottom: 0;
  padding: 0;
}
.scrollable {
  overflow-x: hidden;
  overflow-y: auto;
}
.no-touch .scrollable.hover {
  /*overflow-y: hidden;*/
}
.no-touch .scrollable.hover:hover {
  overflow: visible;
  overflow-y: auto;
}
/*
 {
  html,
  body,
  .hbox,
  .vbox {
    height: auto;
  }
  .vbox > section,
  .vbox > footer {
    position: relative;
  }
}*/
/*@media print {
      body, html, #wrapper,.page {
          width: 100%;
          overflow: visible;
          display: inline-block;

      }

     
}*/

      
.slimScrollBar {
  border-radius: 0 !important;
}
.navbar-header {
  position: relative;
}
.navbar-header > .btn {
  position: absolute;
  font-size: 1.3em;
  padding: 9px 16px;
  line-height: 30px;
  left: 0;
}
.navbar-header .navbar-brand + .btn {
  right: 0;
  top: 0;
  left: auto;
}
.navbar-brand {
  float: none;
  text-align: center;
  font-size: 20px;
  line-height: 50px;
  display: inline-block;
  padding: 0 15px;
  font-weight: bold;
}
.navbar-brand:hover {
  text-decoration: none;
}
.navbar-brand img {
  max-height: 20px;
  margin-top: -4px;
  vertical-align: middle;
}
.nav-primary {
  border-bottom: 1px solid rgba(255,255,255,0.05);
}
.bg-light .nav-primary {
  border-bottom: 1px solid #e9e9e9;
}
.nav-primary li {
  line-height: 1.5;
}
.nav-primary li > a > i {
  margin: -12px -15px;
  line-height: 44px;
  width: 44px;
  float: left;
  margin-right: 10px;
  font-size: 14px;
  border-right: 1px solid rgba(255,255,255,0.05);
  text-align: center;
  position: relative;
  overflow: hidden;
}
.nav-primary li > a > i:before {
  position: relative;
  z-index: 2;
}
.nav-primary li > a > i > b {
  position: absolute;
  left: -42px;
  width: 100%;
  top: 0;
  bottom: 0;
  z-index: 0;
  -webkit-transition: left .25s;
  transition: left .25s;
}
.nav-primary ul.nav > li > a {
  padding: 11px 15px;
  position: relative;
  font-weight: bold;
  font-size: 14px;
  border-top: 1px solid transparent;
  border-color: rgba(255,255,255,0.05);
  transition: color .3s ease-in-out 0s;
}
.no-borders .nav-primary ul.nav > li > a {
  border-width: 0 !important;
}
.nav-primary ul.nav > li > a > .badge {
  font-size: 11px;
  padding: 3px 6px;
  margin-top: 2px;
}
.bg-light .nav-primary ul.nav > li > a {
  color: #717171 !important;
  border-color: #ececec;
}
.bg-light .nav-primary ul.nav > li > a > i {
  color: #a4a4a4;
  border-right: 1px solid #ececec;
}
.nav-primary ul.nav > li > a.active .text {
  display: none;
}
.nav-primary ul.nav > li > a.active .text-active {
  display: inline-block !important;
}
.nav-primary ul.nav > li:hover > a,
.nav-primary ul.nav > li:focus > a,
.nav-primary ul.nav > li > a:hover,
.nav-primary ul.nav > li > a:focus,
.nav-primary ul.nav > li > a:active,
.nav-primary ul.nav > li.active > a {
  color: #fff;
  background-color: inherit;
  background-color: rgba(0,0,0,0.05) !important;
  text-shadow: none;
}
.nav-primary ul.nav > li:hover > a > i.icon,
.nav-primary ul.nav > li:focus > a > i.icon,
.nav-primary ul.nav > li > a:hover > i.icon,
.nav-primary ul.nav > li > a:focus > i.icon,
.nav-primary ul.nav > li > a:active > i.icon,
.nav-primary ul.nav > li.active > a > i.icon {
  color: #fff;
}
.nav-primary ul.nav > li:hover > a > i > b,
.nav-primary ul.nav > li:focus > a > i > b,
.nav-primary ul.nav > li > a:hover > i > b,
.nav-primary ul.nav > li > a:focus > i > b,
.nav-primary ul.nav > li > a:active > i > b,
.nav-primary ul.nav > li.active > a > i > b {
  left: 0 !important;
}
.nav-primary ul.nav > li li a {
  font-weight: normal;
  text-transform: none;
  font-size: 13px;
}
.nav-primary ul.nav > li.active > ul {
  display: block;
}
.nav-primary ul.nav ul {
  display: none;
}
/*@media (min-width: 768px) {
  .visible-nav-xs {
    display: none;
  }
  .nav-xs {
    width: 55px;
  }
  .nav-xs .slimScrollDiv,
  .nav-xs .slim-scroll {
    overflow: visible !important;
  }
  .nav-xs .slimScrollBar,
  .nav-xs .slimScrollRail {
    display: none !important;
  }
  .nav-xs .scrollable {
    overflow: visible;
  }
  .nav-xs .nav-primary > ul > li > a {
    position: relative;
    padding: 0;
    font-size: 11px;
    text-align: center;
    height: 55px;
    overflow-y: hidden;
    border: none;
  }
  .nav-xs .nav-primary > ul > li > a span {
    color: #fff !important;
    display: table-cell;
    vertical-align: middle;
    height: 55px;
    width: 55px;
    position: relative;
    z-index: 2;
  }
  .nav-xs .nav-primary > ul > li > a span.pull-right {
    display: none !important;
  }
  .nav-xs .nav-primary > ul > li > a i {
    width: auto;
    float: none;
    display: block;
    font-size: 19px;
    margin: 0;
    line-height: 55px;
    border: none !important;
    color: #fff !important;
    overflow: visible;
    -webkit-transition: margin-top 0.2s;
    transition: margin-top 0.2s;
  }
  .nav-xs .nav-primary > ul > li > a i b {
    left: 0 !important;
    -webkit-transition: top 0.2s;
    transition: top 0.2s;
  }
  .nav-xs .nav-primary > ul > li > a .badge {
    position: absolute;
    right: 6px;
    top: 4px;
    z-index: 3;
  }
  .nav-xs .nav-primary > ul > li:hover > a i,
  .nav-xs .nav-primary > ul > li:focus > a i,
  .nav-xs .nav-primary > ul > li:active > a i,
  .nav-xs .nav-primary > ul > li.active > a i {
    margin-top: -55px;
  }
  .nav-xs .nav-primary > ul > li:hover > a i b,
  .nav-xs .nav-primary > ul > li:focus > a i b,
  .nav-xs .nav-primary > ul > li:active > a i b,
  .nav-xs .nav-primary > ul > li.active > a i b {
    height: 55px;
    top: 55px;
  }
  .nav-xs .nav-primary > ul ul {
    display: none !important;
    position: absolute;
    left: 100%;
    top: 0;
    z-index: 1050;
    width: 220px;
    -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border: 1px solid #ddd;
    border: 1px solid rgba(0,0,0,0.1);
    background-clip: padding-box;
  }
  .nav-xs .nav-primary li:hover > ul,
  .nav-xs .nav-primary li:focus > ul,
  .nav-xs .nav-primary li:active > ul {
    display: block !important;
  }
  .nav-xs.nav-xs-right .nav-primary > ul ul {
    left: auto;
    right: 100%;
  }
  .nav-xs > .vbox > .header,
  .nav-xs > .vbox > .footer {
    padding: 0 12px;
  }
  .nav-xs .hidden-nav-xs {
    display: none;
  }
  .nav-xs .visible-nav-xs {
    display: inherit;
  }
  .nav-xs .nav-user {
    padding: 9px 0;
  }
  .nav-xs .nav-user .avatar {
    float: none !important;
    margin-right: 0;
  }
  .nav-xs .nav-user .dropdown > a {
    display: block;
    text-align: center;
  }
  .nav-xs .navbar-header {
    float: none;
  }
  .nav-xs .navbar-brand {
    display: block;
    padding: 0;
  }
  .nav-xs .navbar-brand img {
    margin-right: 0;
  }
  .nav-xs .navbar {
    padding: 0;
  }
}*/
/*@media (max-width: 767px) {
  .navbar-fixed-top-xs {
    position: fixed;
    left: 0;
    width: 100%;
    z-index: 1100;
  }
  .navbar-fixed-top-xs + * {
    padding-top: 50px;
  }
  html,
  body {
    min-height: 100%;
    overflow-x: hidden;
  }
  .open,
  .open body {
    height: 100%;
  }
  .nav-primary .dropdown-menu {
    position: relative;
    float: none;
    left: 0;
    margin-left: 0;
    padding: 0;
  }
  .nav-primary .dropdown-menu a {
    padding: 15px;
    border-bottom: 1px solid #eee;
  }
  .nav-primary .dropdown-menu li:last-child a {
    border-bottom: none;
  }
  .navbar-header {
    text-align: center;
  }
  .nav-user {
    margin: 0;
    padding: 15px;
  }
  .nav-user.open {
    display: inherit !important;
  }
  .nav-user .dropdown-menu {
    display: block;
    position: static;
    float: none;
  }
  .nav-user .dropdown > a {
    display: block;
    text-align: center;
    font-size: 18px;
    padding-bottom: 10px;
  }
  .nav-user .avatar {
    width: 160px !important;
    float: none !important;
    display: block;
    margin: 20px auto;
    padding: 5px;
    background-color: rgba(255,255,255,0.1);
    position: relative;
  }
  .nav-user .avatar:before {
    content: "";
    position: absolute;
    left: 5px;
    right: 5px;
    bottom: 5px;
    top: 5px;
    border: 4px solid #fff;
    border-radius: 500px;
  }
  .nav-off-screen {
    position: absolute;
    left: 0;
    top: 0px;
    bottom: 0;
    width: 75%;
    visibility: visible;
    overflow-x: hidden;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
  }
  .nav-off-screen .nav-primary {
    display: block !important;
  }
  .nav-off-screen .navbar-fixed-top-xs {
    width: 75%;
  }
  .nav-off-screen.push-right .navbar-fixed-top-xs {
    left: 25%;
  }
  .nav-off-screen.push-right {
    left: auto;
    right: 0;
  }
  .nav-off-screen.push-right + * {
    -webkit-transform: translate3d(-75%,0px,0px);
    transform: translate3d(-75%,0px,0px);
  }
  .nav-off-screen + * {
    background-color: #f7f7f7;
    -webkit-transition: -webkit-transform 0.2s ease-in-out;
    -moz-transition: -moz-transform 0.2s ease-in-out;
    -o-transition: -o-transform 0.2s ease-in-out;
    transition: transform 0.2s ease-in-out;
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
    -webkit-transform: translate3d(0px,0px,0px);
    transform: translate3d(0px,0px,0px);
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transform: translate3d(75%,0px,0px);
    transform: translate3d(75%,0px,0px);
    overflow: hidden;
    position: relative;
    top: 0;
    left: 0;
    height: 100%;
    z-index: 2;
  }
  .nav-off-screen + * .nav-off-screen-block {
    display: block !important;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: 1950;
  }
  .navbar + section .nav-off-screen {
    top: 50px;
  }
  .slimScrollDiv,
  .slim-scroll {
    overflow: visible !important;
    height: auto !important;
  }
  .slimScrollBar,
  .slimScrollRail {
    display: none !important;
  }
}*/
.arrow {
  border-width: 8px;
  z-index: 10;
}
.arrow,
.arrow:after {
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-color: transparent;
  border-style: solid;
}
.arrow:after {
  border-width: 7px;
  content: "";
}
.arrow.top {
  left: 50%;
  margin-left: -8px;
  border-top-width: 0;
  border-bottom-color: #eee;
  border-bottom-color: rgba(0,0,0,0.1);
  top: -8px;
}
.arrow.top:after {
  content: " ";
  top: 1px;
  margin-left: -7px;
  border-top-width: 0;
  border-bottom-color: #fff;
}
.arrow.right {
  top: 50%;
  right: -8px;
  margin-top: -8px;
  border-right-width: 0;
  border-left-color: #eee;
  border-left-color: rgba(0,0,0,0.1);
}
.arrow.right:after {
  content: " ";
  right: 1px;
  border-right-width: 0;
  border-left-color: #fff;
  bottom: -7px;
}
.arrow.bottom {
  left: 50%;
  margin-left: -8px;
  border-bottom-width: 0;
  border-top-color: #eee;
  border-top-color: rgba(0,0,0,0.1);
  bottom: -8px;
}
.arrow.bottom:after {
  content: " ";
  bottom: 1px;
  margin-left: -7px;
  border-bottom-width: 0;
  border-top-color: #fff;
}
.arrow.left {
  top: 50%;
  left: -8px;
  margin-top: -8px;
  border-left-width: 0;
  border-right-color: #eee;
  border-right-color: rgba(0,0,0,0.1);
}
.arrow.left:after {
  content: " ";
  left: 1px;
  border-left-width: 0;
  border-right-color: #fff;
  bottom: -7px;
}
.btn-link {
  color: #717171;
}
.btn-link.active {
  webkit-box-shadow: none;
  box-shadow: none;
}
.btn-default {
  color: #717171 !important;
  background-color: #fafafa;
  border-color: #dadada;
  border-bottom-color: #ccc;
  -webkit-box-shadow: 0 1px 1px rgba(90,90,90,0.1);
  box-shadow: 0 1px 1px rgba(90,90,90,0.1);
}
.btn-default:hover,
.btn-default:focus,
.btn-default:active,
.btn-default.active,
.open .dropdown-toggle.btn-default {
  color: #717171 !important;
  background-color: #ededed;
  border-color: #c6c6c6;
}
.btn-default:active,
.btn-default.active,
.open .dropdown-toggle.btn-default {
  background-image: none;
}
.btn-default.disabled,
.btn-default.disabled:hover,
.btn-default.disabled:focus,
.btn-default.disabled:active,
.btn-default.disabled.active,
.btn-default[disabled],
.btn-default[disabled]:hover,
.btn-default[disabled]:focus,
.btn-default[disabled]:active,
.btn-default[disabled].active,
fieldset[disabled] .btn-default,
fieldset[disabled] .btn-default:hover,
fieldset[disabled] .btn-default:focus,
fieldset[disabled] .btn-default:active,
fieldset[disabled] .btn-default.active {
  background-color: #fafafa;
  border-color: #dadada;
}
.btn-default.btn-bg {
  border-color: rgba(0,0,0,0.1);
  background-clip: padding-box;
}
.btn-primary {
  color: #fff !important;
  background-color: #65bd77;
  border-color: #65bd77;
}
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active,
.btn-primary.active,
.open .dropdown-toggle.btn-primary {
  color: #fff !important;
  background-color: #53b567;
  border-color: #4bae5f;
}
.btn-primary:active,
.btn-primary.active,
.open .dropdown-toggle.btn-primary {
  background-image: none;
}
.btn-primary.disabled,
.btn-primary.disabled:hover,
.btn-primary.disabled:focus,
.btn-primary.disabled:active,
.btn-primary.disabled.active,
.btn-primary[disabled],
.btn-primary[disabled]:hover,
.btn-primary[disabled]:focus,
.btn-primary[disabled]:active,
.btn-primary[disabled].active,
fieldset[disabled] .btn-primary,
fieldset[disabled] .btn-primary:hover,
fieldset[disabled] .btn-primary:focus,
fieldset[disabled] .btn-primary:active,
fieldset[disabled] .btn-primary.active {
  background-color: #65bd77;
  border-color: #65bd77;
}
.btn-success {
  color: #fff !important;
  background-color: #8ec165;
  border-color: #8ec165;
}
.btn-success:hover,
.btn-success:focus,
.btn-success:active,
.btn-success.active,
.open .dropdown-toggle.btn-success {
  color: #fff !important;
  background-color: #81ba53;
  border-color: #79b549;
}
.btn-success:active,
.btn-success.active,
.open .dropdown-toggle.btn-success {
  background-image: none;
}
.btn-success.disabled,
.btn-success.disabled:hover,
.btn-success.disabled:focus,
.btn-success.disabled:active,
.btn-success.disabled.active,
.btn-success[disabled],
.btn-success[disabled]:hover,
.btn-success[disabled]:focus,
.btn-success[disabled]:active,
.btn-success[disabled].active,
fieldset[disabled] .btn-success,
fieldset[disabled] .btn-success:hover,
fieldset[disabled] .btn-success:focus,
fieldset[disabled] .btn-success:active,
fieldset[disabled] .btn-success.active {
  background-color: #8ec165;
  border-color: #8ec165;
}
.btn-info {
  color: #fff !important;
  background-color: #4cc0c1;
  border-color: #4cc0c1;
}
.btn-info:hover,
.btn-info:focus,
.btn-info:active,
.btn-info.active,
.open .dropdown-toggle.btn-info {
  color: #fff !important;
  background-color: #3fb4b5;
  border-color: #3ba9a9;
}
.btn-info:active,
.btn-info.active,
.open .dropdown-toggle.btn-info {
  background-image: none;
}
.btn-info.disabled,
.btn-info.disabled:hover,
.btn-info.disabled:focus,
.btn-info.disabled:active,
.btn-info.disabled.active,
.btn-info[disabled],
.btn-info[disabled]:hover,
.btn-info[disabled]:focus,
.btn-info[disabled]:active,
.btn-info[disabled].active,
fieldset[disabled] .btn-info,
fieldset[disabled] .btn-info:hover,
fieldset[disabled] .btn-info:focus,
fieldset[disabled] .btn-info:active,
fieldset[disabled] .btn-info.active {
  background-color: #4cc0c1;
  border-color: #4cc0c1;
}
.btn-warning {
  color: #fff !important;
  background-color: #ffc333;
  border-color: #ffc333;
}
.btn-warning:hover,
.btn-warning:focus,
.btn-warning:active,
.btn-warning.active,
.open .dropdown-toggle.btn-warning {
  color: #fff !important;
  background-color: #ffbc1a;
  border-color: #ffb70a;
}
.btn-warning:active,
.btn-warning.active,
.open .dropdown-toggle.btn-warning {
  background-image: none;
}
.btn-warning.disabled,
.btn-warning.disabled:hover,
.btn-warning.disabled:focus,
.btn-warning.disabled:active,
.btn-warning.disabled.active,
.btn-warning[disabled],
.btn-warning[disabled]:hover,
.btn-warning[disabled]:focus,
.btn-warning[disabled]:active,
.btn-warning[disabled].active,
fieldset[disabled] .btn-warning,
fieldset[disabled] .btn-warning:hover,
fieldset[disabled] .btn-warning:focus,
fieldset[disabled] .btn-warning:active,
fieldset[disabled] .btn-warning.active {
  background-color: #ffc333;
  border-color: #ffc333;
}
.btn-danger {
  color: #fff !important;
  background-color: #fb6b5b;
  border-color: #fb6b5b;
}
.btn-danger:hover,
.btn-danger:focus,
.btn-danger:active,
.btn-danger.active,
.open .dropdown-toggle.btn-danger {
  color: #fff !important;
  background-color: #fa5542;
  border-color: #fa4733;
}
.btn-danger:active,
.btn-danger.active,
.open .dropdown-toggle.btn-danger {
  background-image: none;
}
.btn-danger.disabled,
.btn-danger.disabled:hover,
.btn-danger.disabled:focus,
.btn-danger.disabled:active,
.btn-danger.disabled.active,
.btn-danger[disabled],
.btn-danger[disabled]:hover,
.btn-danger[disabled]:focus,
.btn-danger[disabled]:active,
.btn-danger[disabled].active,
fieldset[disabled] .btn-danger,
fieldset[disabled] .btn-danger:hover,
fieldset[disabled] .btn-danger:focus,
fieldset[disabled] .btn-danger:active,
fieldset[disabled] .btn-danger.active {
  background-color: #fb6b5b;
  border-color: #fb6b5b;
}
.btn-dark {
  color: #fff !important;
  background-color: #2e3e4e;
  border-color: #2e3e4e;
}
.btn-dark:hover,
.btn-dark:focus,
.btn-dark:active,
.btn-dark.active,
.open .dropdown-toggle.btn-dark {
  color: #fff !important;
  background-color: #25313e;
  border-color: #1f2a34;
}
.btn-dark:active,
.btn-dark.active,
.open .dropdown-toggle.btn-dark {
  background-image: none;
}
.btn-dark.disabled,
.btn-dark.disabled:hover,
.btn-dark.disabled:focus,
.btn-dark.disabled:active,
.btn-dark.disabled.active,
.btn-dark[disabled],
.btn-dark[disabled]:hover,
.btn-dark[disabled]:focus,
.btn-dark[disabled]:active,
.btn-dark[disabled].active,
fieldset[disabled] .btn-dark,
fieldset[disabled] .btn-dark:hover,
fieldset[disabled] .btn-dark:focus,
fieldset[disabled] .btn-dark:active,
fieldset[disabled] .btn-dark.active {
  background-color: #2e3e4e;
  border-color: #2e3e4e;
}
.btn-twitter {
  color: #fff !important;
  background-color: #00c7f7;
  border-color: #00c7f7;
}
.btn-twitter:hover,
.btn-twitter:focus,
.btn-twitter:active,
.btn-twitter.active,
.open .dropdown-toggle.btn-twitter {
  color: #fff !important;
  background-color: #00b2de;
  border-color: #00a6ce;
}
.btn-twitter:active,
.btn-twitter.active,
.open .dropdown-toggle.btn-twitter {
  background-image: none;
}
.btn-twitter.disabled,
.btn-twitter.disabled:hover,
.btn-twitter.disabled:focus,
.btn-twitter.disabled:active,
.btn-twitter.disabled.active,
.btn-twitter[disabled],
.btn-twitter[disabled]:hover,
.btn-twitter[disabled]:focus,
.btn-twitter[disabled]:active,
.btn-twitter[disabled].active,
fieldset[disabled] .btn-twitter,
fieldset[disabled] .btn-twitter:hover,
fieldset[disabled] .btn-twitter:focus,
fieldset[disabled] .btn-twitter:active,
fieldset[disabled] .btn-twitter.active {
  background-color: #00c7f7;
  border-color: #00c7f7;
}
.btn-facebook {
  color: #fff !important;
  background-color: #335397;
  border-color: #335397;
}
.btn-facebook:hover,
.btn-facebook:focus,
.btn-facebook:active,
.btn-facebook.active,
.open .dropdown-toggle.btn-facebook {
  color: #fff !important;
  background-color: #2d4984;
  border-color: #294279;
}
.btn-facebook:active,
.btn-facebook.active,
.open .dropdown-toggle.btn-facebook {
  background-image: none;
}
.btn-facebook.disabled,
.btn-facebook.disabled:hover,
.btn-facebook.disabled:focus,
.btn-facebook.disabled:active,
.btn-facebook.disabled.active,
.btn-facebook[disabled],
.btn-facebook[disabled]:hover,
.btn-facebook[disabled]:focus,
.btn-facebook[disabled]:active,
.btn-facebook[disabled].active,
fieldset[disabled] .btn-facebook,
fieldset[disabled] .btn-facebook:hover,
fieldset[disabled] .btn-facebook:focus,
fieldset[disabled] .btn-facebook:active,
fieldset[disabled] .btn-facebook.active {
  background-color: #335397;
  border-color: #335397;
}
.btn-gplus {
  color: #fff !important;
  background-color: #dd4a38;
  border-color: #dd4a38;
}
.btn-gplus:hover,
.btn-gplus:focus,
.btn-gplus:active,
.btn-gplus.active,
.open .dropdown-toggle.btn-gplus {
  color: #fff !important;
  background-color: #d73825;
  border-color: #ca3522;
}
.btn-gplus:active,
.btn-gplus.active,
.open .dropdown-toggle.btn-gplus {
  background-image: none;
}
.btn-gplus.disabled,
.btn-gplus.disabled:hover,
.btn-gplus.disabled:focus,
.btn-gplus.disabled:active,
.btn-gplus.disabled.active,
.btn-gplus[disabled],
.btn-gplus[disabled]:hover,
.btn-gplus[disabled]:focus,
.btn-gplus[disabled]:active,
.btn-gplus[disabled].active,
fieldset[disabled] .btn-gplus,
fieldset[disabled] .btn-gplus:hover,
fieldset[disabled] .btn-gplus:focus,
fieldset[disabled] .btn-gplus:active,
fieldset[disabled] .btn-gplus.active {
  background-color: #dd4a38;
  border-color: #dd4a38;
}
.btn {
  font-weight: 500;
  border-radius: 2px;
}
.btn-icon {
  padding-left: 0;
  padding-right: 0;
  width: 34px;
  text-align: center;
}
.btn-icon.btn-sm {
  width: 30px;
}
.btn-icon.btn-lg {
  width: 45px;
}
.text-active,
.active > .text {
  display: none !important;
}
.active > .text-active {
  display: inline-block !important;
}
.btn-group-justified {
  border-collapse: separate;
}
.btn-rounded {
  border-radius: 50px;
}
.btn > i.pull-left,
.btn > i.pull-right {
  line-height: 1.428571429;
}
.btn-block {
  padding-left: 12px;
  padding-right: 12px;
}
.btn-group-vertical > .btn:first-child:not(:last-child) {
  border-top-right-radius: 2px;
}
.btn-group-vertical > .btn:last-child:not(:first-child) {
  border-bottom-left-radius: 2px;
}
.chat-item:before,
.chat-item:after {
  content: " ";
  display: table;
}
.chat-item:after {
  clear: both;
}
.chat-item .arrow {
  top: 20px;
}
.chat-item .arrow.right:after {
  border-left-color: #8ec165;
}
.chat-item .chat-body {
  position: relative;
  margin-left: 45px;
  min-height: 30px;
}
.chat-item .chat-body .panel {
  margin: 0 -1px;
}
.chat-item.right .chat-body {
  margin-left: 0;
  margin-right: 45px;
}
.chat-item+.chat-item {
  margin-top: 15px;
}
.comment-list {
  position: relative;
}
.comment-list .comment-item {
  margin-top: 0;
  position: relative;
}
.comment-list .comment-item > .thumb-sm {
  width: 36px;
}
.comment-list .comment-item .arrow.left {
  top: 20px;
  left: 39px;
}
.comment-list .comment-item .comment-body {
  margin-left: 46px;
}
.comment-list .comment-item .panel-body {
  padding: 10px 15px;
}
.comment-list .comment-item .panel-heading,
.comment-list .comment-item .panel-footer {
  position: relative;
  font-size: 12px;
  background-color: #fff;
}
.comment-list .comment-reply {
  margin-left: 46px;
}
.comment-list:before {
  position: absolute;
  top: 0;
  bottom: 35px;
  left: 18px;
  width: 1px;
  background: #e0e4e8;
  content: '';
}
.timeline {
  display: table;
  width: 100%;
  border-spacing: 0;
  table-layout: fixed;
  position: relative;
  border-collapse: collapse;
}
.timeline:before {
  content: "";
  width: 6px;
  margin-left: -4px;
  position: absolute;
  left: 50%;
  top: 0;
  bottom: 30px;
  background-color: #ddd;
  z-index: 0;
}
.timeline .timeline-date {
  position: absolute;
  width: 150px;
  left: -200px;
  top: 50%;
  margin-top: -9px;
  text-align: right;
}
.timeline .timeline-icon {
  position: absolute;
  left: -41px;
  top: -2px;
  top: 50%;
  margin-top: -15px;
}
.timeline .time-icon {
  width: 30px;
  height: 30px;
  line-height: 26px;
  display: inline-block !important;
  z-index: 10;
  border: 2px solid #fff;
  border-radius: 20px;
  text-align: center;
}
.timeline .time-icon:before {
  font-size: 16px;
  margin-top: 5px;
}
.timeline-item {
  display: table-row;
}
.timeline-item:before,
.timeline-item.alt:after {
  content: "";
  display: block;
  width: 50%;
}
.timeline-item.alt {
  text-align: right;
}
.timeline-item.alt:before {
  display: none;
}
.timeline-item.alt .panel {
  margin-right: 25px;
  margin-left: 0;
}
.timeline-item.alt .timeline-date {
  left: auto;
  right: -200px;
  text-align: left;
}
.timeline-item.alt .timeline-icon {
  left: auto;
  right: -41px;
}
.timeline-item.active {
  display: table-caption;
  text-align: center;
}
.timeline-item.active:before {
  width: 1%;
}
.timeline-item.active .timeline-caption {
  display: inline-block;
  width: auto;
}
.timeline-item.active .timeline-caption h5 span {
  color: #fff;
}
.timeline-item.active .panel {
  margin-left: 0;
}
.timeline-item.active .timeline-date,
.timeline-item.active .timeline-icon {
  position: static;
  margin-bottom: 10px;
  display: inline-block;
  width: auto;
}
.timeline-caption {
  display: table-cell;
  vertical-align: top;
  width: 50%;
}
.timeline-caption .panel {
  display: inline-block;
  position: relative;
  margin-left: 25px;
  text-align: left;
}
.timeline-caption h5 {
  margin: 0;
}
.timeline-caption h5 span {
  display: block;
  color: #999;
  margin-bottom: 4px;
  font-size: 12px;
}
.timeline-caption p {
  font-size: 12px;
  margin-bottom: 0;
  margin-top: 10px;
}
.timeline-footer {
  display: table-row;
}
.timeline-footer a {
  display: table-cell;
  text-align: right;
}
.timeline-footer .time-icon {
  margin-right: -15px;
  z-index: 5;
}
#note-list .note-name,
#note-list .note-desc {
  height: 20px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
#note-list .note-desc {
  height: 16px;
  font-size: 11px;
}
#note-list li {
  cursor: pointer;
}
#task-list .edit {
  display: none;
  float: left;
  position: relative;
  left: 0;
  top: -8px;
  border-width: 0;
  background: transparent;
  box-shadow: none;
  padding: 0 30px 0 0;
  font-size: 13px;
  color: #fff;
}
#task-list .editing .task-name {
  display: none;
}
#task-list .editing .edit {
  display: block;
}
#task-list .checkbox {
  margin: 4px 0;
}
#task-list li {
  position: relative;
}
#task-list li .close {
  position: absolute;
  top: 13px;
  right: 15px;
}
#task-list li.done .task-name {
  text-decoration: line-through;
}
#task-detail textarea {
  height: 60px;
  font-size: 12px;
  border-radius: 0;
}
.paper {
  position: relative;
  background: -webkit-linear-gradient(top,#f0f0f0 0%,white 5%) 0 0;
  background: -moz-linear-gradient(top,#f0f0f0 0%,white 5%) 0 0;
  background: linear-gradient(top,#f0f0f0 0%,white 5%) 0 0;
  -webkit-background-size: 100% 30px;
  -moz-background-size: 100% 30px;
  -ms-background-size: 100% 30px;
  background-size: 100% 30px;
}
.paper:before {
  content: '';
  position: absolute;
  width: 0px;
  top: 0;
  left: 39px;
  bottom: 0;
  border-left: 1px solid #F9D3D3;
}
.paper textarea {
  border: none;
  background-color: transparent;
  height: 100%;
  padding: 30px 0 0 55px;
  line-height: 30px;
  min-height: 210px;
}
.tags .label {
  font-size: 1em;
  display: inline-block;
  padding: 6px 10px;
  margin-bottom: 3px;
}
.post-item {
  border-radius: 3px;
  background-color: #fff;
  -webkit-box-shadow: 0px 1px 2px rgba(0,0,0,0.15);
  box-shadow: 0px 1px 2px rgba(0,0,0,0.15);
  margin-bottom: 15px;
}
.post-item .post-title {
  margin-top: 0;
}
.post-item .post-media {
  text-align: center;
}
.post-item .post-media img {
  border-radius: 3px 3px 0 0;
}
.switch {
  cursor: pointer;
  position: relative;
}
.switch input {
  position: absolute;
  opacity: 0;
  filter: alpha(opacity=0);
}
.switch input:checked + span {
  background-color: #8ec165;
}
.switch input:checked + span:after {
  left: 31px;
}
.switch span {
  position: relative;
  width: 60px;
  height: 30px;
  border-radius: 30px;
  background-color: #fff;
  border: 1px solid #eee;
  border-color: rgba(0,0,0,0.1);
  display: inline-block;
  -webkit-transition: background-color 0.2s;
  transition: background-color 0.2s;
}
.switch span:after {
  content: "";
  position: absolute;
  background-color: #fff;
  width: 26px;
  top: 1px;
  bottom: 1px;
  border-radius: 30px;
  -webkit-box-shadow: 1px 1px 3px rgba(0,0,0,0.25);
  box-shadow: 1px 1px 3px rgba(0,0,0,0.25);
  -webkit-transition: left 0.2s;
  transition: left 0.2s;
}
.nav-docs > ul > li > a {
  padding-top: 5px !important;
  padding-bottom: 5px !important;
}
.dropfile {
  border: 2px dashed #e0e4e8;
  text-align: center;
  min-height: 20px;
}
.dropfile.hover {
  border-color: #aac3cc;
}
.dropfile small {
  margin: 50px 0;
  display: block;
}
.portlet {
  min-height: 30px;
}
.jqstooltip {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
}
.easypiechart {
  position: relative;
  text-align: center;
}
.easypiechart .h2 {
  margin-left: 10px;
  margin-top: 10px;
  display: inline-block;
}
.easypiechart canvas {
  position: absolute;
  top: 0;
  left: 0;
}
.easypiechart .easypie-text {
  position: absolute;
  z-index: 1;
  line-height: 1;
  font-size: 75%;
  width: 100%;
  top: 60%;
}
.easypiechart img {
  margin-top: -4px;
}
.combodate select {
  display: inline-block;
}
.doc-buttons .btn {
  margin-bottom: 5px;
}
.the-icons {
  list-style: none;
}
.fontawesome-icon-list i {
  font-size: 14px;
  width: 40px;
  margin: 0;
  display: inline-block;
  text-align: center;
}
.fontawesome-icon-list a {
  line-height: 32px;
  display: block;
  white-space: nowrap;
}
.fontawesome-icon-list a:hover i {
  font-size: 28px;
  vertical-align: middle;
}
.th-sortable {
  cursor: pointer;
}
.th-sortable .th-sort {
  float: right;
  position: relative;
}
.th-sort i {
  position: relative;
  z-index: 1;
}
.th-sort .fa-sort {
  position: absolute;
  left: 0;
  top: 3px;
  color: #bac3cc;
  z-index: 0;
}
.th-sortable.active .text {
  display: none !important;
}
.th-sortable.active .text-active {
  display: inline-block !important;
}
.sortable-placeholder {
  list-style: none;
  border: 1px dashed #CCC;
  min-height: 50px;
  margin-bottom: 5px;
}
.input-append.date .add-on i,
.input-prepend.date .add-on i {
  display: block;
  cursor: pointer;
  width: 16px;
  height: 16px;
}
.parsley-error-list {
  margin: 0;
  padding: 0;
  list-style: none;
  margin-top: 6px;
  font-size: 12px;
}
.parsley-error {
  border-color: #ff5f5f !important;
}
.datepicker td.active,
.datepicker td.active:hover,
.datepicker td.active:hover.active,
.datepicker td.active.active {
  background: #65bd77;
}
.wizard .badge-info {
  background-color: #4cc0c1;
}
.wizard .badge-success {
  background-color: #8ec165;
}
.wizard ul li.active {
  color: #4cc0c1;
}
#flotTip {
  padding: 3px 5px;
  background-color: #000;
  z-index: 100;
  color: #fff;
  opacity: .7;
  filter: alpha(opacity=70);
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
.bg-gradient {
  background-image: -webkit-gradient(linear,left 0,left 100%,from(rgba(40,50,60,0)),to(rgba(40,50,60,0.05)));
  background-image: -webkit-linear-gradient(top,rgba(40,50,60,0),0,rgba(40,50,60,0.05),100%);
  background-image: -moz-linear-gradient(top,rgba(40,50,60,0) 0,rgba(40,50,60,0.05) 100%);
  background-image: linear-gradient(to bottom,rgba(40,50,60,0) 0,rgba(40,50,60,0.05) 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0028323c', endColorstr='#0c28323c', GradientType=0);
  filter: none;
}
.bg-light {
  background-color: #f1f1f1;
  color: #717171;
}
.bg-light.lt,
.bg-light .lt {
  background-color: #f7f7f7;
}
.bg-light.lter,
.bg-light .lter {
  background-color: #fefefe;
}
.bg-light.dk,
.bg-light .dk {
  background-color: #ebebeb;
}
.bg-light.dker,
.bg-light .dker {
  background-color: #e4e4e4;
}
.bg-light .bg {
  background-color: #f1f1f1;
}
.bg-dark {
  background-color: #2e3e4e;
  color: #9db1c5;
}
.bg-dark.lt,
.bg-dark .lt {
  background-color: #374b5e;
}
.bg-dark.lter,
.bg-dark .lter {
  background-color: #41586e;
}
.bg-dark.dk,
.bg-dark .dk {
  background-color: #25313e;
}
.bg-dark.dker,
.bg-dark .dker {
  background-color: #1b252e;
}
.bg-dark .bg {
  background-color: #2e3e4e;
}
.bg-dark a {
  color: #adbece;
}
.bg-dark a:hover {
  color: #fff;
}
.bg-dark a.list-group-item:hover,
.bg-dark a.list-group-item:focus {
  background-color: inherit;
}
.bg-dark .nav .caret {
  border-top-color: #9db1c5;
  border-bottom-color: #9db1c5;
}
.bg-dark .nav > li > a {
  color: #adbece;
}
.bg-dark .nav > li > a:hover,
.bg-dark .nav > li > a:focus {
  color: #fff;
  background-color: #25313e;
}
.bg-dark .nav > li > a:hover .caret,
.bg-dark .nav > li > a:focus .caret {
  border-top-color: #fff;
  border-bottom-color: #fff;
}
.bg-dark .nav .open > a {
  background-color: #25313e;
}
.bg-dark.navbar .nav > li.active > a {
  color: #fff;
  background-color: #25313e;
}
.bg-dark .open > a,
.bg-dark .open > a:hover,
.bg-dark .open > a:focus {
  color: #fff;
}
.bg-dark .text-muted {
  color: #8da4bb !important;
}
.bg-dark .icon-muted {
  color: #4a647e !important;
}
.bg-black {
  background-color: #282828;
  color: #9b9b9b;
}
.bg-black.lt,
.bg-black .lt {
  background-color: #353535;
}
.bg-black.lter,
.bg-black .lter {
  background-color: #424242;
}
.bg-black.dk,
.bg-black .dk {
  background-color: #1b1b1b;
}
.bg-black.dker,
.bg-black .dker {
  background-color: #0f0f0f;
}
.bg-black .bg {
  background-color: #282828;
}
.bg-black a {
  color: #a8a8a8;
}
.bg-black a:hover {
  color: #fff;
}
.bg-black a.list-group-item:hover,
.bg-black a.list-group-item:focus {
  background-color: inherit;
}
.bg-black .nav .caret {
  border-top-color: #9b9b9b;
  border-bottom-color: #9b9b9b;
}
.bg-black .nav > li > a {
  color: #a8a8a8;
}
.bg-black .nav > li > a:hover,
.bg-black .nav > li > a:focus {
  color: #fff;
  background-color: #1b1b1b;
}
.bg-black .nav > li > a:hover .caret,
.bg-black .nav > li > a:focus .caret {
  border-top-color: #fff;
  border-bottom-color: #fff;
}
.bg-black .nav .open > a {
  background-color: #1b1b1b;
}
.bg-black.navbar .nav > li.active > a {
  color: #fff;
  background-color: #1b1b1b;
}
.bg-black .open > a,
.bg-black .open > a:hover,
.bg-black .open > a:focus {
  color: #fff;
}
.bg-black .text-muted {
  color: #8e8e8e !important;
}
.bg-black .icon-muted {
  color: #4e4e4e !important;
}
.bg-primary {
  background-color: #65bd77;
  color: #e2f3e5;
}
.bg-primary.lt,
.bg-primary .lt {
  background-color: #77c587;
}
.bg-primary.lter,
.bg-primary .lter {
  background-color: #89cc97;
}
.bg-primary.dk,
.bg-primary .dk {
  background-color: #53b567;
}
.bg-primary.dker,
.bg-primary .dker {
  background-color: #48a75b;
}
.bg-primary .bg {
  background-color: #65bd77;
}
.bg-primary a {
  color: #ffffff;
}
.bg-primary a:hover {
  color: #fff;
}
.bg-primary a.list-group-item:hover,
.bg-primary a.list-group-item:focus {
  background-color: inherit;
}
.bg-primary .nav .caret {
  border-top-color: #e2f3e5;
  border-bottom-color: #e2f3e5;
}
.bg-primary .nav > li > a {
  color: #ffffff;
}
.bg-primary .nav > li > a:hover,
.bg-primary .nav > li > a:focus {
  color: #fff;
  background-color: #53b567;
}
.bg-primary .nav > li > a:hover .caret,
.bg-primary .nav > li > a:focus .caret {
  border-top-color: #fff;
  border-bottom-color: #fff;
}
.bg-primary .nav .open > a {
  background-color: #53b567;
}
.bg-primary.navbar .nav > li.active > a {
  color: #fff;
  background-color: #53b567;
}
.bg-primary .open > a,
.bg-primary .open > a:hover,
.bg-primary .open > a:focus {
  color: #fff;
}
.bg-primary .text-muted {
  color: #d0ebd6 !important;
}
.bg-primary .icon-muted {
  color: #77c587 !important;
}
.bg-success {
  background-color: #8ec165;
  color: #ebf4e4;
}
.bg-success.lt,
.bg-success .lt {
  background-color: #9bc877;
}
.bg-success.lter,
.bg-success .lter {
  background-color: #a9d089;
}
.bg-success.dk,
.bg-success .dk {
  background-color: #81ba53;
}
.bg-success.dker,
.bg-success .dker {
  background-color: #74ad46;
}
.bg-success .bg {
  background-color: #8ec165;
}
.bg-success a {
  color: #ffffff;
}
.bg-success a:hover {
  color: #fff;
}
.bg-success a.list-group-item:hover,
.bg-success a.list-group-item:focus {
  background-color: inherit;
}
.bg-success .nav .caret {
  border-top-color: #ebf4e4;
  border-bottom-color: #ebf4e4;
}
.bg-success .nav > li > a {
  color: #ffffff;
}
.bg-success .nav > li > a:hover,
.bg-success .nav > li > a:focus {
  color: #fff;
  background-color: #81ba53;
}
.bg-success .nav > li > a:hover .caret,
.bg-success .nav > li > a:focus .caret {
  border-top-color: #fff;
  border-bottom-color: #fff;
}
.bg-success .nav .open > a {
  background-color: #81ba53;
}
.bg-success.navbar .nav > li.active > a {
  color: #fff;
  background-color: #81ba53;
}
.bg-success .open > a,
.bg-success .open > a:hover,
.bg-success .open > a:focus {
  color: #fff;
}
.bg-success .text-muted {
  color: #deedd2 !important;
}
.bg-success .icon-muted {
  color: #9bc877 !important;
}
.bg-info {
  background-color: #4cc0c1;
  color: #d1efef;
}
.bg-info.lt,
.bg-info .lt {
  background-color: #5fc7c8;
}
.bg-info.lter,
.bg-info .lter {
  background-color: #72cdce;
}
.bg-info.dk,
.bg-info .dk {
  background-color: #3fb4b5;
}
.bg-info.dker,
.bg-info .dker {
  background-color: #38a1a2;
}
.bg-info .bg {
  background-color: #4cc0c1;
}
.bg-info a {
  color: #ffffff;
}
.bg-info a:hover {
  color: #fff;
}
.bg-info a.list-group-item:hover,
.bg-info a.list-group-item:focus {
  background-color: inherit;
}
.bg-info .nav .caret {
  border-top-color: #d1efef;
  border-bottom-color: #d1efef;
}
.bg-info .nav > li > a {
  color: #ffffff;
}
.bg-info .nav > li > a:hover,
.bg-info .nav > li > a:focus {
  color: #fff;
  background-color: #3fb4b5;
}
.bg-info .nav > li > a:hover .caret,
.bg-info .nav > li > a:focus .caret {
  border-top-color: #fff;
  border-bottom-color: #fff;
}
.bg-info .nav .open > a {
  background-color: #3fb4b5;
}
.bg-info.navbar .nav > li.active > a {
  color: #fff;
  background-color: #3fb4b5;
}
.bg-info .open > a,
.bg-info .open > a:hover,
.bg-info .open > a:focus {
  color: #fff;
}
.bg-info .text-muted {
  color: #bee8e8 !important;
}
.bg-info .icon-muted {
  color: #5fc7c8 !important;
}
.bg-warning {
  background-color: #ffc333;
  color: #fff8e6;
}
.bg-warning.lt,
.bg-warning .lt {
  background-color: #ffcb4d;
}
.bg-warning.lter,
.bg-warning .lter {
  background-color: #ffd266;
}
.bg-warning.dk,
.bg-warning .dk {
  background-color: #ffbc1a;
}
.bg-warning.dker,
.bg-warning .dker {
  background-color: #ffb400;
}
.bg-warning .bg {
  background-color: #ffc333;
}
.bg-warning a {
  color: #ffffff;
}
.bg-warning a:hover {
  color: #fff;
}
.bg-warning a.list-group-item:hover,
.bg-warning a.list-group-item:focus {
  background-color: inherit;
}
.bg-warning .nav .caret {
  border-top-color: #fff8e6;
  border-bottom-color: #fff8e6;
}
.bg-warning .nav > li > a {
  color: #ffffff;
}
.bg-warning .nav > li > a:hover,
.bg-warning .nav > li > a:focus {
  color: #fff;
  background-color: #ffbc1a;
}
.bg-warning .nav > li > a:hover .caret,
.bg-warning .nav > li > a:focus .caret {
  border-top-color: #fff;
  border-bottom-color: #fff;
}
.bg-warning .nav .open > a {
  background-color: #ffbc1a;
}
.bg-warning.navbar .nav > li.active > a {
  color: #fff;
  background-color: #ffbc1a;
}
.bg-warning .open > a,
.bg-warning .open > a:hover,
.bg-warning .open > a:focus {
  color: #fff;
}
.bg-warning .text-muted {
  color: #fff0cc !important;
}
.bg-warning .icon-muted {
  color: #ffcb4d !important;
}
.bg-danger {
  background-color: #fb6b5b;
  color: #ffffff;
}
.bg-danger.lt,
.bg-danger .lt {
  background-color: #fc8174;
}
.bg-danger.lter,
.bg-danger .lter {
  background-color: #fc988d;
}
.bg-danger.dk,
.bg-danger .dk {
  background-color: #fa5542;
}
.bg-danger.dker,
.bg-danger .dker {
  background-color: #fa3e29;
}
.bg-danger .bg {
  background-color: #fb6b5b;
}
.bg-danger a {
  color: #ffffff;
}
.bg-danger a:hover {
  color: #fff;
}
.bg-danger a.list-group-item:hover,
.bg-danger a.list-group-item:focus {
  background-color: inherit;
}
.bg-danger .nav .caret {
  border-top-color: #ffffff;
  border-bottom-color: #ffffff;
}
.bg-danger .nav > li > a {
  color: #ffffff;
}
.bg-danger .nav > li > a:hover,
.bg-danger .nav > li > a:focus {
  color: #fff;
  background-color: #fa5542;
}
.bg-danger .nav > li > a:hover .caret,
.bg-danger .nav > li > a:focus .caret {
  border-top-color: #fff;
  border-bottom-color: #fff;
}
.bg-danger .nav .open > a {
  background-color: #fa5542;
}
.bg-danger.navbar .nav > li.active > a {
  color: #fff;
  background-color: #fa5542;
}
.bg-danger .open > a,
.bg-danger .open > a:hover,
.bg-danger .open > a:focus {
  color: #fff;
}
.bg-danger .text-muted {
  color: #fff2f0 !important;
}
.bg-danger .icon-muted {
  color: #fc8174 !important;
}
.bg-white {
  background-color: #fff;
  color: #717171;
}
.bg-white a {
  color: #2e3e4e;
}
.bg-white a:hover {
  color: #1b252e;
}
.bg-white .text-muted {
  color: #979797 !important;
}
.bg-white-only {
  background-color: #fff;
}
.bg-empty {
  background-color: transparent;
}
.pos-rlt {
  position: relative;
}
.pos-stc {
  position: static;
}
.pos-abt {
  position: absolute;
}
.line {
  *width: 100%;
  height: 2px;
  margin: 10px 0;
  font-size: 0;
  overflow: hidden;
  background-color: transparent;
  border-width: 0;
  border-top: 1px solid #e8e8e8;
}
.line-xs {
  margin: 0;
}
.line-lg {
  margin-top: 15px;
  margin-bottom: 15px;
}
.line-dashed {
  border-style: dashed;
  background: transparent;
}
.no-line {
  border-width: 0;
}
.no-border,
.no-borders {
  border-color: transparent;
  border-width: 0;
}
.no-radius {
  border-radius: 0;
}
.block {
  display: block;
}
.block.hide {
  display: none;
}
.inline {
  display: inline-block !important;
}
.pull-none {
  float: none;
}
.rounded {
  border-radius: 500px;
}
.btn-s-xs {
  min-width: 90px;
}
.btn-s-sm {
  min-width: 100px;
}
.btn-s-md {
  min-width: 120px;
}
.btn-s-lg {
  min-width: 150px;
}
.btn-s-xl {
  min-width: 200px;
}
.l-h-2x {
  line-height: 2em;
}
.l-h-1x {
  line-height: 1.2;
}
.l-h {
  line-height: 1.5;
}
.v-middle {
  vertical-align: middle !important;
}
.v-top {
  vertical-align: top !important;
}
.v-bottom {
  vertical-align: bottom !important;
}
.font-thin {
  font-weight: 300;
}
.font-normal {
  font-weight: normal;
}
.font-semibold {
  font-weight: 600;
}
.font-bold {
  font-weight: 700;
}
.text-md {
  font-size: 0.85em;
}
.text-sm {
  font-size: 12px;
}
.text-xs {
  font-size: 10px;
}
.text-ellipsis {
  display: block;
  white-space: nowrap;
  width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
}
.text-uc {
  text-transform: uppercase;
}
.text-lt {
  text-decoration: line-through;
}
.text-ul {
  text-decoration: underline;
}
.box-shadow {
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.avatar {
  border: 1px solid rgba(255,255,255,0.35);
  display: block;
  border-radius: 500px;
  white-space: nowrap;
}
.avatar img {
  border-radius: 500px;
}
.wrapper-sm {
  padding: 10px;
}
.wrapper {
  padding: 15px;
}
.wrapper-lg {
  padding: 30px;
}
.wrapper-xl {
  padding: 50px;
}
.padder {
  padding-left: 15px;
  padding-right: 15px;
}
.padder-v {
  padding-top: 15px;
  padding-bottom: 15px;
}
.no-padder {
  padding: 0 !important;
}
.pull-in {
  margin-left: -15px;
  margin-right: -15px;
}
.pull-out {
  margin: -10px -15px;
}
.b-a {
  border: 1px solid #cfcfcf;
}
.b-t {
  border-top: 1px solid #cfcfcf;
}
.b-r {
  border-right: 1px solid #cfcfcf;
}
.b-b {
  border-bottom: 1px solid #cfcfcf;
}
.b-l {
  border-left: 1px solid #cfcfcf;
}
.b-light {
  border-color: #e4e4e4;
}
.b-dark {
  border-color: #374b5e;
}
.b-primary {
  border-color: #77c587;
}
.b-success {
  border-color: #9bc877;
}
.b-info {
  border-color: #5fc7c8;
}
.b-warning {
  border-color: #ffcb4d;
}
.b-danger {
  border-color: #fc8174;
}
.b-black {
  border-color: #353535;
}
.b-white {
  border-color: #fff;
}
.b-2x {
  border-width: 2px;
}
.b-3x {
  border-width: 3px;
}
.r {
  border-radius: 2px 2px 2px 2px;
}
.r-l {
  border-radius: 2px 0 0 2px;
}
.r-r {
  border-radius: 0 2px 2px 0;
}
.r-t {
  border-radius: 2px 2px 0 0;
}
.r-b {
  border-radius: 0 0 2px 2px;
}
.m-xs {
  margin: 5px;
}
.m-sm {
  margin: 10px;
}
.m {
  margin: 15px;
}
.m-md {
  margin: 20px;
}
.m-lg {
  margin: 30px;
}
.m-n {
  margin: 0 !important;
}
.m-l-none {
  margin-left: 0;
}
.m-l-xs {
  margin-left: 5px;
}
.m-l-sm {
  margin-left: 10px;
}
.m-l {
  margin-left: 15px;
}
.m-l-md {
  margin-left: 20px;
}
.m-l-lg {
  margin-left: 30px;
}
.m-l-xl {
  margin-left: 40px;
}
.m-l-n-xxs {
  margin-left: -1px;
}
.m-l-n-xs {
  margin-left: -5px;
}
.m-l-n-sm {
  margin-left: -10px;
}
.m-l-n {
  margin-left: -15px;
}
.m-l-n-md {
  margin-left: -20px;
}
.m-l-n-lg {
  margin-left: -30px;
}
.m-l-n-xl {
  margin-left: -40px;
}
.m-t-none {
  margin-top: 0;
}
.m-t-xxs {
  margin-top: 1px;
}
.m-t-xs {
  margin-top: 5px;
}
.m-t-sm {
  margin-top: 10px;
}
.m-t {
  margin-top: 15px;
}
.m-t-md {
  margin-top: 20px;
}
.m-t-lg {
  margin-top: 30px;
}
.m-t-xl {
  margin-top: 40px;
}
.m-t-n-xxs {
  margin-top: -1px;
}
.m-t-n-xs {
  margin-top: -5px;
}
.m-t-n-sm {
  margin-top: -10px;
}
.m-t-n {
  margin-top: -15px;
}
.m-t-n-md {
  margin-top: -20px;
}
.m-t-n-lg {
  margin-top: -30px;
}
.m-t-n-xl {
  margin-top: -40px;
}
.m-r-none {
  margin-right: 0;
}
.m-r-xs {
  margin-right: 5px;
}
.m-r-sm {
  margin-right: 10px;
}
.m-r {
  margin-right: 15px;
}
.m-r-md {
  margin-right: 20px;
}
.m-r-lg {
  margin-right: 30px;
}
.m-r-xl {
  margin-right: 40px;
}
.m-r-n-xxs {
  margin-right: -1px;
}
.m-r-n-xs {
  margin-right: -5px;
}
.m-r-n-sm {
  margin-right: -10px;
}
.m-r-n {
  margin-right: -15px;
}
.m-r-n-md {
  margin-right: -20px;
}
.m-r-n-lg {
  margin-right: -30px;
}
.m-r-n-xl {
  margin-right: -40px;
}
.m-b-none {
  margin-bottom: 0;
}
.m-b-xs {
  margin-bottom: 5px;
}
.m-b-sm {
  margin-bottom: 10px;
}
.m-b {
  margin-bottom: 15px;
}
.m-b-md {
  margin-bottom: 20px;
}
.m-b-lg {
  margin-bottom: 30px;
}
.m-b-xl {
  margin-bottom: 40px;
}
.m-b-n-xxs {
  margin-bottom: -1px;
}
.m-b-n-xs {
  margin-bottom: -5px;
}
.m-b-n-sm {
  margin-bottom: -10px;
}
.m-b-n {
  margin-bottom: -15px;
}
.m-b-n-md {
  margin-bottom: -20px;
}
.m-b-n-lg {
  margin-bottom: -30px;
}
.m-b-n-xl {
  margin-bottom: -40px;
}
.media-xs {
  min-width: 50px;
}
.media-sm {
  min-width: 80px;
}
.media-md {
  min-width: 90px;
}
.media-lg {
  min-width: 120px;
}
.thumb {
  width: 64px;
  display: inline-block;
}
.thumb-lg {
  width: 128px;
  display: inline-block;
}
.thumb-md {
  width: 90px;
  display: inline-block;
}
.thumb-xs {
  width: 18px;
  display: inline-block;
}
.thumb-sm {
  width: 36px;
  display: inline-block;
}
.thumb-wrapper {
  padding: 2px;
  border: 1px solid #ddd;
}
.thumb img,
.thumb-xs img,
.thumb-sm img,
.thumb-md img,
.thumb-lg img {
  height: auto;
  max-width: 100%;
  vertical-align: middle;
}
.img-full {
  max-width: 100%;
}
.img-full > img {
  max-width: 100%;
}
.clear {
  display: block;
  overflow: hidden;
}
.scroll-x,
.scroll-y {
  overflow: hidden;
  -webkit-overflow-scrolling: touch;
}
.scroll-y {
  overflow-y: auto;
}
.scroll-x {
  overflow-x: auto;
}
.no-touch .scroll-x,
.no-touch .scroll-y {
  overflow: hidden;
}
.no-touch .scroll-x:hover,
.no-touch .scroll-x:focus,
.no-touch .scroll-x:active {
  overflow-x: auto;
}
.no-touch .scroll-y:hover,
.no-touch .scroll-y:focus,
.no-touch .scroll-y:active {
  overflow-y: auto;
}
.no-touch .hover-action {
  display: none;
}
.no-touch .hover:hover .hover-action {
  display: inherit;
}
.h {
  font-size: 170px;
  font-weight: 300;
  text-shadow: 0 1px 0 #d9d9d9, 0 2px 0 #d0d0d0, 0 5px 10px rgba(0,0,0,0.125), 0 10px 20px rgba(0,0,0,0.2);
}
@media screen and (min-width: 992px) {
  .col-lg-2-4 {
    width: 20.000%;
    float: left;
  }
}
@media (max-width: 767px) {
  .shift {
    display: none !important;
  }
  .shift.in {
    display: block !important;
  }
  .row-2 [class*="col"] {
    width: 50%;
    float: left;
  }
  .row-2 .col-0 {
    clear: none;
  }
  .row-2 li:nth-child(odd) {
    clear: left;
    margin-left: 0;
  }
  .text-center-xs {
    text-align: center;
  }
  .text-left-xs {
    text-align: left;
  }
  .pull-none-xs {
    float: none !important;
  }
  .hidden-xs.show {
    display: inherit !important;
  }

.gallery-wrap {
  margin: 10px -10px;
}
.gallery-wrap:before,
.gallery-wrap:after {
  display: table;
  content: " ";
}
.gallery-wrap:after {
  clear: both;
}
.gallery-wrap .column {
  float: left;
  width: 20%;
  margin: 0;
  padding: 0;
}
.gallery-wrap .column-4 {
  float: left;
  width: 25%;
  margin: 0;
  padding: 0;
}
.gallery-wrap .column-3 {
  float: left;
  width: 33.33333333333333%;
  margin: 0;
  padding: 0;
}
.gallery-wrap .column .inner,
.gallery-wrap .column-4 .inner,
.gallery-wrap .column-3 .inner {
  margin: 10px;
  position: relative;
  overflow: hidden;
  -webkit-transition: All 0.4s ease;
  -moz-transition: All 0.4s ease;
  -o-transition: All 0.4s ease;
}
.gallery-wrap .column .inner:hover,
.gallery-wrap .column-4 .inner:hover,
.gallery-wrap .column-3 .inner:hover {
  -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.25);
  -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.25);
  box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.25);
}
.gallery-wrap .column .inner a .img-wrap,
.gallery-wrap .column-3 .inner a .img-wrap,
.gallery-wrap .column-4 .inner a .img-wrap {
  cursor: pointer;
  cursor: -webkit-zoom-in;
  cursor: -moz-zoom-in;
  cursor: zoom-in;
}
.gallery-wrap .column .inner .img-wrap {
  height: 140px;
  overflow: hidden;
  background: #ddd;
}
.gallery-wrap .column-3 .inner .img-wrap {
  height: 200px;
  overflow: hidden;
  background: #ddd;
}
.gallery-wrap .column-4 .inner .img-wrap {
  height: 180px;
  overflow: hidden;
  background: #ddd;
}
.gallery-wrap .column .inner .img-frame,
.gallery-wrap .column-3 .inner .img-frame,
.gallery-wrap .column-4 .inner .img-frame {
  padding: 5px;
  background: #fff;
  display: block;
  position: relative;
  -webkit-transition: All 0.4s ease;
  -moz-transition: All 0.4s ease;
  -o-transition: All 0.4s ease;
}
.gallery-wrap .column .inner:hover .img-frame,
.gallery-wrap .column-3 .inner:hover .img-frame,
.gallery-wrap .column-4 .inner:hover .img-frame {
  background: #fff;
}
.gallery-wrap .column .inner:hover .img-frame.success,
.gallery-wrap .column-3 .inner:hover .img-frame.success,
.gallery-wrap .column-4 .inner:hover .img-frame.success {
  background: #65BD77;
}
.gallery-wrap .column .inner:hover .img-frame.warning,
.gallery-wrap .column-3 .inner:hover .img-frame.warning,
.gallery-wrap .column-4 .inner:hover .img-frame.warning {
  background: #FFCE00;
}
.gallery-wrap .column .inner:hover .img-frame.danger,
.gallery-wrap .column-3 .inner:hover .img-frame.danger,
.gallery-wrap .column-4 .inner:hover .img-frame.danger {
  background: #D73D3D;
}
.gallery-wrap .column .inner:hover .img-frame.info,
.gallery-wrap .column-3 .inner:hover .img-frame.info,
.gallery-wrap .column-4 .inner:hover .img-frame.info {
  background: #428BCA;
}
.gallery-wrap .column .inner .img-wrap img,
.gallery-wrap .column-4 .inner .img-wrap img,
.gallery-wrap .column-3 .inner .img-wrap img {
  width: 100%;
}
.gallery-wrap .column .inner .caption-hover,
.gallery-wrap .column-4 .inner .caption-hover,
.gallery-wrap .column-3 .inner .caption-hover {
  position: absolute;
  bottom: -100px;
  left: 0;
  right: 0;
  text-align: center;
  color: #909090;
  padding: 10px;
  background: #fff;
  -webkit-transition: All 0.4s ease;
  -moz-transition: All 0.4s ease;
  -o-transition: All 0.4s ease;
}
.gallery-wrap .column .inner .caption-hover.success,
.gallery-wrap .column-4 .inner .caption-hover.success,
.gallery-wrap .column-3 .inner .caption-hover.success {
  color: #2C7439;
  background: #65BD77;
}
.gallery-wrap .column .inner .caption-hover.danger,
.gallery-wrap .column-4 .inner .caption-hover.danger,
.gallery-wrap .column-3 .inner .caption-hover.danger {
  color: #790D0D;
  background: #D73D3D;
}
.gallery-wrap .column .inner .caption-hover.warning,
.gallery-wrap .column-4 .inner .caption-hover.warning,
.gallery-wrap .column-3 .inner .caption-hover.warning {
  color: #B27C05;
  background: #FFCE00;
}
.gallery-wrap .column .inner .caption-hover.info,
.gallery-wrap .column-4 .inner .caption-hover.info,
.gallery-wrap .column-3 .inner .caption-hover.info {
  color: #0A487C;
  background: #428BCA;
}
.gallery-wrap .column .inner:hover .caption-hover,
.gallery-wrap .column-4 .inner:hover .caption-hover,
.gallery-wrap .column-3 .inner:hover .caption-hover {
  bottom: 0px;
}
.gallery-wrap .column .inner .caption-static,
.gallery-wrap .column-4 .inner .caption-static,
.gallery-wrap .column-3 .inner .caption-static {
  position: absolute;
  text-align: left;
  font-weight: 300;
  font-size: 12px;
  color: #fff;
  padding: 10px;
  left: 0px;
  bottom: 0px;
  width: 100%;
  background: -moz-linear-gradient(top,rgba(0,0,0,0) 0%,rgba(0,0,0,0.34) 100%);
  background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,rgba(0,0,0,0)),color-stop(100%,rgba(0,0,0,0.34)));
  background: -webkit-linear-gradient(top,rgba(0,0,0,0) 0%,rgba(0,0,0,0.34) 100%);
  background: -o-linear-gradient(top,rgba(0,0,0,0) 0%,rgba(0,0,0,0.34) 100%);
  background: -ms-linear-gradient(top,rgba(0,0,0,0) 0%,rgba(0,0,0,0.34) 100%);
  background: linear-gradient(to bottom,rgba(0,0,0,0) 0%,rgba(0,0,0,0.34) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000',endColorstr='#57000000',GradientType=0);
  cursor: -webkit-zoom-in;
  cursor: -moz-zoom-in;
  cursor: zoom-in;
  margin: 0;
}
.gallery-wrap .column .inner a:hover,
.gallery-wrap .column-4 .inner a:hover,
.gallery-wrap .column-3 .inner a:hover {
  text-decoration: none;
}
.gallery-wrap .column .inner .caption-static.success,
.gallery-wrap .column-4 .inner .caption-static.success,
.gallery-wrap .column-3 .inner .caption-static.success {
  color: #2C7439;
  background: #65BD77;
}
.gallery-wrap .column .inner .caption-static.danger,
.gallery-wrap .column-4 .inner .caption-static.danger,
.gallery-wrap .column-3 .inner .caption-static.danger {
  color: #790D0D;
  background: #D73D3D;
}
.gallery-wrap .column .inner .caption-static.warning,
.gallery-wrap .column-4 .inner .caption-static.warning,
.gallery-wrap .column-3 .inner .caption-static.warning {
  color: #B27C05;
  background: #FFCE00;
}
.gallery-wrap .column .inner .caption-static.info,
.gallery-wrap .column-4 .inner .caption-static.info,
.gallery-wrap .column-3 .inner .caption-static.info {
  color: #0A487C;
  background: #428BCA;
}
  
}

</style>

  </head>
<body>
  <section class="vbox">
@include('includes.header')

    <section>
      <section class="hbox stretch">
        <!-- .aside -->
               @include('includes.sidebarleft')
        <!-- /.aside -->
        <section id="content">
       {{--  @include('includes.alert') --}}
          <section class="vbox">          
           @yield('content')
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
@include('includes.scripts')

</body>
</html>
