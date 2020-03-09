<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace FME\Faqs\Model\Config\Source;

class topics extends \FME\Faqs\Model\Topic implements \Magento\Framework\Option\ArrayInterface 
{
   
    public function toOptionArray()
    {
        return $this->gettopics();
        //return [['value' => 'all', 'label' => __('All')], 
              //  ['value' => 'guests', 'label' => __('Only Guests')],
              //  ['value' => 'registered', 'label' => __('Only Registered')],
              //  ['value' => 'none', 'label' => __('None')]];
    }

    
}
