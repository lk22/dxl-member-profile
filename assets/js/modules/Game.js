import { useAjaxRequest, getFormValues } from '../utilities'
import { useConfirm, useDialog } from '../utilities/dialog';
import {actions} from './../contants'
const ProfileGame = {
    init: function() {
        ProfileGame.buttons = {
            createGameButton: jQuery('.submit-add-app-game'),
            deleteGameButton: jQuery('.delete-app-game')
        }

        ProfileGame.forms = {
            createGameForm: jQuery('.dxl-app-add-game-form')
        }

        ProfileGame.bind()
    },

    bind: function() {
        ProfileGame.bindGameEvents()
    },

    bindGameEvents: function() {
        ProfileGame.buttons.createGameButton.on('click', function(e) {
            e.preventDefault()

            const values = getFormValues(ProfileGame.forms.createGameForm)
            values.action = actions.createGame
            values.nonce = DxlMemberProfile.nonce

            useAjaxRequest(DxlMemberProfile.ajaxurl, "POST", values, (response) => {
                console.log(response)

                if ( response.success ) window.location.reload()
                if ( response.success == false ) console.log(response.data.message)
            }, () => {
                console.log("Creating game...")
            }, (error) => {
                console.log(error)
            })
        })

        ProfileGame.buttons.deleteGameButton.on('click', function(e) {
            e.preventDefault()
            const gameId = e.currentTarget.dataset.game;

            useConfirm("Er du sikker på at du vil slette dette spil?", (result) = {
                if ( result ) {
                    ProfileGame.deleteGameAjax(gameId, {
                        gameId: gameId,
                        action: action,
                        nonce: DxlMemberProfile.nonce
                    })
                }
            })
        })
    },

    /**
     * request to delete game
     * @param {*} game 
     * @param {*} action 
     */
    deleteGameAjax: (game, data) => {
        useAjaxRequest(app.ajaxurl, "POST", data, (response) => {
            console.log(response);
            if ( response.success ) {
                useAlert("Spillet er blevet slettet", () => {
                    window.location.reload();
                });
            } else {
                console.log(response.data.message);
            }
            }, () => {
                useDialog({
                    title: "Sletter spil",
                    message: "Sletter spil vent venligst..."
                })
            }, (error) => {
                console.log(error);
            }
        )
      }
}

export default ProfileGame