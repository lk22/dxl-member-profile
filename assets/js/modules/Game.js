const ProfileGame = {

    /**
     * Initialize module
     */
    init: function() {
        ProfileGame.buttons = {
            createGameButton: jQuery('.submit-add-app-game'),
            deleteGameButton: jQuery('.delete-app-game, .game-row > .delete')
        }

        ProfileGame.forms = {
            createGameForm: jQuery('.dxl-app-add-game-form'),
            values: {}
        }

        ProfileGame.actions = {
            // Game actions
            createGame: "dxl_profile_create_game",
            editGame: "dxl_profile_edit_game",
            deleteGame: "dxl_profile_delete_game"
        }

        ProfileGame.bind()
    },

    /**
     * Bind all events
     */
    bind: function() {
        ProfileGame.bindGameEvents()
    },

    /**
     * Bind all game events
     */
    bindGameEvents: function() {
        const gameCount = jQuery('.member-games-list').find('.game-row').length;

        jQuery('.add-game-btn').on('click', function(e) {
            e.preventDefault();
            ProfileGame.forms.createGameForm.serializeArray().forEach((input) => {
                ProfileGame.forms.values[input.name] = input.value
            })

            jQuery.ajax({
                method: "POST",
                url: MemberProfileGame.ajaxurl,
                data: {
                    action: ProfileGame.actions.createGame,
                    nonce: MemberProfileGame.nonce,
                    values: ProfileGame.forms.values,
                    member_id: MemberProfileGame.profile.member_id
                },
                success: function(response) {
                    console.log(response);
                    if ( response.success) {

                        if ( gameCount == 0 ) {
                            jQuery('.member-games-list').html('');
                        }

                        jQuery('.member-games-list').append(
                            '<div class="row game-row" data-game="' + response.data.game.id + '">' +
                                '<div class="col-12 col-lg-4 game">' +
                                    '<div class="game-title">' + response.data.game.name +'</div>' +
                                    '<div class="game-actions">' +
                                        '<div class="delete"><i class="fas fa-trash"></i></div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>'
                        )

                        jQuery('#addNewGameModal').find('.create-game-form, button').show();
                        jQuery('#addNewGameModal').find('form').trigger('reset') // reset form
                        jQuery('#addNewGameModal').find('.loading').hide(); // hide loader
                        jQuery('#addNewGameModal').modal('hide'); // closing modal

                        new Swal({
                            title: "Spil Oprettet",
                            text: "Dit spil er oprettet",
                            icon: "success",
                            confirmButtonText: "Luk"
                        });
                    }
                },
                beforeSend: function() {
                    jQuery('#addNewGameModal').find('.create-game-form, button').hide();
                    jQuery('#addNewGameModal').find('.loading').show();
                },

                error: function(error) {
                    console.log(error);
                    jQuery('#addNewGameModal').find('.create-game-form, button').show();
                    jQuery('#addNewGameModal').find('.loading').hide();
                    new Swal({
                        title: "Fejl",
                        text: "Der skete en fejl prøv igen senere",
                        icon: "error",
                        confirmButtonText: "Luk"
                    })
                }
            })
        })

        // performing delete action on a game
        jQuery('.game-row').each(function(index, row) {
            jQuery(row).find('.delete').off().on('click', function(e) {
                const gameId = jQuery(row).data('game');
                console.log({gameId})
                new Swal({
                    title: "Er du sikker?",
                    text: "Er du sikker på at du vil slette dette spil?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ja, slet spil",
                    cancelButtonText: "Nej, behold spil"
                }).then((result) => {
                    if ( result.value ) {
                        jQuery.ajax({
                            method: "POST",
                            url: MemberProfileGame.ajaxurl,
                            data: {
                                action: ProfileGame.actions.deleteGame,
                                nonce: MemberProfileGame.nonce,
                                gameId: gameId,
                                member_id: MemberProfileGame.member.id
                            },
                            success: function(response) {
                                console.log(response)
                                if ( response.success ) {
                                    jQuery('.member-games-list').html("")
                                    response.data.games.forEach((game) => {
                                        jQuery('.member-games-list').append(
                                            '<div class="row game-row" data-game="' + game.id + '">' +
                                                '<div class="col-12 col-lg-4 game">' +
                                                    '<div class="game-title">' + game.name +'</div>' +
                                                    '<div class="game-actions">' +
                                                        '<div class="delete"><i class="fas fa-trash"></i></div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>'
                                        )
                                    })

                                    new Swal({
                                        title: "Spillet er blevet slettet",
                                        text: "Spillet er blevet slettet",
                                        icon: "success",
                                        confirmButtonText: "Luk"
                                    })
                                } else {
                                    new Swal({
                                        title: "Spillet kunne ikke slettes",
                                        text: "Spillet kunne ikke slettes",
                                        icon: "error",
                                        confirmButtonText: "Luk"
                                    })
                                }
                            }
                        })
                    }
                })
            });
        })
    }
}

ProfileGame.init();