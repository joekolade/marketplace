# customcategory=market=Marketplace
# customsubcategory=detail=Productdetail

plugin.tx_marketplace_articlesearch {
    view {
        # cat=market/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:marketplace/Resources/Private/Templates/
        # cat=market/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:marketplace/Resources/Private/Partials/
        # cat=market/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:marketplace/Resources/Private/Layouts/
    }

    persistence {
        # cat=market//a; type=string; label=Default storage PID
        storagePid =

        recursive = 3
    }

    settings {
        sitename = mangoo marketplace

        currencySign = USD
        currencyDefaultUid = 1

        requiredSign = <small>*</small>

        productDetail.pid = 152
        productDetail {
            # cat=market/detail/b; type=boolean; label=Show header above article listing:Article listing not necessaryly needs a header
            showHeader = true

            # cat=market/detail/b; type=boolean; label=Show back link:the back link repeats the browser own back function
            showBacklink = true

            # cat=market/detail/b; type=boolean; label=Width (px) of producer logo in detail view if set
            producerLogoWidth = 80

            imageWidth = 225
        }

        productDummyImage = EXT:marketplace/Resources/Public/Images/sendea-dummy.svg

        productRatingUid = 157
        proposeProductUid = 156
        productRatingDetailUid = 158

        otherProducerUid = 0

        pageIds {
            # Legals
            imprint = 56
            policy = 163
            guidelines = 164

            search = 185
        }

        storagePids {
            products = 141
            rating = 154
            users = 153
            textblocks = 162
        }

        useBootstrapSelect = 1
        useReportForRatings = 0

        showProduerLogoOnDetailPage = 0

        productList {
            # cat=market/detail/b; type=boolean; label=Product image width (px) in list view
            image.width = 320
            # cat=market/detail/b; type=boolean; label=Product image heigt (px) in list view
            image.height = 150c

            # cat=market/detail/b; type=boolean; label=Width (px) of producer logo in detail view if set
            producerLogoMaxWidth = 100
            # cat=market/detail/b; type=boolean; label=Maxheight (px) of producer logo in detail view if set
            producerLogoMaxHeight = 35
        }

        list.cropDescLimit = 120

        productList.pid = 139

        ratingList {
            #pid = 155
            pid = 49
            singlePid = 158
        }

        # cat=market/detail/b; type=boolean; label=Time that has to lie between two ratings (in days)
        daysbetweenRatings = 90

        register {
            formPid = 160
            confirmationPID = 160
            pendingFeGroup = 2
            registeredFeGroup = 1
        }

        email {
            receiver = hs@stiftung-solarenergie.org

            receiverName = Sendea Inbox (Admin)

            sender = no-reply@mangoo.org
            senderName = mangoo marketplace

            subjectReceiver = New contact for
            subjectDealer = Contact - Article

            userProductAcceptedSubject = Your proposed Product was accepted
            userProductDeclinedSubject = Your proposed Product was declined

            enderCeUid = 1122
        }

        registerEmail {
            subjectReceiver = Confirm your registration
        }

        pagination {
            # How many items per page
            itemsPerPage = 7
            # Number of links shown in paginator
            pageLinks = 5

            # Where to insert the paginator
            insertAbove = 0
            insertBelow = 1
        }

        adminster {
            adminPid = 161
            email {
                receiverName = mangoo marketplace admin team
                subjectReceiver = mangoo marketplace: New product proposed

                #sender = noreply@sendea.biz
                sender = no-reply@mangoo.org
                senderName = Mangoo-Automator-Service
            }
        }

        useMarket = 1

        dev {
            #emailCatcher = nande@suntransfer.com
            emailCatcher = 0
        }
    }
}

## cs_seo fallback image
page.headerData.654 {
    30 {
        55 {
            #stdWrap.if.isFalse.field = tx_csseo_og_image
            #file.import.field = images
        }
    }
}
