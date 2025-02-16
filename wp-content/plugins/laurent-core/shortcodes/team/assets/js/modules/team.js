(function($) {
    'use strict';

    var team = {};
    eltdf.modules.team = team;

    team.eltdfTeam = eltdfTeam;

    team.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).on('load', eltdfOnWindowLoad);

    /*
        All functions to be called on $(window).on('load') should be in this function
    */
    function eltdfOnWindowLoad() {
        eltdfTeam();
        eltdfElementorTeam();
    }

    /**
     * Elementor
     */
    function eltdfElementorTeam(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_stacked_images.default', function() {
                eltdfTeam();
            } );
        });
    }

    function eltdfTeam() {
        var teamHolder = $('.eltdf-team-holder');

        if ( teamHolder.length ) {
            teamHolder.each( function() {
                var thisHolder = $(this),
                    teamIcon = thisHolder.find('.eltdf-team-icon');

                if ( teamIcon.length ) {
                    teamIcon.each( function() {
                        var thisIcon = $(this),
                            iconLink = thisIcon.find('a');

                        iconLink.append('<span class="eltdf-btn-first-line"></span><span class="eltdf-btn-second-line"></span>');
                    });
                }
            });
        }
    }

})(jQuery);