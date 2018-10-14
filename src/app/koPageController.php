<?php

//! Front-end processor
class koPageController extends Controller {

    //const

    // Note: F3 uses all uppercase names for Hive variables, so no risk with using camelCase

    function loadCommonSettings($f3) {
        $f3->set('LANGUAGE','ko');
        $f3->set('langSubdirectory','ko');
    }
    
    function RenderHome($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','사이트 구축');
        $f3->set('pageDescription','Fat-Free PHP 프레임 워크로 Bootstrap을 사용하지만 데이터베이스가없는 간단한 다국어 웹 사이트의 프론트 엔드 / 백엔드 설정.');
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
        $f3->set('pageTitle','부트 스트랩 설정 및 수정');
        $f3->set('pageDescription','이 사이트는 Bootstrap을 사용하여 Sass를 사용하여 스타일을 수정하고 모바일 메뉴 설정을 수정했습니다.');
        $f3->set('isDetailPage',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails2($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','무 지방으로 시작하기');
        $f3->set('pageDescription','왜 내가 Fat-Free를 선택했는지, 어떻게 설치하고, 구조화하고, 다른 언어를 관리하는지에 대한 설명.');
        $f3->set('isDetailPage',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails3($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','무 지방 구성');
        $f3->set('pageDescription','Fat-Free를 구성하고 사이트를 실행하기 위해 파일을 설정하는 데 사용한 단계.');
        $f3->set('isDetailPage',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails4($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','뚱뚱한 자유로운을위한 템플렛');
        $f3->set('pageDescription','PHP 프레임 워크를 사용하면 탐색, 내용 및 바닥 글을위한 별도의 템플릿에서 웹 페이지를 조합 할 수 있습니다.');
        $f3->set('isDetailPage',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

    function renderDetails5($f3) {
        $this->loadCommonSettings($f3);
        $f3->set('pageTitle','사이트를 더 좋게 만드는 세부 정보');
        $f3->set('pageDescription','보다 전문적으로 작동하는 웹 사이트에 추가되는 많은 세부 사항이 있습니다.');
        $f3->set('isDetailPage',true);
        // Set the content source
        $f3->set('pageContent',$f3->get('ALIAS').'.html');
    }

}
