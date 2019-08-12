<?php

namespace app\libraries;

use \kartik\grid\GridView as KartikGridView;
use \nterms\pagesize\PageSize;

class GridView extends KartikGridView
{

    private $_pagesize;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->_pagesize = $this->_settingPageSize();
        $this->panelHeadingTemplate = $this->_settingPanelHeadingTemplate();
        $this->panelBeforeTemplate = '';
        $this->panelFooterTemplate = $this->_settingPanelFooterTemplate();
        $this->filterSelector = 'select[name="per-page"]';
        $this->bordered = true;
        $this->striped = false;
        $this->condensed = false;
        $this->responsive = true;
        $this->hover = true;
    }

    private function _settingPanelHeadingTemplate(){
        return <<< HTML
        <div class="pull-right">
            <div class="pull-left"> {toolbar} </div>
            <div class="pull-left"> $this->_pagesize </div>
        </div> 
        {title} <div class="clearfix"></div>
HTML;
    }

    private function _settingPanelFooterTemplate(){
        return <<<HTML
        <div class="kv-summary pull-left">{summary}</div>
        <div class="kv-panel-pager">{pager}</div>
        <div class="clearfix"></div>
HTML;
    }

    private function _settingPageSize(){
        return PageSize::widget([
            'template' => '{list}',
            'sizes' => [
                '5' => '5',
                '10' => '10',
                '20' => '20',
                '50' => '50',
                '100' => '100'
            ],
            'options' => [
                'id' => 'pagesize',
                'class' => 'form-control kv-select-length',
            ]
        ]);
    }
}