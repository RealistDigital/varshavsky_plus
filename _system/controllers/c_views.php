<?php
//-----------------------------------------------------------------------------
// ������� ���������� VIEWS / ���� 
//-----------------------------------------------------------------------------

//������ ���������� �������� / ��� ��������� ����� URL
require_once (SYS_MODELS."m_managment.php");

Class C_View extends M_Managment {
    /** �������� ��� / ������ ���� 
     * @view                - ������� ���
     * @menu                - ���� ���. / ����.
     * @data                - �������� �����
     * @tpl-data            - ����� ��� �������
     * @url                 - ����� URL
     * @data-info           - ����� ��� ���� ����� ��� html ������
     * @breadcrumbs-view    - ��� ��� ���������
     * @breadcrumbs-data    - ���� ��� ���������
     * @right-id            - ID ��� ����
     * @public-url          - URL ��� ��������� ����� 
     * @header-v            - �������� header / default TRUE
     * @footer-v            - �������� footer / default TRUE            
    */
    public function view ($view=false, $menu=false, $data=false, $tpl_data=false, $url=false, $data_info=false, $breadcrumbs_view=false, $breadcrumbs_data=false, $right_id=false, $public_url=false, $header_v = true, $footer_v = true) {
        //���������� ��� �����
        require_once(URL_APP."_general/general.php");
		
		//Header
        if($header_v) {
            require_once SYS_VIEWS.'main/header.php';
        }
        //���� 
        if ($menu != false) {
            require_once SYS_VIEWS.$menu.'.php';
        }
        //breadcrumbs
        if($breadcrumbs_view != false) {
            require_once SYS_VIEWS.$breadcrumbs_view.'.php';
        }
        //�������� ����� � ����� ���������� Edit ��������
        if(file_exists(URL_EDIT.$view.'.php')) {
            require_once URL_EDIT.$view.'.php';  //Odl SYS_VIEWS
        //�������� ����� � ��������� ����������   
        } elseif(file_exists(SYS_VIEWS.$view.'.php')) {
            require_once SYS_VIEWS.$view.'.php';
        //������ 
        } else {
            require_once SYS_VIEWS.'main/error.php';
        }
        //Footer
        if($footer_v) {
            require_once SYS_VIEWS.'main/footer.php';
        } 
    }
}

?>