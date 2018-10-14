<?php

//! Front-end processor
class zhPageController extends Controller {

    //const

    // Note: F3 uses all uppercase names for Hive variables, so no risk with using camelCase

    function loadCommonSettings($f3) {
        $f3->set('LANGUAGE','zh-CN');
        $f3->set('langSubdirectory','zh');
    }
    
    function RenderHome($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','现场施工');
        $f3->set('pageDescription','使用带有Fat-Free PHP框架的Bootstrap构建简单的多语言网站的前端/后端设置，但没有数据库。');
        $f3->set('isHomePage',true);
        $f3->set('loadID',
            function($array,$count) {
                reset($array);
                for ($x = 0; $x < $count; $x++) {
                    next($array);
                }
                return key($array);
            }
        );
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails1($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','设置和修改Bootstrap');
        $f3->set('pageDescription','该站点使用Bootstrap构建，使用Sass进行样式设置和修改后的移动菜单设置。');
        $f3->set('isDetailPage',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails2($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','开始使用Fat-Free');
        $f3->set('pageDescription','解释为什么我选择Fat-Free，如何安装它，构建它以及管理不同的语言。');
        $f3->set('isDetailPage',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails3($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','配置无脂肪');
        $f3->set('pageDescription','我在配置Fat-Free和设置文件以运行站点时使用的步骤。');
        $f3->set('isDetailPage',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails4($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','无脂肪的模板');
        $f3->set('pageDescription','使用PHP框架的好处是能够从用于导航，内容和页脚的单独模板组装网页。');
        $f3->set('isDetailPage',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails5($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','使网站更好的细节');
        $f3->set('pageDescription','有一些细节可以添加到一个更专业的网站。');
        $f3->set('isDetailPage',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

}
