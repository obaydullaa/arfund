<?php

namespace App\Constants;

class FileInfo
{

    /*
    |--------------------------------------------------------------------------
    | File Information
    |--------------------------------------------------------------------------
    |
    | This class basically contain the path of files and size of images.
    | All information are stored as an array. Developer will be able to access
    | this info as method and property using FileManager class.
    |
    */

    public function fileInfo(){
        $data['withdrawVerify'] = [
            'path'=>'assets/images/verify/withdraw'
        ];
        $data['depositVerify'] = [
            'path'      =>'assets/images/verify/deposit'
        ];
        $data['verify'] = [
            'path'      =>'assets/verify'
        ];
        $data['default'] = [
            'path'      => 'assets/images/default.png',
        ];
        $data['withdrawMethod'] = [
            'path'      => 'assets/images/withdraw/method',
            'size'      => '800x800',
        ];
        $data['ticket'] = [
            'path'      => 'assets/support',
        ];
        $data['logoIcon'] = [
            'path'      => 'assets/images/logoIcon',
            'size' => '190x55'
        ];
        $data['favicon'] = [
            'path'      => 'assets/images/favicon',
            'size'      => '80x80',
        ];
        $data['plugins'] = [
            'path'      => 'assets/images/plugins',
            'size'      => '36x36',
        ];
        $data['seo'] = [
            'path'      => 'assets/images/seo',
            'size'      => '1180x600',
        ];
        $data['userProfile'] = [
            'path'      =>'assets/images/user/profile',
            'size'      =>'100x100',
        ];
        $data['adminProfile'] = [
            'path'      =>'assets/admin/images/profile',
            'size'      =>'400x400',
        ];
        $data['push'] = [
            'path'      =>'assets/images/push_notification',
        ];
        $data['appPurchase'] = [
            'path'      =>'assets/in_app_purchase_config',
        ];
        $data['maintenance'] = [
            'path'      =>'assets/images/maintenance',
            'size'      =>'660x325',
        ];
        $data['gateway'] = [
            'path'      =>'assets/images/gateway',
            'size'      =>'350x350',
        ];
        $data['summernoteImage'] = [
            'path'      =>'assets/images/summernoteImage'
        ];
        $data['category'] = [
            'path'      =>'assets/images/category',
            'size'      =>'196x196',
        ];
        $data['banner'] = [
            'path'      =>'assets/images/frontend/banner'
        ];
        $data['breadcrumb'] = [
            'path'      =>'assets/images/frontend/breadcrumb'
        ];
        $data['about'] = [
            'path'      =>'assets/images/frontend/about'
        ];
        $data['why_choose_us'] = [
            'path'      =>'assets/images/frontend/why_choose_us'
        ];
        $data['cta'] = [
            'path'      =>'assets/images/frontend/cta'
        ];
        $data['volunteer'] = [
            'path'      =>'assets/images/frontend/volunteer'
        ];
        $data['testimonial'] = [
            'path'      =>'assets/images/frontend/testimonial'
        ];
        $data['newsletter'] = [
            'path'      =>'assets/images/frontend/newsletter_subscribe'
        ];
        $data['blog'] = [
            'path'      =>'assets/images/frontend/blog'
        ];
        $data['faq'] = [
            'path'      =>'assets/images/frontend/faq'
        ];
        $data['login'] = [
            'path'      => 'assets/images/frontend/login',
            'size'      => '1920x911',
        ];
        $data['register'] = [
            'path'      => 'assets/images/frontend/register',
            'size'      => '1920x911',
        ];
        $data['campaignImg'] = [
            'path'      => 'assets/images/frontend/campaignImg',
            'size'      => '812x557',
        ];
        $data['gallery'] = [
            'path'      => 'assets/images/frontend/gallery',
        ];
        $data['document'] = [
            'path'      => 'assets/images/frontend/document',
        ];
        $data['footer'] = [
            'path'      => 'assets/images/frontend/footer',
            'size'      => '1920x488',
        ];

        return $data;  
	}

}
