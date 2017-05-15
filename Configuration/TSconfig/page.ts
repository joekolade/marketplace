tx_csseo {
    // Products
    //

    2 = tx_marketplace_domain_model_product
    2.enable = GP:tx_marketplace_articlesearch|product

    2.fallback {
        title = title
        description = description
        image = images
    }

    2.evaluation {
        getParams = &tx_marketplace_articlesearch[action]=show&tx_marketplace_articlesearch[product]=|
        detailPid = 152
    }
}