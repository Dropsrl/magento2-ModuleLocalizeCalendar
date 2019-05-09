<?php
namespace Drop\ModuleLocalizeCalendar\View\Element\Html;

class Date extends \Magento\Framework\View\Element\Html\Date {

    /**
     * \Magento\Store\Model\StoreManagerInterface 
     */
    protected $storeManager;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context, 
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);

        $this->storeManager = $storeManager;
    }
    
    protected function _toHtml() {
        $html = '<input type="text" name="' . $this->getName() . '" id="' . $this->getId() . '" ';
        $html .= 'value="' . $this->escapeHtml($this->getValue()) . '" ';
        $html .= 'class="' . $this->getClass() . '" ' . $this->getExtraParams() . '/> ';
        $calendarYearsRange = $this->getYearsRange();
        $changeMonth = $this->getChangeMonth();
        $changeYear = $this->getChangeYear();
        $maxDate = $this->getMaxDate();
        $showOn = $this->getShowOn();
        $firstDay = $this->getFirstDay();
        
        $lang = $this->storeManager->getStore()->getCode();

        $html .= '<script type="text/javascript">
            require(["jquery", "mage/calendar"], function($){
                    $("#' .
            $this->getId() .
            '").calendar({
                        showsTime: ' .
            ($this->getTimeFormat() ? 'true' : 'false') .
            ',
                        ' .
            ($this->getTimeFormat() ? 'timeFormat: "' .
            $this->getTimeFormat() .
            '",' : '') .
            '
                        dateFormat: "' .
            $this->getDateFormat() .
            '",
                        buttonImage: "' .
            $this->getImage() .
            '",        
                dayNames: [\'' . 
                    __('Sunday') . "','" .
                    __('Monday') . "','" .
                    __('Tuesday') . "','" .
                    __('Wednesday') . "','" .
                    __('Thursday') . "','" .
                    __('Friday') . "','" .
                    __('Saturday') .
                "'],
                dayNamesMin: ['" .
                    __('Su') . "','" .
                    __('Mo') . "','" .
                    __('Tu') . "','" .
                    __('We') . "','" .
                    __('Th') . "','" .
                    __('Fr') . "','" .
                    __('Sa') . "'" .
                "],
                monthNames: ['" .
                __('January') . "','" .
                __('Fabruary') . "','" .
                __('March') . "','" .
                __('April') . "','" .
                __('May') . "','" .
                __('June') . "','" .
                __('July') . "','" .
                __('August') . "','" .
                __('September') . "','" .
                __('October') . "','" .
                __('November') . "','" .
                __('December') . "'" .
                "],
                monthNamesShort: ['" .
                __('Jan') . "','" .
                __('Fab') . "','" .
                __('Mar') . "','" .
                __('Apr') . "','" .
                __('May') . "','" .
                __('Jun') . "','" .
                __('Jul') . "','" .
                __('Aug') . "','" .
                __('Sep') . "','" .
                __('Oct') . "','" .
                __('Nov') . "','" .
                __('Dec') . "'" .
            "]," .

            ($calendarYearsRange ? 'yearRange: "' .
            $calendarYearsRange .
            '",' : '') .
            '
                        buttonText: "' .
            (string)new \Magento\Framework\Phrase(
                'Select Date'
            ) .
            '"' . ($maxDate ? ', maxDate: "' . $maxDate . '"' : '') .
            ($changeMonth === null ? '' : ', changeMonth: ' . $changeMonth) .
            ($changeYear === null ? '' : ', changeYear: ' . $changeYear) .
            ($showOn ? ', showOn: "' . $showOn . '"' : '') .
            ($firstDay ? ', firstDay: ' . $firstDay : '') .
            '})
            });
            </script>';

        return $html;
    }
}
