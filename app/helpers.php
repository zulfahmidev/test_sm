<?php

use Illuminate\Http\Request;

function getSidebarNavs() {
  return [
    [
      "route" => "dashboard",
      "path" => "/",
      "title" => "Dashboard",
      "icon" => "home",
      "roles" => ["admin", "approver"],
    ],
    [
      "route" => "booking.index",
      "path" => "/booking",
      "title" => "Pemesanan",
      "icon" => "file-text",
      "roles" => ["admin"],
    ],
    [
      "route" => "vehicle.index",
      "path" => "/vehicle",
      "title" => "Kendaraan",
      "icon" => "truck",
      "roles" => ["admin"],
    ],
    [
      "route" => "driver.index",
      "path" => "/driver",
      "title" => "Pengemudi",
      "icon" => "id-card",
      "roles" => ["admin"],
    ],
    [
      "route" => "approver.index",
      "path" => "/approver",
      "title" => "Penyetujui",
      "icon" => "user-tie",
      "roles" => ["admin"],
    ],
    [
      "route" => "approval.index",
      "path" => "/approval",
      "title" => "Persetujuan",
      "icon" => "thumbs-up",
      "roles" => ["approver"],
    ],
    [
      "route" => "service",
      "path" => "/service",
      "title" => "Service",
      "icon" => "calendar",
      "roles" => ["admin"],
    ],
    [
      "route" => "maintenance",
      "path" => "/maintenance",
      "title" => "Perbaikan",
      "icon" => "wrench",
      "roles" => ["admin"],
    ],
    [
      "route" => "vehicle-return",
      "path" => "/vehicle-return",
      "title" => "Pengembalian",
      "icon" => "undo",
      "roles" => ["admin"],
    ],
  ];
}

function getCurrentPage() {
  return Request::capture()->segment(1);
}

function translateStatus($name) {
  $status = [
    "passengers" => "penumpang",
    "goods" => "barang",
    "owned" => "pribadi",
    "leased" => "sewaan",
    "good" => "baik",
    "damaged" => "rusak",
    "repair" => "perbaikan",
    "yes" => "ya",
    "not" => "tidak",
    "panding" => "panding",
    "approved" => "Disetujui",
    "rejected" => "Ditolak",
  ];
  return $status[$name];
}