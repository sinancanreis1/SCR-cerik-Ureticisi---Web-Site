<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$setting = \App\Models\SiteSetting::first();
if ($setting) {
    $setting->instagram = 'https://www.instagram.com/sinancanreis.dg/';
    $setting->linkedin = 'https://www.linkedin.com/in/sinan-can-reis-157658329';
    $setting->twitter = null;
    $setting->save();
    echo "SiteSetting updated successfully.";
} else {
    echo "No SiteSetting found.";
}
