<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['key' => 'app_name', 'value' => 'ISP']);
        Setting::create(['key' => 'date_format', 'value' => 'DD-MM-YYYY']);
        Setting::create(['key' => 'time_format', 'value' => 'h:mm a']);
        Setting::create(['key' => 'timezone', 'value' => 'Asia/Dhaka']);
        Setting::create(['key' => 'app_url', 'value' => 'isp.com']);
        Setting::create(['key' => 'per_page', 'value' => '10']);
        Setting::create(['key' => 'toast_position', 'value' => 'top-end']);
        Setting::create(['key' => 'app_email', 'value' => 'isp@gmail.com']);
        Setting::create(['key' => 'app_mobile', 'value' => '0123456789']);
        Setting::create(['key' => 'app_address', 'value' => '15/1 Iqbal Rd, Dhaka 1207']);




        Setting::create(['key' => 'about_short_info', 'value' => 'ISP changes your lifestyle and letting you focus on the growth of your business by providing superfast broadband internet service.']);


        Setting::create(['key' => 'about_long_info', 'value' => "ISP is a full service IT Solution Provider that has been operating in Bangladesh market for over 18 years with a very high level of success, achieved through an uncompromised service quality and customer satisfaction. Link3's highly trained professionals can ensure a standard of service that remains unmatched by any other player in the market."]);
    }
}
