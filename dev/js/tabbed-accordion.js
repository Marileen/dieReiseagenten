// create private Vars
var $tabbedAccordion;
var $tabContainer;
var $headingsLabel;
var $tabs;
var $headings;              // mobile headings für Accordion
var $tabContents;
var activeTab;
var singlePaneMode;         //nur jeweils ein Accordion darf geöffnet sein
var hasRadio;

// PUBLIC FUNCTIONS
initializeTabs();
checkHash();


function initializeTabs() {
    $tabbedAccordion = $('[data-component="tabbedAccordion"]');
    $tabContainer = $('[data-component="tabbedAccordion"] .tab-container');
    $tabs = $('ul.tabs li', $tabbedAccordion);
    $headings = $('.accordion-heading', $tabbedAccordion);
    $headingsLabel = $('.accordion-heading label', $tabbedAccordion);
    $tabContents = $('.tab-content', $tabbedAccordion);
    activeTab = null;
    singlePaneMode = false;
    hasRadio = $('.accordion-heading input[type="radio"]', $tabbedAccordion).length > 0;

    if ($tabbedAccordion.hasClass('no-tabs') || $tabbedAccordion.hasClass('single-mode') || hasRadio) {
        singlePaneMode = true;
    }
    //Tabs Mode (Desktop)
    $tabs.on('click', clickHandler);

    //Accordion Mode (Mobile)
    $headings.on('mouseup', mouseupHandler);

    //Zur Sicherheit prüfen ob mit dem Markup alles ok ist
    // und die headings mit der Anz. d. labels übereinstimmen - nur für dev:
    if ($headingsLabel.length > 0 && $headings.length != $headingsLabel.length) {
        console.warn('TabAccordion: please check yout markup for inputs in headings');
    }
}


function clickHandler() {

    var $el = $(this);

    $tabContainer.toggleClass('tab-switch');

    $tabContents.removeClass('active');
    activeTab = $el.attr("rel");
    $('#' + activeTab).addClass('active');        //aktuellen tab inhalt aktiv setzen
    setHash(activeTab, true);

    $tabs.removeClass('active');
    $el.addClass('active');                       //aktuellen tab button aktiv setzen

}

function mouseupHandler() {

    var $el = $(this);

    if (singlePaneMode) {
        $headings.removeClass('active');
        $el.addClass('active');
        var id = $el.find('input[name="paymentType"]').attr('id');
        $('#' + id).attr('checked', 'checked');
    } else {
        $el.toggleClass('active');
    }

    $accordion = $('[data-id="tabbed-accordion"]');
    $(window).scrollTop($accordion.offset().top);

}


function switchTab(evt) {

    var num = parseInt(evt.tabNumber) - 1;

    $headings.removeClass('active');
    $('ul.tabs li', $tabbedAccordion).removeClass('active');
    $('.tab-content', $tabbedAccordion).removeClass('active');

    $tabs.eq(num).addClass('active');
    $tabbedAccordion.find('.tab-container #tab' + evt.tabNumber).addClass('active');
    $tabbedAccordion.find('.tab-container #tab' + evt.tabNumber).prev().addClass('active');

    if (evt.auto == true) {
        setHash('tab' + evt.tabNumber, false);
    } else {
        setHash('tab' + evt.tabNumber, true);
    }


    if (evt.auto == true) {
        setTimeout(function () {
            eventBus.dispatchEvent({type: events.OPEN_TAB_COMPLETE});
        }, 200);
    }
}


function forceSwitchTab(evt) {

    // Nur ein bestimmer Tab soll verausgewählt sein und darf auch nicht verändert werden
    // Mit evt.tabNumber wird die tabnummer übergeben, des tabs das angezeigt werden soll
    // Mit evt.targetContainer wird der Container übergeben, auf den vorab geprüft wird
    //  --> soweit ich erinnere, wird diese Prüfung gemacht, da es im minifizierten JS sonst einen Fehler gibt
    //  --> wenn die radio inputs nicht gefunden werden

    if (evt.targetContainer.length > 0) {

        var num = parseInt(evt.tabNumber) - 1;
        var $targetElement = $('.payment-container form[name="paymentform"]');

        var $forceTabs = $targetElement.find('[data-component="tabbedAccordion"] ul.tabs li');
        var $forceHeadings = $targetElement.find('.accordion-heading');
        $forceTabs.off('click', clickHandler);
        $forceTabs.on('click', function (e) {
            e.preventDefault;
        })

        //Mobile -> Headings dürfen nicht klickbar sein
        $forceHeadings.off('mouseup', mouseupHandler);

        $targetElement.find('.accordion-heading').removeClass('active');
        $targetElement.find('.accordion-heading input[type="radio"]').prop('disabled', true);

        $targetElement.find('.accordion-heading .bt-radio a').on('click', function (e) {
            e.preventDefault;
        })

        $targetElement.find('.accordion-heading input').removeAttr('checked');
        $targetElement.find('.accordion-heading a').removeClass('checked');
        $targetElement.find('.accordion-heading').addClass('disabled');

        //einen Speziellen container anzeigen
        $forceTabs.eq(num).addClass('active');
        $('.accordion-heading').eq(num).addClass('active').removeClass('disabled');
        $('.accordion-heading').eq(num).find('a').addClass('checked');
        $('.accordion-heading').eq(num).find('input').attr('disabled', false);
        $('.accordion-heading').eq(num).find('input').attr('checked', true);

        // $('.accordion-heading input[type="radio]]#invoice').updateRadio(true)

    }
}

function checkHash() {
    var hash = location.hash.substr(1);
    var tabHash = hash.split('&')[0];

    if (tabHash.substr(0, 3) == 'tab') {
        var nr = tabHash.split("tab")[1];
        eventBus.dispatchEvent({type: events.OPEN_TAB, tabNumber: nr, auto: true});
    }

}

function setHash(hash, change) {
    var currHash = location.hash.split('&');

    var newHash = hash;
    if (change == true) {
        newHash += "&";
    } else {
        for (var a = 1; a < currHash.length; a++) {
            newHash += '&' + currHash[a];
        }
    }

    location.hash = newHash;
}



