tx_csseo {
    # new index and table name of the model
    1 = tx_marketplace_domain_model_product

    # if the get parameter is set in the URL the cs_seo properties will be shown
    1.enable = GP:tx_marketplace_articlesearch|product

    # if the model already has fields like title etc. define them as fallback
    1.fallback {

        # cs_seo title field fallback = mymod title field
        title = title

        # cs_seo description field fallback = mymod description field
        description = description
    }

    # enable evaluation for news
    1.evaluation {
        # additional params to initialize the detail view, the pipe will be replaced by the uid
        getParams = &tx_marketplace_articlesearch[controller]=Product&tx_marketplace_articlesearch[action]=Show&tx_marketplace_articlesearch[product]=|

        # detail pid for the current records, only if set the table will be available
        detailPid = 152
    }
}