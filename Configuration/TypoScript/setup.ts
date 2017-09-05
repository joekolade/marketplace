plugin.tx_marketplace_articlesearch {
    view {
        templateRootPaths.0 = {$plugin.tx_marketplace_articlesearch.view.templateRootPath}
        partialRootPaths.0 = {$plugin.tx_marketplace_articlesearch.view.partialRootPath}
        layoutRootPaths.0 = {$plugin.tx_marketplace_articlesearch.view.layoutRootPath}

        # Overwrite paginator Template
        widget.TYPO3\CMS\Fluid\ViewHelpers\Widget\PaginateViewHelper.templateRootPath = EXT:marketplace/Resources/Private/Templates/
    }

    features {
        skipDefaultArguments = 1
    }

    persistence {
        storagePid = {$plugin.tx_marketplace_articlesearch.persistence.storagePid}
        classes {
            JS\Marketplace\Domain\Model\Product.newRecordStoragePid = {$plugin.tx_marketplace_articlesearch.settings.storagePids.products}

            JS\Marketplace\Domain\Model\Rating.newRecordStoragePid = {$plugin.tx_marketplace_articlesearch.settings.storagePids.rating}

            # Die folgenden Zeilen gehen nicht!
            # FIXME: Fix StoragePID für neue User
            JS\Markeplace\Domain\Model\User.newRecordStoragePid = 153
            TYPO3\CMS\Extbase\Domain\Model\FrontendUser.newRecordStoragePid = 153
        }

        recursive = {$plugin.tx_marketplace_articlesearch.persistence.recursive}
    }

    #features.rewrittenPropertyMapper = 0
    settings {
        sitename = {$plugin.tx_marketplace_articlesearch.settings.sitename}
        currencySign = {$plugin.tx_marketplace_articlesearch.settings.currencySign}
        currencyDefaultUid = {$plugin.tx_marketplace_articlesearch.settings.currencyDefaultUid}

        requiredSign = {$plugin.tx_marketplace_articlesearch.settings.requiredSign}

        list.cropDescLimit = {$plugin.tx_marketplace_articlesearch.settings.list.cropDescLimit}

        proposeProductUid = {$plugin.tx_marketplace_articlesearch.settings.proposeProductUid}
        productRatingUid = {$plugin.tx_marketplace_articlesearch.settings.productRatingUid}
        productRatingDetailUid = {$plugin.tx_marketplace_articlesearch.settings.productRatingDetailUid}

        otherProducerUid = {$plugin.tx_marketplace_articlesearch.settings.otherProducerUid}

        useReportForRatings = {$plugin.tx_marketplace_articlesearch.settings.useReportForRatings}
        showProduerLogoOnDetailPage = {$plugin.tx_marketplace_articlesearch.settings.showProduerLogoOnDetailPage}

        pageIds.imprint = {$plugin.tx_marketplace_articlesearch.settings.pageIds.imprint}
        pageIds.policy = {$plugin.tx_marketplace_articlesearch.settings.pageIds.policy}
        pageIds.guidelines = {$plugin.tx_marketplace_articlesearch.settings.pageIds.guidelines}
        pageIds.search = {$plugin.tx_marketplace_articlesearch.settings.pageIds.search}

        productDummyImage = {$plugin.tx_marketplace_articlesearch.settings.productDummyImage}

        productList {
            pid = {$plugin.tx_marketplace_articlesearch.settings.productList.pid}

            image.width = {$plugin.tx_marketplace_articlesearch.settings.productList.image.width}
            image.height = {$plugin.tx_marketplace_articlesearch.settings.productList.image.height}
            producerLogoMaxWidth = {$plugin.tx_marketplace_articlesearch.settings.productList.producerLogoMaxWidth}
            producerLogoMaxHeight = {$plugin.tx_marketplace_articlesearch.settings.productList.producerLogoMaxHeight}
        }

        productDetail {
            pid = {$plugin.tx_marketplace_articlesearch.settings.productDetail.pid}

            showHeader = {$plugin.tx_marketplace_articlesearch.settings.productDetail.showHeader}
            showBacklink = {$plugin.tx_marketplace_articlesearch.settings.productDetail.showBacklink}
            producerLogoWidth = {$plugin.tx_marketplace_articlesearch.settings.productDetail.producerLogoWidth}

            imageWidth = {$plugin.tx_marketplace_articlesearch.settings.productDetail.imageWidth}
        }

        ratingList {
            pid = {$plugin.tx_marketplace_articlesearch.settings.ratingList.pid}
            singlePid = {$plugin.tx_marketplace_articlesearch.settings.ratingList.singlePid}
        }

        daysbetweenRatings = {$plugin.tx_marketplace_articlesearch.settings.daysbetweenRatings}

        register {
            formPid = {$plugin.tx_marketplace_articlesearch.settings.register.formPid}
            confirmationPID = {$plugin.tx_marketplace_articlesearch.settings.register.confirmationPID}
            pendingFeGroup = {$plugin.tx_marketplace_articlesearch.settings.register.pendingFeGroup}
            registeredFeGroup = {$plugin.tx_marketplace_articlesearch.settings.register.registeredFeGroup}
        }

        email {
            receiver = {$plugin.tx_marketplace_articlesearch.settings.email.receiver}
            receiverName = {$plugin.tx_marketplace_articlesearch.settings.email.receiverName}
            sender = {$plugin.tx_marketplace_articlesearch.settings.email.sender}
            senderName = {$plugin.tx_marketplace_articlesearch.settings.email.senderName}

            subjectReceiver = {$plugin.tx_marketplace_articlesearch.settings.email.subjectReceiver}
            subjectDealer = {$plugin.tx_marketplace_articlesearch.settings.email.subjectDealer}

            userProductAcceptedSubject = {$plugin.tx_marketplace_articlesearch.settings.email.userProductAcceptedSubject}
            userProductDeclinedSubject = {$plugin.tx_marketplace_articlesearch.settings.email.userProductDeclinedSubject}

            enderCeUid = {$plugin.tx_marketplace_articlesearch.settings.email.enderCeUid}
        }

        registerEmail < .email
        registerEmail {
            subjectReceiver = {$plugin.tx_marketplace_articlesearch.settings.registerEmail.subjectReceiver}
        }

        pagination {
            itemsPerPage = {$plugin.tx_marketplace_articlesearch.settings.pagination.itemsPerPage}
            pageLinks = {$plugin.tx_marketplace_articlesearch.settings.pagination.pageLinks}

            insertAbove = {$plugin.tx_marketplace_articlesearch.settings.pagination.insertAbove}
            insertBelow = {$plugin.tx_marketplace_articlesearch.settings.pagination.insertBelow}
        }

        adminster.email < .email
        adminster {
            adminPid = {$plugin.tx_marketplace_articlesearch.settings.adminster.adminPid}
            email {
                receiverName = {$plugin.tx_marketplace_articlesearch.settings.adminster.email.receiverName}
                subjectReceiver = {$plugin.tx_marketplace_articlesearch.settings.adminster.email.subjectReceiver}
                sender = {$plugin.tx_marketplace_articlesearch.settings.adminster.email.sender}
                senderName = {$plugin.tx_marketplace_articlesearch.settings.adminster.email.senderName}
            }
        }

        useMarket = {$plugin.tx_marketplace_articlesearch.settings.useMarket}

        dev.emailCatcher = {$plugin.tx_marketplace_articlesearch.settings.dev.emailCatcher}
    }
}

[globalVar = LIT:1 = {$plugin.tx_marketplace_articlesearch.settings.useBootstrapSelect}]
    page.includeCSS {
        bootstrap_select = EXT:marketplace/Resources/Public/CSS/bootstrap-select.min.css
    }

    page.includeJSFooter {
        bootstrap_select = EXT:marketplace/Resources/Public/Javascript/bootstrap-select.min.js
    }
[global]

page.includeCSS {
    tx_marketplace = EXT:marketplace/Resources/Public/CSS/tx_marketplace.scss
}

page.includeJSFooterlibs {
    hash = EXT:marketplace/Resources/Public/Javascript/hash.min.js

}
page.includeJSFooter {
    tx_marketplace = EXT:marketplace/Resources/Public/Javascript/marketplace.min.js
}

plugin.tx_marketplace._CSS_DEFAULT_STYLE (
)

plugin.tx_marketplace_ratingsearch < plugin.tx_marketplace_articlesearch
plugin.tx_marketplace_registeruser < plugin.tx_marketplace_articlesearch
plugin.tx_marketplace_categorylist < plugin.tx_marketplace_articlesearch
plugin.tx_marketplace_recentlist < plugin.tx_marketplace_articlesearch

lib.emailCloser = COA
lib.emailCloser {
    10 = CONTENT
    10 {
        table = tt_content
        select {
            pidInList = {$plugin.tx_marketplace_articlesearch.settings.storagePids.textblocks}
            uidInList = {$plugin.tx_marketplace_articlesearch.settings.email.enderCeUid}
        }

        renderObj = COA
        renderObj {
            10 = TEXT
            10 {
                field = bodytext
            }
        }
    }
}

config.tx_realurl_enable = 0
