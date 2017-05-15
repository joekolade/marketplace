tx_csseo {
    // Products
    //

    2 = tx_marketplace_domain_model_product
    2.enable = GP:tx_marketplace_articlesearch|product

    2.fallback {
        title = title
        description = description
    }

    2.evaluation {
        getParams = &tx_marketplace_articlesearch[action]=show&tx_marketplace_articlesearch[product]=|
        detailPid = 152
    }


    // Productgroups
    //
    2 = tx_marketplace_domain_model_productgroup

    3.enable = GP:tx_marketplace_articlesearch|productgroup

    3.fallback {

        title = name
        description =
    }

    3.evaluation {
        getParams = &tx_marketplace_articlesearch[controller]=Product&tx_marketplace_articlesearch[action]=list&tx_marketplace_articlesearch[productgroup]=|

        # detail pid for the current records, only if set the table will be available
        detailPid = 184
    }
}