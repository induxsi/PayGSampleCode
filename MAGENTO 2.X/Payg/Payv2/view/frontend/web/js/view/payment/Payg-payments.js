/*browser:true*/
/*global define*/
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'Payg',
                component: 'Payg_Payv2/js/view/payment/method-renderer/Payg-method'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);
